<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoccerTicket;
use App\Models\SoccerTeam;
use Illuminate\Support\Facades\DB;

class AdminSoccerController extends Controller
{
    public function editSoccerTeam(Request $request){
        if($request->hasFile('logo')){
            $imagePath = request('logo')->store('soccer_team_logos','public');
          $updatedTeam =  DB::table('soccer_teams')
                       ->where('id', '=', request('id'))
                       ->update([
                           'team_name' => request('team_name'),
                           'logo' => $imagePath,
                       ]);
        }
        else{
        $updatedTeam =  DB::table('soccer_teams')
                       ->where('id', '=', request('id'))
                       ->update([
                           'team_name' => request('team_name'),
                           'logo' => request('logo_backup')
                       ]);
        }
        
            if($updatedTeam){
                return redirect('/admin/soccer/teams')->with('success', 'Soccer Team Updated');
            }
            else
            {
                return redirect('/admin/soccer/teams')->with('error', 'An error occurred');
            }
    }

    public function editSoccerTicket(){
        $updatedTicket =  DB::table('soccer_tickets')
                       ->where('id', '=', request('id'))
                       ->update([
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

            if($updatedTicket){
                return redirect('/admin/soccer/tickets')->with('success', 'Soccer Ticket Updated');
            }
            else
            {
                return redirect('/admin/soccer/tickets')->with('error', 'An error occurred');
            }
    }
    public function soccerTicketAdd(){

            $createdTicket =  SoccerTicket::create([
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
                return redirect('/admin/soccer/tickets')->with('success', 'Soccer Ticket Created');
            }
            else
            {
                return redirect('/admin/soccer/tickets')->with('error', 'An error occurred');
            }
    }
    public function soccerTeamAdd(){

            $imagePath = request('logo')->store('soccer_team_logos','public');
            $createdTeam =  SoccerTeam::create([
                                'team_name' => request('team_name'),
                                'logo' => $imagePath,
                            ]);

            if($createdTeam){
                return redirect('/admin/soccer/teams')->with('success', 'Soccer Team Created');
            }
            else
            {
                return redirect('/admin/soccer/teams')->with('error', 'An error occurred');
            }
    }

    public function soccerTicketCreate(){
        $teams = SoccerTeam::all();
        return view('admin.soccer.tickets.create',compact('teams'));
    }

    public function soccerTeamCreate(){
        return view('admin.soccer.teams.create');
    }

    public function soccerTicketDelete(){
        $ticket =  DB::table('soccer_tickets')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($ticket){
            return redirect('/admin/soccer/tickets')->with('success', 'Soccer Ticket Deleted');
        }
        else{
            return redirect('/admin/soccer/tickets')->with('error', 'An error occurred');
        }
    }

    public function soccerTeamDelete(){
        $team =  DB::table('soccer_teams')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($team){
            return redirect('/admin/soccer/teams')->with('success', 'Soccer Team Deleted');
        }
        else{
            return redirect('/admin/soccer/teams')->with('error', 'An error occurred');
        }
    }

    public function soccerTeamEdit($id){
        $team = SoccerTeam::find($id);
        return view('admin.soccer.teams.edit',compact('team'));
    }

    public function soccerTicketEdit($id){
        $ticket = SoccerTicket::find($id);
        return view('admin.soccer.tickets.edit',compact('ticket'));
    }

    public function soccerTeamIndex(){
        $soccerTeams = SoccerTeam::paginate(10);
        return view('admin.soccer.teams.index',compact('soccerTeams'));
    }

    public function soccerTicketIndex(){
        $soccerTickets = SoccerTicket::paginate(10);
        return view('admin.soccer.tickets.index',compact('soccerTickets'));
    }
}
