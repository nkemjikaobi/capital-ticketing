<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FootBallTicket;
use App\Models\FootBallTeam;
use Illuminate\Support\Facades\DB;

class AdminFootBallController extends Controller
{
     public function editfootballTeam(Request $request){
        if($request->hasFile('logo')){
            $imagePath = request('logo')->store('foot_ball_team_logos','public');
          $updatedTeam =  DB::table('foot_ball_teams')
                       ->where('id', '=', request('id'))
                       ->update([
                           'team_name' => request('team_name'),
                           'logo' => $imagePath,
                       ]);
        }
        else{
        $updatedTeam =  DB::table('foot_ball_teams')
                       ->where('id', '=', request('id'))
                       ->update([
                           'team_name' => request('team_name'),
                           'logo' => request('logo_backup')
                       ]);
        }
        
            if($updatedTeam){
                return redirect('/admin/football/teams')->with('success', 'Football Team Updated');
            }
            else
            {
                return redirect('/admin/football/teams')->with('error', 'An error occurred');
            }
    }

    public function editfootballTicket(Request $request){
        if($request->hasFile('home_team_logo') && $request->hasFile('away_team_logo')){
            $homeLogoPath = request('home_team_logo')->store('foot_ball_ticket_logos','public');
            $awayLogoPath = request('away_team_logo')->store('foot_ball_ticket_logos','public');
               $updatedTicket =  DB::table('foot_ball_tickets')
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
                $homeLogoPath = request('home_team_logo')->store('foot_ball_ticket_logos','public');

               $updatedTicket =  DB::table('foot_ball_tickets')
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
                $awayLogoPath = request('away_team_logo')->store('foot_ball_ticket_logos','public');
               $updatedTicket =  DB::table('foot_ball_tickets')
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
                    $updatedTicket =  DB::table('foot_ball_tickets')
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
                return redirect('/admin/football/tickets')->with('success', 'Football Ticket Updated');
            }
            else
            {
                return redirect('/admin/football/tickets')->with('error', 'An error occurred');
            }
    }
    public function footballTicketAdd(){

            $createdTicket =  FootballTicket::create([
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
                return redirect('/admin/football/tickets')->with('success', 'Football Ticket Created');
            }
            else
            {
                return redirect('/admin/football/tickets')->with('error', 'An error occurred');
            }
    }
    public function footballTeamAdd(){

            $imagePath = request('logo')->store('football_team_logos','public');
            $createdTeam =  FootballTeam::create([
                                'team_name' => request('team_name'),
                                'logo' => $imagePath,
                            ]);

            if($createdTeam){
                return redirect('/admin/football/teams')->with('success', 'Football Team Created');
            }
            else
            {
                return redirect('/admin/football/teams')->with('error', 'An error occurred');
            }
    }

    public function footballTicketCreate(){
        $teams = FootballTeam::all();
        return view('admin.football.tickets.create',compact('teams'));
    }

    public function footballTeamCreate(){
        return view('admin.football.teams.create');
    }

    public function footballTicketDelete(){
        $ticket =  DB::table('foot_ball_tickets')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($ticket){
            return redirect('/admin/football/tickets')->with('success', 'Football Ticket Deleted');
        }
        else{
            return redirect('/admin/football/tickets')->with('error', 'An error occurred');
        }
    }

    public function footballTeamDelete(){
        $team =  DB::table('foot_ball_teams')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($team){
            return redirect('/admin/football/teams')->with('success', 'Football Team Deleted');
        }
        else{
            return redirect('/admin/football/teams')->with('error', 'An error occurred');
        }
    }

    public function footballTeamEdit($id){
        $team = FootballTeam::find($id);
        return view('admin.football.teams.edit',compact('team'));
    }

    public function footballTicketEdit($id){
        $ticket = FootballTicket::find($id);
        return view('admin.football.tickets.edit',compact('ticket'));
    }

    public function footballTeamIndex(){
        $footballTeams = FootballTeam::paginate(10);
        return view('admin.football.teams.index',compact('footballTeams'));
    }

    public function footballTicketIndex(){
        $footballTickets = FootballTicket::paginate(10);
        return view('admin.football.tickets.index',compact('footballTickets'));
    }
}
