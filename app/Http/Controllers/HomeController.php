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
       "redirect_url" => "https://capitalticketing.herokuapp.com/deposits",
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

        //Monitor for confirmed payments and update user balance
        $transact_details = DB::table('deposits')
            ->where([
                ['customer_email', '=', auth()->user()->email],
                ['isCredited', '=', 0],
                ['transaction_status', '=', 'charge:confirmed']
                ])
            ->orderBy('id','desc')
            ->get();
        
        //Get the local amount and isCredited and put in array
        $local_amount = [];
        $isCredited = [];
        $code = [];

        foreach($transact_details as $tr){
            $local_amount[] = $tr->local_amount; 
            $isCredited[] = $tr->isCredited; 
            $code[] = $tr->code; 
        }

        for($i = 0; $i < count($transact_details); $i++){

           $portfolio = DB::table('portfolios')
            ->where('user_id', '=', auth()->user()->id)
            ->update([
                'balance' =>  auth()->user()->portfolio->balance + $local_amount[$i]
            ]);
            
            if($portfolio){
               
                DB::table('deposits')
                    ->where([
                        ['code', '=', $code[$i]]
                        ])
                    ->update([
                        'isCredited' =>  1
                    ]);
            }
           
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
