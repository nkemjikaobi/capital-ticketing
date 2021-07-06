<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoccerTicket;

class WelcomeController extends Controller
{
    public function welcome(){

        //Get Soccer Tickets
        $tickets = SoccerTicket::take(4)->get();
        
        return view('welcome', compact('tickets'));
    }
}
