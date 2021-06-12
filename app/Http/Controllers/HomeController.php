<?php

namespace App\Http\Controllers;

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

        $user_id = auth()->user()->id;
        $user = User::findorfail($user_id);

        return view('dashboard.buy_tickets',compact('user'));
    }

    public function buy_tickets_soccer(){
        $user_id = auth()->user()->id;
        $user = User::findorfail($user_id);

        //Get Tickets
        $tickets = SoccerTicket::all();

        return view("dashboard.buy_tickets_soccer",compact('user','tickets'));
    }

    public function buy_tickets_soccer_fixture($id){

        $fixture_details = SoccerTicket::findorfail($id);

        return view('dashboard.buy_tickets_soccer_fixture',compact('fixture_details'));
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

        return view("dashboard.buy_tickets_soccer_pay",compact('pay','ticket_id'));
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
                        'tickets_available' => request('tickets_available') - request('purchase_number')
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
            return redirect("/home");
    }

    public function calculate_roi(){

    }

    public function deposits(){

        $user_id = auth()->user()->id;
        $user = User::findorfail($user_id);

        return view('dashboard.deposits',compact('user'));
    }

    public function fund_wallet(){

        $user_id = auth()->user()->id;
        $user = User::findorfail($user_id);

        return view ("dashboard.fund_wallet",compact('user'));
    }

    public function fund_wallet_create(){

//        $data = request()->validate([
//            'amount' => 'required',
//        ]);
//        $list = Http::withHeaders([
//            "X-CC-Api-Key" => "ba6e8f85-1992-44a8-9aa6-e5ac2b102423",
//            "X-CC-Version" => "2018-03-22"
//        ])->get("https://api.commerce.coinbase.com/charges");
//        dd($list->json());
//        //Create a charge
//        $result = Http::withHeaders([
//            "Content-Type" => "application/json",
//            "X-CC-Api-Key" => "ba6e8f85-1992-44a8-9aa6-e5ac2b102423",
//            "X-CC-Version" => "2018-03-22"
//        ])->post("https://api.commerce.coinbase.com/charges", [
//            "name" => "Wallet TopUp",
//            "description" => "Funds top up for your account",
//            "pricing_type" => "fixed_price",
//            "local_price" => [
//                "amount" => 300,
//                "currency" => "USD"
//            ],
//        ]);
//
//        dd($result->json());
    }

    public function index()
    {
        //Get logged in user
        $auth_user_id = auth()->user()->id;

        $user = User::findorfail($auth_user_id);

        $ticket_details = DB::table('soccer_pays')
                            ->where([
                                ['email', '=', auth()->user()->email],
                                ['isSold', '=', 0]
                            ])
                            ->get();

        $ticket_number = (count($ticket_details));

        return view('home', compact('user','ticket_number'));
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

        $user = User::findorfail($user_id);

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
        return view('dashboard.profile', compact('user','ip_address','device','browser','operating_system','success'))->withSuccess('Profile Updated');

    }

    public function view_profile(Request $request){

        //Get logged in user
        $user_id = auth()->user()->id;
        $user = User::findorfail($user_id);

        //Get Ip Address
        $ip_address = $request->ip();

        //Get operating system, device and browser details
        $agent = new Agent();
        $operating_system = $agent->platform();
        $browser = $agent->browser();
        $device = $agent->device();

        return view('dashboard.profile', compact('user','ip_address','device','browser','operating_system'));
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
