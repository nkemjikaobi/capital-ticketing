<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChargeCreatedMail;
use App\Mail\ChargeConfirmedMail;
use App\Mail\ChargeFailedMail;

class CoinBaseController extends Controller
{
    public function webhook(Request $request){

        $result = $request->all();

        //Update the transaction status matching the code
        DB::table('deposits')
            ->where('code', '=', $result['event']['data']['code'])
            ->update([
                'transaction_status' => $result['event']['type'],
                'updated_at' => $result['event']['data']['created_at'],
            ]);

            $email = $result['event']['data']['metadata']['customer_email'];
            $price = $result['data']['pricing']['local']['amount'];

            //send mails in accordance to status update
            // if($result['event']['type'] == "charge:confirmed"){
            //     Mail::to($email)->send(new ChargeConfirmedMail($price));
            // }
            // else if($result['event']['type'] == "charge:failed"){
            //     Mail::to($email)->send(new ChargeFailedMail($price));
            // }
            
        return response()->json([
            'code' => $result['event']['data']['code']
        ]);

    }
}
