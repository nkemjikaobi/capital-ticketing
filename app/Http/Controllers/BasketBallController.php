<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasketBallTicket;
use App\Models\BasketBallPay;
use Illuminate\Support\Facades\DB;

class BasketBallController extends Controller
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

     
     public function buy_tickets_basketball(){

        //Get BasketBall Tickets
        $tickets = BasketBallTicket::all();

        return view("dashboard.basketball.buy_tickets_basketball",compact('tickets'));

     }

     public function buy_tickets_basketball_fixture($id){

        $fixture_details = BasketBallTicket::findorfail($id);

        return view('dashboard.basketball.buy_tickets_basketball_fixture',compact('fixture_details'));
     }

     public function buy_tickets_basketball_pay(Request $request){

        $email = auth()->user()->email;

        BasketBallPay::create([
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
        $pay = BasketBallPay::where('email', '=', $email)->orderBy('id', 'DESC')->take(1)->get();

        return view("dashboard.basketball.buy_tickets_basketball_pay",compact('pay','ticket_id'));
     }

     public function buy_tickets_basketball_pay_process(Request $request){

        //Check that balance is sufficient
        if(request('final_pay') <= auth()->user()->portfolio->balance ){

            //Check that purchase number does not exceed number of tickets available
            if(request('purchase_number') <= request('tickets_available')){
                //Update the transaction status and final pay
               $basketball_pay =  DB::table('basket_ball_pays')
                    ->where('email', '=', auth()->user()->email)
                    ->orderBy('id', 'DESC')
                    ->take(1)
                    ->update([
                        'final_pay'  => request('final_pay'),
                        'transaction_status' => 1,
                        'tickets_available' => request('tickets_available') - request('purchase_number'),
                        'roi' => request('final_pay')
                    ]);
               if($basketball_pay){
                   //Update user balance
                  $portfolio =  DB::table('portfolios')
                       ->where('user_id', '=', auth()->user()->id)
                       ->update([
                           'balance' =>  auth()->user()->portfolio->balance - request('final_pay')
                       ]);
                  if($portfolio){
                      //Update Tickets Available
                   $ticket  =  DB::table('basket_ball_tickets')
                          ->where('id' , '=', request('ticket_id'))
                          ->update([
                              'tickets_available' => request('tickets_available') - request('purchase_number')
                          ]);
                   if($ticket){
                       //Delete redundant rows from BasketBall Pays table
                       DB::table('basket_ball_pays')
                           ->where('transaction_status', '=', 0)
                           ->delete();

                    }
                  }
               }
            }
        }
            return redirect("/view_tickets");
    }

    public function calculate_basketball_roi(){

        //Get all tickets that are active
        $tickets = DB::table('basket_ball_pays')
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
            DB::table('basket_ball_pays')
                ->where('id', '=', $id[$i])
                ->update([
                    'roi' => $new_roi[$i]
                ]);
        }
    }
}
