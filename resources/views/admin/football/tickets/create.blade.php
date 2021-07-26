@extends('layouts.adminBase')
@section('title', 'Add FootBall Ticket')

@section('content')

    <div class="card-body">
       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page">Add FootBall Ticket</li>
            </ol>
        </nav>

    </div>
    <!-- Top Statistics -->
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add FootBall Ticket</h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" method='POST' enctype="multipart/form-data" action="/admin/football/add">
                        @csrf
                        <div class="form-group">
                            <label>Home_Team</label>
                            <select name="home_team" class="form-control" id="" required>
                                <option value="">No team selected</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->team_name }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Away_Team</label>
                            <select name="away_team" class="form-control" id="" required>
                                <option value="">No team selected</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->team_name }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country"  required>
                        </div>
                        <div class="form-group">
                            <label>Fixture_Date</label>
                            <input type="text" class="form-control" name="fixture_date"  required>
                        </div>
                        <div class="form-group">
                            <label>Fixture_Time</label>
                            <input type="text" class="form-control" name="fixture_time"  required>
                        </div>
                        <div class="form-group">
                            <label>Competition</label>
                            <input type="text" class="form-control" name="competition"  required>
                        </div>
                        <div class="form-group">
                            <label>Home_Team_Logo(Choose the team name again)</label>
                             <select name="home_team_logo" class="form-control" id="" required>
                                <option value="">No team selected</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->logo }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Away_Team_Logo(Choose the team name again)</label>
                             <select name="away_team_logo" class="form-control" id="" required>
                                <option value="">No team selected</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->logo }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ticket_Price</label>
                            <input type="text" class="form-control" name="ticket_price" required>
                        </div>
                        <div class="form-group">
                            <label>Expected_Profit</label>
                            <input type="text" class="form-control" name="expected_profit" required>
                        </div>
                        <div class="form-group">
                            <label>Tickets_Available</label>
                            <input type="text" class="form-control" name="tickets_available"  required>
                        </div>
                        <div class="form-group">
                            <label>Time_Left</label>
                            <input type="text" class="form-control" name="time_left"  required>
                        </div>

                        <div class="form-footer">
                            <button type="submit"  name='btn-add' class="btn btn-ticket btn-default">Add FootBall Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection