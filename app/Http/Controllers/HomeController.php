<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Portfolio;
use App\Models\SoccerPay;
use App\Models\BasketBallPay;
use App\Models\FootBallPay;
use App\Models\CricketPay;
use App\Models\SoccerTeam;
use App\Models\SoccerTicket;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChargeCreatedMail;
use Illuminate\Support\Facades\Route;

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
        $sellers = DB::table('users')
                ->join('portfolios', 'users.id', '=', 'portfolios.user_id')
                ->where([
                            ['account_type', '=', '2'],
                            ['isVerified', '=', 1],
                            ['isDisabled', '=', '0'],
                            ['portfolios.balance','>','0'],
                            ['mobile','!==','null']
                        ])
                ->get();
        return view ("dashboard.fund_wallet", compact('sellers'));
    }

    public function fund_wallet_create(Request $request){

        if(auth()->user()->isDisabled == '1'){
            return redirect('/home')->with('error', 'Account has been suspended..Contact us for more info');
        }

        if(auth()->user()->isVerified == '0'){
            if(auth()->user()->verification == 'not agent'){
                return redirect('/profile')->with('error', 'Upload a valid identification');
            }
            else if(auth()->user()->mobile == 'null'){
                return redirect('/profile')->with('error', 'Add your phone number');
            }
            else{
                return redirect('/profile')->with('error', 'Your ID has not been verified yet');
            }
        }
        else{
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
            "cancel_url" => "https://capitalticketing.herokuapp.com/deposits"
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
                $price = $result['data']['pricing']['local']['amount'];

                if($deposits){
                    //redirect the users to make payment
                    //Mail::to(auth()->user()->email)->send(new ChargeCreatedMail($price));
                    return redirect("$redirect_url");
                }
                else{
                    return redirect("/home");
                }
        }
    }

    public function index()
    {
        //Get soccer ticket details
        $soccer_ticket_details = DB::table('soccer_pays')
                            ->where([
                                ['email', '=', auth()->user()->email],
                                ['isSold', '=', 0]
                            ])
                            ->get();

        //Get basketball ticket details
        $basketball_ticket_details = DB::table('basket_ball_pays')
                            ->where([
                                ['email', '=', auth()->user()->email],
                                ['isSold', '=', 0]
                            ])
                            ->get();

        //Get football ticket details
        $football_ticket_details = DB::table('foot_ball_pays')
                            ->where([
                                ['email', '=', auth()->user()->email],
                                ['isSold', '=', 0]
                            ])
                            ->get();

        //Get basketball ticket details
        $cricket_ticket_details = DB::table('cricket_pays')
                            ->where([
                                ['email', '=', auth()->user()->email],
                                ['isSold', '=', 0]
                            ])
                            ->get();

        $ticket_number = (count($soccer_ticket_details)) + (count($basketball_ticket_details)) + (count($football_ticket_details)) + (count($cricket_ticket_details));

        $current_roi = 0;

        //Get all soccer roi's
        $soccer_roi = DB::table('soccer_pays')
                ->where([
                    ['email', '=', auth()->user()->email],
                    ['transaction_status', '=', 1],
                    ['isSold', '=', 0]
                ])
                ->get();

        //Get the soccer roi and put in array
        $soccer_rois = [];
        foreach($soccer_roi as $sr){
            $soccer_rois[] = $sr->roi; 
        }
        
        
        for($i = 0; $i < count($soccer_rois); $i++){
            $current_roi = $current_roi + $soccer_rois[$i];
        }

        //Get all basketball roi's
        $basketball_roi = DB::table('basket_ball_pays')
                ->where([
                    ['email', '=', auth()->user()->email],
                    ['transaction_status', '=', 1],
                    ['isSold', '=', 0]
                ])
                ->get();

        //Get the basketball roi and put in array
        $basketball_rois = [];
        foreach($basketball_roi as $br){
            $basketball_rois[] = $br->roi; 
        }
         

        for($i = 0; $i < count($basketball_rois); $i++){
            $current_roi = $current_roi + $basketball_rois[$i];
        }

        //Get all football roi's
        $football_roi = DB::table('foot_ball_pays')
                ->where([
                    ['email', '=', auth()->user()->email],
                    ['transaction_status', '=', 1],
                    ['isSold', '=', 0]
                ])
                ->get();

        //Get the football roi and put in array
        $football_rois = [];
        foreach($football_roi as $sr){
            $football_rois[] = $sr->roi; 
        }
        
        
        for($i = 0; $i < count($football_rois); $i++){
            $current_roi = $current_roi + $football_rois[$i];
        }

        //Get all cricket roi's
        $cricket_roi = DB::table('cricket_pays')
                ->where([
                    ['email', '=', auth()->user()->email],
                    ['transaction_status', '=', 1],
                    ['isSold', '=', 0]
                ])
                ->get();

        //Get the cricket roi and put in array
        $cricket_rois = [];
        foreach($cricket_roi as $br){
            $cricket_rois[] = $br->roi; 
        }
         

        for($i = 0; $i < count($cricket_rois); $i++){
            $current_roi = $current_roi + $cricket_rois[$i];
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

         $update_roi = DB::table('portfolios')
                        ->where('user_id', '=', auth()->user()->id)
                        ->update([
                            'roi' => $current_roi
                        ]);

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
             //Change sold status for soccer
             $soccer_sold = DB::table('soccer_pays')
                 ->where('id','=', request('id'))
                 ->update([
                     'isSold' => 1
                 ]);

             //Change sold status for basketball
             $basketball_sold = DB::table('basket_ball_pays')
                 ->where('id','=', request('id'))
                 ->update([
                     'isSold' => 1
                 ]);

             //Change sold status for football
             $football_sold = DB::table('foot_ball_pays')
                 ->where('id','=', request('id'))
                 ->update([
                     'isSold' => 1
                 ]);

             //Change sold status for cricket
             $cricket_sold = DB::table('cricket_pays')
                 ->where('id','=', request('id'))
                 ->update([
                     'isSold' => 1
                 ]);
             if($soccer_sold || $basketball_sold || $football_sold || $cricket_sold){
                return redirect("/home")->with('success','Ticket sold successfully');
             }
         }
         else{
             return redirect("/home")->with('error','Balance could not be updated...Please try again later');
         }
    }

    public function transfer_funds(){
        return view('dashboard.transfer_funds');
    }

    public function transfer_funds_transfer(){

        $recepient_user_details = DB::table('users')
                                            ->where('email', '=', request('email'))
                                            ->get('id');
                                            //dd($recepient_user_details);
            if(count($recepient_user_details) > 0){
           
            if(request('balance') >= request('amount')){
                        $calculate_seller_balance = DB::table('portfolios')
                                                ->where('user_id', '=', auth()->user()->id)
                                                ->update([
                                                    'balance' => request('balance') - request('amount')
                                                ]);

                            if($calculate_seller_balance){
                                
                                if($recepient_user_details){
                                    foreach($recepient_user_details as $rac){
                                            $recepient_portfolio_details = DB::table('portfolios')
                                                                        ->where('user_id', '=', $rac->id)
                                                                        ->get();

                                                foreach($recepient_portfolio_details as $rpd){
                                                    $calaculate_receipient_update = DB::table('portfolios')
                                                                                ->where('user_id', '=', $rac->id)
                                                                                ->update([
                                                                                    'balance' => $rpd->balance + request('amount')
                                                                                ]);
                                                }
                                        
                                        }
                            
                                        if($calaculate_receipient_update){
                                            return redirect('/home')->with('success','Transfer Successful');
                                        }
                                }
                            
                                
                            }
                    }
                    else{
                        return redirect('/transfer_funds')->with('error','Insufficient Funds');
                    }
            }
            else{
                return redirect('/transfer_funds')->with('error','Check that the email is valid and registered');
            }
           
    }

    public function update_profile(){
        
        $update_profile = DB::table('users')
                        ->where('email', '=', auth()->user()->email)
                        ->update([
                            'firstname' => request('firstname'),
                            'lastname' => request('lastname'),
                            'mobile' => request('mobile')
                        ]);
        if(request('verification') !== null){
            $imagePath = request('verification')->store('verifications','public');
            $verification = DB::table('users')
                        ->where('email', '=', auth()->user()->email)
                        ->update([
                            'verification' => $imagePath,   
                        ]);
        }

        if($update_profile){
            return redirect()->back()->with('success','Profile Updated');
        }
        else if($verification){
            return redirect()->back()->with('success','Image Upload Successful');
        }
        
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

        $soccer_tickets = DB::table('soccer_pays')
                    ->where('email', '=', auth()->user()->email)
                    ->get();

        $basketball_tickets = DB::table('basket_ball_pays')
                    ->where('email', '=', auth()->user()->email)
                    ->get();

        $football_tickets = DB::table('foot_ball_pays')
                    ->where('email', '=', auth()->user()->email)
                    ->get();

        $cricket_tickets = DB::table('cricket_pays')
                    ->where('email', '=', auth()->user()->email)
                    ->get();

        return view("dashboard.view_tickets", compact('soccer_tickets','basketball_tickets','football_tickets','cricket_tickets'));
    }

    public function withdrawals(){

        $withdrawals = DB::table('withdrawals')
            ->where('email', '=', auth()->user()->email)
            ->orderBy("id","desc")
            ->get();

        return view ('dashboard.withdrawals',compact('withdrawals'));
    }

    public function withdraw(){

        return view ('dashboard.withdraw');
    }

    public function withdraw_funds(){

        $roi = auth()->user()->portfolio->roi;

        if(request('amount') <= $roi){
            $withdraw = Withdrawal::create([
                        'amount' => request('amount'),
                        'payment_type' => request('payment_type'),
                        'wallet_address' => request('wallet_address'),
                        'email' => auth()->user()->email,
                        'status' => 0
                    ]);

            if($withdraw){
                return redirect('/withdrawals')->with('success','Withdrawal Initiated');
            }
            else{
                return redirect()->back()->with('error','An error occurred');
            }
        }
        else{
            return redirect()->back()->with('error', 'Amount requested is greater than ROI');
        }

    }
}
