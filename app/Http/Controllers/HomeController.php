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

class HomeController extends Controller
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

    public function buy_tickets(){


        return view('dashboard.buy_tickets');
    }

    public function buy_tickets_soccer(){
      
        //Get Tickets
        $tickets = SoccerTicket::all();

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
            }
        }
            return redirect("/view_tickets");
    }

    public function calculate_roi(){

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
//            if($new_roi[$i] == $max_amount[$i]){
//                //Actually update the database with the exact roi
//                    DB::table('soccer_pays')
//                        ->where('id', '=', $id[$i])
//                        ->update([
//                            'roi' => $max_amount[$i]
//                        ]);
//            }
//            else if($new_roi[$i] > $max_amount[$i]){
//                //Actually update the database with the exact roi
//                    DB::table('soccer_pays')
//                        ->where('id', '=', $id[$i])
//                        ->update([
//                            'roi' => $max_amount[$i]
//                        ]);
//            }
           // else{
                //Actually update the database with the new roi
                    DB::table('soccer_pays')
                        ->where('id', '=', $id[$i])
                        ->update([
                            'roi' => $new_roi[$i]
                        ]);
            //}
        }
    }

    public function deposits(){

        $deposits = DB::table('deposits')
            ->where('customer_email', '=', auth()->user()->email)
            ->orderBy("id","desc")
            ->get();

        return view('dashboard.deposits',compact("deposits"));
    }

    public function fund_wallet(){

        return view ("dashboard.fund_wallet");
    }

    public function fund_wallet_create(Request $request){

        $customer_id = rand(100000,999999);

        //Create a charge
        $result = Http::withHeaders([
            "Content-Type" => "application/json",
            "X-CC-Api-Key" => "ba6e8f85-1992-44a8-9aa6-e5ac2b102423",
            "X-CC-Version" => "2018-03-22"
        ])->post("https://api.commerce.coinbase.com/charges", [
            "name" => "Wallet TopUp",
            "description" => "Funds top up for your account on Capital Ticketing",
            "pricing_type" => "fixed_price",
            "local_price" => [
                "amount" => request('amount'),
                "currency" => "USD"
            ],
            "metadata" => [
            "customer_id" => $customer_id,
                "customer_email" => auth()->user()->email
       ],
       "redirect_url" => "http://127.0.0.1:8000/deposits",
       "cancel_url" => "http://127.0.0.1:8000/deposits"
        ]);

        //Store relevant details in the deposits table
        $deposits = Deposit::create([
            'code' => $result['data']['code'],
            'transaction_id' => $result['data']['id'],
            'customer_id' => $result['data']['metadata']['customer_id'],
            'customer_email' => $result['data']['metadata']['customer_email'],
            'description' => $result['data']['name'],
            'local_amount' => $result['data']['pricing']['local']['amount'],
            'transaction_status' => "charge:created",
            'created_at' => $result['data']['created_at'],
        ]);

        $redirect_url = $result['data']['hosted_url'];

        if($deposits){
            //redirect the users to make payment
            return redirect("$redirect_url");
        }
        else{
            return redirect("/home");
        }
    }

    public function index()
    {
        //Get ticket details
        $ticket_details = DB::table('soccer_pays')
                            ->where([
                                ['email', '=', auth()->user()->email],
                                ['isSold', '=', 0]
                            ])
                            ->get();

        $ticket_number = (count($ticket_details));

        //Get all roi's
        $roi = DB::table('soccer_pays')
                ->where([
                    ['email', '=', auth()->user()->email],
                    ['transaction_status', '=', 1],
                    ['isSold', '=', 0]
                ])
                ->get();

        //Get the roi and put in array
        $rois = [];
        foreach($roi as $r){
            $rois[] = $r->roi; 
        }
        
        $current_roi = 0;

        for($i = 0; $i < count($rois); $i++){
            $current_roi = $current_roi + $rois[$i];
        }

        //Check if balance is zero, then update account status
        if(auth()->user()->portfolio->balance != 0){
            DB::table('portfolios')
                ->where('user_id', '=', auth()->user()->id)
                ->update([
                    'account_status' => 1
                ]);
        }
        else{
            DB::table('portfolios')
                ->where('user_id', '=', auth()->user()->id)
                ->update([
                    'account_status' => 0
                ]);
        }

        return view('home', compact('ticket_number','current_roi'));
    }


    public function sell_tickets(){

        //Update balance
         $balance = DB::table('portfolios')
            ->where('user_id', '=', auth()->user()->id)
            ->update([
                'balance' =>  auth()->user()->portfolio->balance + request('roi'),
            ]);
         if($balance){
             //Change sold status
             $sold = DB::table('soccer_pays')
                 ->where('id','=', request('id'))
                 ->update([
                     'isSold' => 1
                 ]);
             if($sold){
                 return redirect("/home");
             }
         }
    }

    public function update_profile(Request $request){

        $data = request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->username = $user->username;
        $user->email = $user->email;

        $user->save();

        //Get Ip Address
        $ip_address = $request->ip();

        //Get operating system, device and browser details
        $agent = new Agent();
        $operating_system = $agent->platform();
        $browser = $agent->browser();
        $device = $agent->device();

        $success = "Profile Updated";

       // return view('dashboard.profile', compact('user','ip_address','device','browser','operating_system','success'));

        //return view('dashboard.profile')->with(['user' => $user,'ip_address' => $ip_address,'device' => $device,'browser' => $browser,'operating_system' => $operating_system, 'success' => $success]);
        return view('dashboard.profile', compact('user','ip_address','device','browser','operating_system','success'));

    }

    public function view_profile(Request $request){

        //Get Ip Address
        $ip_address = $request->ip();

        //Get operating system, device and browser details
        $agent = new Agent();
        $operating_system = $agent->platform();
        $browser = $agent->browser();
        $device = $agent->device();

        return view('dashboard.profile', compact('ip_address','device','browser','operating_system'));
    }

    public function view_tickets(){
        $tickets = DB::table('soccer_pays')
                    ->where('email', '=', auth()->user()->email)
                    ->get();
        return view("dashboard.view_tickets", compact('tickets'));
    }

    public function withdrawals(){

        return view ('dashboard.withdrawals');
    }
}
