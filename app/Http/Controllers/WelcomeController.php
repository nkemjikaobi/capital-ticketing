<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoccerTicket;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome(){

        //Get Soccer Tickets
        $tickets = DB::table('soccer_tickets')
                ->inRandomOrder()
                ->limit(4)
                ->get();
        
        return view('welcome', compact('tickets'));
    }
}
