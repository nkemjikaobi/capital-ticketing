<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CricketTicket;
use App\Models\CricketTeam;
use Illuminate\Support\Facades\DB;

class AdminCricketController extends Controller
{
     public function editCricketTeam(Request $request){
        if($request->hasFile('logo')){
            $imagePath = request('logo')->store('cricket_team_logos','public');
          $updatedTeam =  DB::table('cricket_teams')
                       ->where('id', '=', request('id'))
                       ->update([
                           'team_name' => request('team_name'),
                           'logo' => $imagePath,
                       ]);
        }
        else{
        $updatedTeam =  DB::table('cricket_teams')
                       ->where('id', '=', request('id'))
                       ->update([
                           'team_name' => request('team_name'),
                           'logo' => request('logo_backup')
                       ]);
        }
        
            if($updatedTeam){
                return redirect('/admin/cricket/teams')->with('success', 'Cricket Team Updated');
            }
            else
            {
                return redirect('/admin/cricket/teams')->with('error', 'An error occurred');
            }
    }

    public function editCricketTicket(Request $request){
       if($request->hasFile('home_team_logo') && $request->hasFile('away_team_logo')){
            $homeLogoPath = request('home_team_logo')->store('cricket_ticket_logos','public');
            $awayLogoPath = request('away_team_logo')->store('cricket_ticket_logos','public');
               $updatedTicket =  DB::table('cricket_tickets')
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
                $homeLogoPath = request('home_team_logo')->store('cricket_ticket_logos','public');

               $updatedTicket =  DB::table('cricket_tickets')
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
                $awayLogoPath = request('away_team_logo')->store('cricket_ticket_logos','public');
               $updatedTicket =  DB::table('cricket_tickets')
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
                    $updatedTicket =  DB::table('cricket_tickets')
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
                return redirect('/admin/cricket/tickets')->with('success', 'Cricket Ticket Updated');
            }
            else
            {
                return redirect('/admin/cricket/tickets')->with('error', 'An error occurred');
            }
    }
    public function cricketTicketAdd(){

            $createdTicket =  CricketTicket::create([
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
                return redirect('/admin/cricket/tickets')->with('success', 'Cricket Ticket Created');
            }
            else
            {
                return redirect('/admin/cricket/tickets')->with('error', 'An error occurred');
            }
    }
    public function cricketTeamAdd(){

            $imagePath = request('logo')->store('cricket_team_logos','public');
            $createdTeam =  CricketTeam::create([
                                'team_name' => request('team_name'),
                                'logo' => $imagePath,
                            ]);

            if($createdTeam){
                return redirect('/admin/cricket/teams')->with('success', 'Cricket Team Created');
            }
            else
            {
                return redirect('/admin/cricket/teams')->with('error', 'An error occurred');
            }
    }

    public function cricketTicketCreate(){
        $teams = CricketTeam::all();
        return view('admin.cricket.tickets.create',compact('teams'));
    }

    public function cricketTeamCreate(){
        return view('admin.cricket.teams.create');
    }

    public function cricketTicketDelete(){
        $ticket =  DB::table('cricket_tickets')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($ticket){
            return redirect('/admin/cricket/tickets')->with('success', 'Cricket Ticket Deleted');
        }
        else{
            return redirect('/admin/cricket/tickets')->with('error', 'An error occurred');
        }
    }

    public function cricketTeamDelete(){
        $team =  DB::table('cricket_teams')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($team){
            return redirect('/admin/cricket/teams')->with('success', 'Cricket Team Deleted');
        }
        else{
            return redirect('/admin/cricket/teams')->with('error', 'An error occurred');
        }
    }

    public function cricketTeamEdit($id){
        $team = CricketTeam::find($id);
        return view('admin.cricket.teams.edit',compact('team'));
    }

    public function cricketTicketEdit($id){
        $ticket = CricketTicket::find($id);
        return view('admin.cricket.tickets.edit',compact('ticket'));
    }

    public function cricketTeamIndex(){
        $cricketTeams = CricketTeam::paginate(10);
        return view('admin.cricket.teams.index',compact('cricketTeams'));
    }

    public function cricketTicketIndex(){
        $cricketTickets = CricketTicket::paginate(10);
        return view('admin.cricket.tickets.index',compact('cricketTickets'));
    }
}
