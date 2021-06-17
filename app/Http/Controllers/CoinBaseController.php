<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoinBaseController extends Controller
{
    public function webhook(Request $request){

        $result = $request->all();

        DB::table('deposits')
            ->where('code', '=', $result['event']['data']['code'])
            ->update([
                'transaction_status' => $result['event']['type'],
                'updated_at' => $result['event']['data']['created_at']
            ]);
 
            
        // return response()->json([
        //     'code' => $result['event']['data']['code']
        // ]);
        return $request->all();
    }
}
