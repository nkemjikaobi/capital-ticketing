<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Portfolio;
use App\Models\SoccerPay;
use App\Models\SoccerTeam;
use App\Models\SoccerTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\View;

class SoccerController extends Controller
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

    public function buy_tickets_soccer(){
      
        //Get Soccer Tickets
        $tickets = SoccerTicket::paginate(6);

        return view("dashboard.soccer.buy_tickets_soccer",compact('tickets'));
    }

    public function buy_tickets_soccer_fixture($id){

        $fixture_details = SoccerTicket::findorfail($id);

        return view('dashboard.soccer.buy_tickets_soccer_fixture',compact('fixture_details'));
    }

    public function buy_tickets_soccer_pay(Request $request){

        $email = auth()->user()->email;

        SoccerPay::create([
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
        $pay = SoccerPay::where('email', '=', $email)->orderBy('id', 'DESC')->take(1)->get();

        return view("dashboard.soccer.buy_tickets_soccer_pay",compact('pay','ticket_id'));
    }

    public function buy_tickets_soccer_pay_process(Request $request){

        //Check that balance is sufficient
        if(request('final_pay') <= auth()->user()->portfolio->balance ){

            //Check that purchase number does not exceed number of tickets available
            if(request('purchase_number') <= request('tickets_available')){
                //Update the transaction status and final pay
               $soccer_pay =  DB::table('soccer_pays')
                    ->where('email', '=', auth()->user()->email)
                    ->orderBy('id', 'DESC')
                    ->take(1)
                    ->update([
                        'final_pay'  => request('final_pay'),
                        'transaction_status' => 1,
                        'tickets_available' => request('tickets_available') - request('purchase_number'),
                        'roi' => request('final_pay')
                    ]);
               if($soccer_pay){
                   //Update user balance
                  $portfolio =  DB::table('portfolios')
                       ->where('user_id', '=', auth()->user()->id)
                       ->update([
                           'balance' =>  auth()->user()->portfolio->balance - request('final_pay')
                       ]);
                  if($portfolio){
                      //Update Tickets Available
                   $ticket  =  DB::table('soccer_tickets')
                          ->where('id' , '=', request('ticket_id'))
                          ->update([
                              'tickets_available' => request('tickets_available') - request('purchase_number')
                          ]);
                   if($ticket){
                       //Delete redundant rows from Soccer Pays table
                       DB::table('soccer_pays')
                           ->where('transaction_status', '=', 0)
                           ->delete();

                    }
                  }
               }
               else{
                return redirect("/view_tickets")->with('error','An error occurred..Try again later');
               }
            }
        }
            return redirect("/view_tickets")->with('error','Insufficient Funds');
    }

    public function calculate_soccer_roi(){

        //Get all tickets that are active
        $tickets = DB::table('soccer_pays')
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
            DB::table('soccer_pays')
                ->where('id', '=', $id[$i])
                ->update([
                    'roi' => $new_roi[$i]
                ]);
        }
    }
}
