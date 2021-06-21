@extends('layouts.base')
@section('title', 'BasketBall Tickets')

@section('content')

        <div class="card-body">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/buy_tickets" style="text-decoration: none !important;color:#4c84ff;">Buy Tickets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">BasketBall</li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
        <div class='row'>
            @foreach($tickets as $ticket)
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">
                                {{ucwords($ticket->country)}} : {{ucwords($ticket->competition)}}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <img
                                        src="{{ asset('/images/arsenal-logo.png') }}"
                                        height="30px"
                                        width="30px"
                                        alt="">
                                    {{$ticket->home_team }} - {{$ticket->away_team}}
                                    <img
                                        src="{{asset('/images/chelsea-logo.png')}}"
                                        height="30px"
                                        width="30px"
                                        alt="">
                                </h5>
                                <p class="card-text">{{$ticket->fixture_date}} | {{$ticket->fixture_time}} GMT</p>
                                <h3 class="card-text">${{$ticket->ticket_price}}</h3>
                                <p class="card-text">Expected Profit: {{$ticket->expected_profit}}%</p>
                                <p class="card-text">Tickets Available: {{$ticket->tickets_available}}</p>
                                <a href="/buy_tickets/basketball/{{$ticket->id}}/{{$ticket->home_team}}_{{$ticket->away_team}}" class="btn btn-primary">BUY NOW</a>
                            </div>
                            <div class="card-footer text-muted">
                                {{$ticket->time_left}} days left to expire
                            </div>
                        </div>
                    </div>
            @endforeach
        
@endsection