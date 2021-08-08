<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasketBallTicket;
use App\Models\BasketBallPay;
use App\Models\BasketBallTeam;
use Illuminate\Support\Facades\DB;

class AdminBasketBallController extends Controller
{
    public function basketballPayIndex(){
        $basketballPays = BasketBallPay::paginate(10);
        return view('admin.basketball.pays.index',compact('basketballPays'));
    }

    public function basketballPayEdit($id){
        $pay = BasketBallPay::find($id);
        return view('admin.basketball.pays.edit',compact('pay'));
    }

    public function editbasketballPay(){
           $updatedPay =  DB::table('basket_ball_pays')
                    ->where('id', '=', request('id'))
                    ->update([
                        'home_team' => request('home_team'),
                        'away_team' => request('away_team'),
                        'country' => request('country'),
                        'purchase_number' => request('purchase_number'),
                        'final_pay' => request('final_pay'),
                        'fixture_date' => request('fixture_date'),
                        'fixture_time' => request('fixture_time'),
                        'competition' => request('competition'),
                        'ticket_price' => request('ticket_price'),
                        'expected_profit' => request('expected_profit'),
                        'tickets_available' => request('tickets_available'),
                        'time_left' => request('time_left'),
                        'transaction_status' => request('transaction_status'),
                        'email' => request('email'),
                        'roi' => request('roi'),
                        'isSold' => request('isSold')
                    ]);

            if($updatedPay){
                return redirect('/admin/basketball/pays')->with('success', 'BasketBall Pay Updated');
            }
            else
            {
                return redirect('/admin/basketball/pays')->with('error', 'An error occurred');
            }
    }
     public function editbasketballTeam(Request $request){
        if($request->hasFile('logo')){
            $imagePath = request('logo')->store('basket_ball_team_logos','public');
          $updatedTeam =  DB::table('basket_ball_teams')
                       ->where('id', '=', request('id'))
                       ->update([
                           'team_name' => request('team_name'),
                           'logo' => $imagePath,
                       ]);
        }
        else{
        $updatedTeam =  DB::table('basket_ball_teams')
                       ->where('id', '=', request('id'))
                       ->update([
                           'team_name' => request('team_name'),
                           'logo' => request('logo_backup')
                       ]);
        }
        
            if($updatedTeam){
                return redirect('/admin/basketball/teams')->with('success', 'Basketball Team Updated');
            }
            else
            {
                return redirect('/admin/basketball/teams')->with('error', 'An error occurred');
            }
    }

    public function editbasketballTicket(Request $request){
       if($request->hasFile('home_team_logo') && $request->hasFile('away_team_logo')){
            $homeLogoPath = request('home_team_logo')->store('basket_ball_ticket_logos','public');
            $awayLogoPath = request('away_team_logo')->store('basket_ball_ticket_logos','public');
               $updatedTicket =  DB::table('basket_ball_tickets')
                       ->where('id', '=', request('id'))
                       ->update([
                           'away_team' => request('away_team'),
                           'country' => request('country'),
                           'fixture_date' => request('fixture_date'),
                           'fixture_time' => request('fixture_time'),
                           'competition' => request('competition'),
                           'home_team_logo' => $homeLogoPath,
                           'away_team_logo' => $awayLogoPath,
                           'ticket_price' => request('ticket_price'),
                           'expected_profit' => request('expected_profit'),
                           'tickets_available' => request('tickets_available'),
                           'time_left' => request('time_left'),
                       ]);
        }
        else if($request->hasFile('home_team_logo')){
                $homeLogoPath = request('home_team_logo')->store('basket_ball_ticket_logos','public');

               $updatedTicket =  DB::table('basket_ball_tickets')
                       ->where('id', '=', request('id'))
                       ->update([
                           'home_team' => request('home_team'),
                           'away_team' => request('away_team'),
                           'country' => request('country'),
                           'fixture_date' => request('fixture_date'),
                           'fixture_time' => request('fixture_time'),
                           'competition' => request('competition'),
                           'home_team_logo' => $homeLogoPath,
                            'away_team_logo' => request('away_team_logo_backup'),
                           'ticket_price' => request('ticket_price'),
                           'expected_profit' => request('expected_profit'),
                           'tickets_available' => request('tickets_available'),
                           'time_left' => request('time_left'),
                       ]);
        }
            else if($request->hasFile('away_team_logo')){
                $awayLogoPath = request('away_team_logo')->store('basket_ball_ticket_logos','public');
               $updatedTicket =  DB::table('basket_ball_tickets')
                       ->where('id', '=', request('id'))
                       ->update([
                           'home_team' => request('home_team'),
                           'away_team' => request('away_team'),
                           'country' => request('country'),
                           'fixture_date' => request('fixture_date'),
                           'fixture_time' => request('fixture_time'),
                           'competition' => request('competition'),
                           'home_team_logo' => request('home_team_logo_backup'),
                           'away_team_logo' => $awayLogoPath,
                           'ticket_price' => request('ticket_price'),
                           'expected_profit' => request('expected_profit'),
                           'tickets_available' => request('tickets_available'),
                           'time_left' => request('time_left'),
                       ]);
                }
                else{
                    $updatedTicket =  DB::table('basket_ball_tickets')
                       ->where('id', '=', request('id'))
                       ->update([
                           'home_team' => request('home_team'),
                           'away_team' => request('away_team'),
                           'country' => request('country'),
                           'fixture_date' => request('fixture_date'),
                           'fixture_time' => request('fixture_time'),
                           'competition' => request('competition'),
                           'home_team_logo' => request('home_team_logo_backup'),
                           'away_team_logo' => request('away_team_logo_backup'),
                           'ticket_price' => request('ticket_price'),
                           'expected_profit' => request('expected_profit'),
                           'tickets_available' => request('tickets_available'),
                           'time_left' => request('time_left'),
                       ]);
                    }
        

            if($updatedTicket){
                return redirect('/admin/basketball/tickets')->with('success', 'Basketball Ticket Updated');
            }
            else
            {
                return redirect('/admin/basketball/tickets')->with('error', 'An error occurred');
            }
    }
    public function basketballTicketAdd(){

            $createdTicket =  BasketballTicket::create([
                                'home_team' => request('home_team'),
                                'away_team' => request('away_team'),
                                'country' => request('country'),
                                'fixture_date' => request('fixture_date'),
                                'fixture_time' => request('fixture_time'),
                                'competition' => request('competition'),
                                'home_team_logo' => request('home_team_logo'),
                                'away_team_logo' => request('away_team_logo'),
                                'ticket_price' => request('ticket_price'),
                                'expected_profit' => request('expected_profit'),
                                'tickets_available' => request('tickets_available'),
                                'time_left' => request('time_left'),
                            ]);

            if($createdTicket){
                return redirect('/admin/basketball/tickets')->with('success', 'Basketball Ticket Created');
            }
            else
            {
                return redirect('/admin/basketball/tickets')->with('error', 'An error occurred');
            }
    }
    public function basketballTeamAdd(){

            $imagePath = request('logo')->store('basketball_team_logos','public');
            $createdTeam =  BasketballTeam::create([
                                'team_name' => request('team_name'),
                                'logo' => $imagePath,
                            ]);

            if($createdTeam){
                return redirect('/admin/basketball/teams')->with('success', 'Basketball Team Created');
            }
            else
            {
                return redirect('/admin/basketball/teams')->with('error', 'An error occurred');
            }
    }

    public function basketballTicketCreate(){
        $teams = BasketballTeam::all();
        return view('admin.basketball.tickets.create',compact('teams'));
    }

    public function basketballTeamCreate(){
        return view('admin.basketball.teams.create');
    }

    public function basketballTicketDelete(){
        $ticket =  DB::table('basket_ball_tickets')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($ticket){
            return redirect('/admin/basketball/tickets')->with('success', 'Basketball Ticket Deleted');
        }
        else{
            return redirect('/admin/basketball/tickets')->with('error', 'An error occurred');
        }
    }

    public function basketballTeamDelete(){
        $team =  DB::table('basket_ball_teams')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($team){
            return redirect('/admin/basketball/teams')->with('success', 'Basketball Team Deleted');
        }
        else{
            return redirect('/admin/basketball/teams')->with('error', 'An error occurred');
        }
    }

    public function basketballTeamEdit($id){
        $team = BasketballTeam::find($id);
        return view('admin.basketball.teams.edit',compact('team'));
    }

    public function basketballTicketEdit($id){
        $ticket = BasketballTicket::find($id);
        return view('admin.basketball.tickets.edit',compact('ticket'));
    }

    public function basketballTeamIndex(){
        $basketballTeams = BasketballTeam::paginate(10);
        return view('admin.basketball.teams.index',compact('basketballTeams'));
    }

    public function basketballTicketIndex(){
        $basketballTickets = BasketballTicket::paginate(10);
        return view('admin.basketball.tickets.index',compact('basketballTickets'));
    }
}
