<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoinBaseController extends Controller
{
    public function webhook(Request $request){

        return $request->all();
    }
}
