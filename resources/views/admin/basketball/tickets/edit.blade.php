@extends('layouts.adminBase')
@section('title', 'Edit BasketBall Ticket')

@section('content')

    <div class="card-body">
       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page">Edit BasketBall Ticket</li>
            </ol>
        </nav>

    </div>
    <!-- Top Statistics -->
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Edit BasketBall Ticket</h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" method='POST' action="/admin/basketball/edit" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value={{ $ticket->id }}>
                        <div class="form-group">
                            <label>Home_Team</label>
                            <input type="text" class="form-control" name="home_team" value={{ $ticket->home_team }} required>
                        </div>
                        <div class="form-group">
                            <label>Away_Team</label>
                            <input type="text" class="form-control" name="away_team" value={{ $ticket->away_team }} required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country"  value={{ $ticket->country }} required>
                        </div>
                        <div class="form-group">
                            <label>Fixture_Date</label>
                            <input type="text" class="form-control" name="fixture_date"  value={{ $ticket->fixture_date }} required>
                        </div>
                        <div class="form-group">
                            <label>Fixture_Time</label>
                            <input type="text" class="form-control" name="fixture_time"  value={{ $ticket->fixture_time }}   required>
                        </div>
                        <div class="form-group">
                            <label>Competition</label>
                            <input type="text" class="form-control" name="competition"  value={{ $ticket->competition }} required>
                        </div>
                        <div class="form-group">
                            <label>Home_Team_Logo</label>
                            <input type="file" class="form-control" name="home_team_logo">
                            <input type="hidden" class="form-control" name="home_team_logo_backup"  value={{ $ticket->home_team_logo }} >
                        </div>
                        <div class="form-group">
                            <label>Away_Team_Logo</label>
                            <input type="file" class="form-control" name="away_team_logo">
                            <input type="hidden" class="form-control" name="away_team_logo_backup"  value={{ $ticket->away_team_logo }} >
                        </div>
                        <div class="form-group">
                            <label>Ticket_Price</label>
                            <input type="text" class="form-control" name="ticket_price"  value={{ $ticket->ticket_price }}   required>
                        </div>
                        <div class="form-group">
                            <label>Expected_Profit</label>
                            <input type="text" class="form-control" name="expected_profit"  value={{ $ticket->expected_profit }} required>
                        </div>
                        <div class="form-group">
                            <label>Tickets_Available</label>
                            <input type="text" class="form-control" name="tickets_available"  value={{ $ticket->tickets_available }} required>
                        </div>
                        <div class="form-group">
                            <label>Time_Left</label>
                            <input type="text" class="form-control" name="time_left"  value={{ $ticket->time_left }}   required>
                        </div>

                        <div class="form-footer">
                            <button type="submit"  name='btn-update' class="btn btn-ticket btn-default">Update BasketBall Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection