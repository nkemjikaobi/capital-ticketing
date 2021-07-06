@extends('layouts.base')
@section('title', 'BasketBall Tickets')

@section('content')

        <div class="card-body">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active-span" aria-current="page"><a href="/buy_tickets" style="text-decoration: none !important;color:#4c84ff;">Buy Tickets</a></li>
                    <li class="breadcrumb-item active-span" aria-current="page"><a href="/buy_tickets/basketball" style="text-decoration: none !important;color:#4c84ff;">BasketBall</a></li>
                    <li class="breadcrumb-item active-span" aria-current="page">{{$fixture_details->home_team}}_{{$fixture_details->away_team}}</li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Buy ticket for {{$fixture_details->home_team}}-{{$fixture_details->away_team}} </h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" method='POST' action='/buy_tickets/basketball/pay'>
                        @csrf
                        <input type="hidden" name="home_team" value={{$fixture_details->home_team}} />
                        <input type="hidden" name="away_team" value={{$fixture_details->away_team}} />
                        <input type="hidden" name="ticket_id" value={{$fixture_details->id}} />
                        <div class="form-group">
                            <label for="exampleFormControlInput3">Number of tickets you wish to purchase</label>
                            <input type="number" min='1'  name='purchase_number' class="form-control" id="exampleFormControlInput3" placeholder="3" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Price per ticket ($)</label>
                            <input type="text" name='ticket_price' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->ticket_price}} disabled>
                            <input type="hidden" name='ticket_price' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->ticket_price}} >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Available Tickets</label>
                            <input type="text" name='tickets_available' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->tickets_available}} disabled>
                            <input type="hidden" name='tickets_available' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->tickets_available}} >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Expected Profit (%)</label>
                            <input type="text" name='expected_profit' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->expected_profit}} disabled>
                            <input type="hidden" name='expected_profit' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->expected_profit}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Country</label>
                            <input type="text" name='country' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->country}} disabled>
                            <input type="hidden" name='country' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->country}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Competition</label>
                            <input type="text" name='competition' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->competition}} disabled>
                            <input type="hidden" name='competition' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->competition}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Date</label>
                            <input type="text" name='fixture_date' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->fixture_date}} disabled>
                            <input type="hidden" name='fixture_date' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->fixture_date}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Time (GMT)</label>
                            <input type="text" name='fixture_time' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->fixture_time}} disabled>
                            <input type="hidden" name='fixture_time' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->fixture_time}} >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Expires in (days)</label>
                            <input type="text" name='time_left' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->time_left}} disabled>
                            <input type="hidden" name='time_left' class="form-control" id="exampleFormControlPassword3" value={{$fixture_details->time_left}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Available Balance ($)</label>
                            <input type="text" name='balance' class="form-control" id="exampleFormControlPassword3" value={{auth()->user()->portfolio->balance}} disabled>
                            <input type="hidden" name='balance' class="form-control" id="exampleFormControlPassword3" value={{auth()->user()->portfolio->balance}} >
                        </div>
                        <div class="form-footer">
                            <button type="submit"  class="btn btn-ticket btn-default">PROCEED</button>
                        </div>
                    </form>
                </div>
@endsection