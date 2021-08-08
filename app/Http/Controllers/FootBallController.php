<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FootBallTicket;
use App\Models\FootBallPay;
use Illuminate\Support\Facades\DB;

class FootBallController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     
     public function buy_tickets_football(){

        //Get FootBall Tickets
        $tickets = FootBallTicket::paginate(6);

        return view("dashboard.football.buy_tickets_football",compact('tickets'));

     }

     public function buy_tickets_football_fixture($id){

        $fixture_details = FootBallTicket::findorfail($id);

        if($fixture_details->time_left < 1){
            return redirect('/buy_tickets/football')->with('error', 'Ticket expired');
        }

        return view('dashboard.football.buy_tickets_football_fixture',compact('fixture_details'));
     }

     public function buy_tickets_football_pay(Request $request){

        $email = auth()->user()->email;

        FootBallPay::create([
            'home_team'  => request('home_team'),
            'away_team'  => request('away_team'),
            'purchase_number'  => request('purchase_number'),
            'ticket_price'  => request('ticket_price'),
            'tickets_available'  => request('tickets_available'),
            'expected_profit'  => request('expected_profit'),
            'country'  => request('country'),
            'competition'  => request('competition'),
            'fixture_date'  => request('fixture_date'),
            'fixture_time'  => request('fixture_time'),
            'time_left'  => request('time_left'),
            'email' => $email
        ]);

        $ticket_id = request('ticket_id');
        $pay = FootBallPay::where('email', '=', $email)->orderBy('id', 'DESC')->take(1)->get();

        return view("dashboard.football.buy_tickets_football_pay",compact('pay','ticket_id'));
     }

     public function buy_tickets_football_pay_process(Request $request){

        //Check that balance is sufficient
        if(request('final_pay') <= auth()->user()->portfolio->balance ){

            //Check that purchase number does not exceed number of tickets available
            if(request('purchase_number') <= request('tickets_available')){
                //Update the transaction status and final pay
               $football_pay =  DB::table('foot_ball_pays')
                    ->where('email', '=', auth()->user()->email)
                    ->orderBy('id', 'DESC')
                    ->take(1)
                    ->update([
                        'final_pay'  => request('final_pay'),
                        'transaction_status' => 1,
                        'tickets_available' => request('tickets_available') - request('purchase_number'),
                        'roi' => request('final_pay')
                    ]);
               if($football_pay){
                   //Update user balance
                  $portfolio =  DB::table('portfolios')
                       ->where('user_id', '=', auth()->user()->id)
                       ->update([
                           'balance' =>  auth()->user()->portfolio->balance - request('final_pay')
                       ]);
                  if($portfolio){
                      //Update Tickets Available
                   $ticket  =  DB::table('foot_ball_tickets')
                          ->where('id' , '=', request('ticket_id'))
                          ->update([
                              'tickets_available' => request('tickets_available') - request('purchase_number')
                          ]);
                   if($ticket){
                       //Delete redundant rows from FootBall Pays table
                       DB::table('foot_ball_pays')
                           ->where('transaction_status', '=', 0)
                           ->delete();
                    }
                  }

                  return redirect("/view_tickets")->with('success','Tickets bought successfully');
               }
               else{
                return redirect("/view_tickets")->with('error','An error occurred..Try again later');
               }
            }
        }
        else{
            return redirect("/view_tickets")->with('error','Insufficient Funds');
        }
    }

    public function calculate_football_roi(){

        //Get all tickets that are active
        $tickets = DB::table('foot_ball_pays')
            ->where('transaction_status', '=', 1)
            ->get();

       //Initialize arrays
        $id = [];
        $profit = [];
        $roi = [];
        $amount_paid = [];

        //Get each of the array fields
        foreach ($tickets as $ticket){
            $id[] = $ticket->id;
            $profit[] = $ticket->expected_profit;
            $roi[] = $ticket->roi;
            $amount_paid[] = $ticket->final_pay;
        }

        //Convert profits to percentage
        $profit_percentage = [];
        for($i = 0; $i < count($tickets); $i++){
            $profit_percentage[] = $profit[$i] / 100;
        }

        //Calculate the increment
        $max_increment = [];
        for($i = 0; $i < count($tickets); $i++){
            $max_increment[] = $profit_percentage[$i] * $amount_paid[$i];
        }

        //Calculate the maximum amount it gets to
        $max_amount = [];
        for($i = 0; $i < count($tickets); $i++){
            $max_amount[] = $max_increment[$i] + $amount_paid[$i];
        }

        //Get the random roi increments
        $new_roi = [];
        for($i = 0; $i < count($tickets); $i++){
            $new_roi[] = (rand(1, 100)/100)  + $roi[$i];
        }

        //Do the increments accordingly
        for($i = 0; $i < count($tickets); $i++){

        //Actually update the database with the new roi
            DB::table('foot_ball_pays')
                ->where('id', '=', $id[$i])
                ->update([
                    'roi' => $new_roi[$i]
                ]);
        }
    }
}
