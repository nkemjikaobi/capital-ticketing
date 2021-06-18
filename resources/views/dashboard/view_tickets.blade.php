@extends('layouts.base')
@section('title', 'View Tickets')

@section('content')

        <div class="card-body">
            @include('.inc.messages')
            @if (!empty($success))
                {{ $success }}
            @endif
            <div class='alert alert-primary '>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong class=''>Once you sell a ticket, the current ROI is what gets credited in your account.</strong>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">View Tickets</li>
                </ol>
            </nav>

        </div>
    <!-- Top Statistics -->
    <div class="row">
        <div class="col-lg-12">

            <!--TABLE STARTS -->
            <div class='card-body'>
                <div class='table-responsive'>
                @if(count($soccer_tickets) > 0 && count($basketball_tickets))
                    <!-- Table -->
                    <table id='dataTable' class='table table-bordered table-hover' width='100%' cellspacing='0'>
                        <thead>
                        <tr>
                            <th>Fixture</th>
                            <th>Country</th>
                            <th>Ticket Price</th>
                            <th>Number Bought</th>
                            <th>Amount Paid</th>
                            <th>Fixture Time</th>
                            <th>Fixture Date</th>
                            <th>Expected Profit</th>
                            <th>ROI</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <style>
                            td{
                                width: auto;
                            }
                            td:last-child{
                                width: 250px;
                            }
                        </style>

                        @foreach($soccer_tickets as $soccer_ticket)
                                <tr>
                                    <td>{{$soccer_ticket->home_team}} - {{$soccer_ticket->away_team}}</td>
                                    <td>{{$soccer_ticket->country}}</td>
                                    <td>${{$soccer_ticket->ticket_price}}</td>
                                    <td>{{$soccer_ticket->purchase_number}}</td>
                                    <td>{{$soccer_ticket->final_pay}}</td>
                                    <td>{{$soccer_ticket->fixture_time}}</td>
                                    <td>{{$soccer_ticket->fixture_date}}</td>
                                    <td>{{$soccer_ticket->expected_profit}}%</td>
                                    <td>{{$soccer_ticket->roi}}</td>
                                    <td>
                                        @if($soccer_ticket->transaction_status == 1)
                                            <button style='color: white;background:green;border-radius:5px;padding:10px;' id='status'>ACTIVE</button>
                                        @else
                                            <button style='color: white;background:red;border-radius:5px;padding:10px;' id='status'>INACTIVE</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($soccer_ticket->isSold == 1)
                                            <button href="#!" style='color: white;background:green;border-radius:5px;padding:10px;' id='sell'>SOLD</button>
                                        @else
                                            @if($soccer_ticket->transaction_status == 1)
                                                <form method="POST" action="/sell_tickets">
                                                    @csrf
                                                    <input type="hidden" value={{$soccer_ticket->id}} name="id"/>
                                                    <input type="hidden" value={{$soccer_ticket->roi}} name="roi"/>
                                                    <input type="hidden" value={{$soccer_ticket->tickets_available}} name="tickets_available"/>
                                                    <button type="submit" style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>SELL</button>
                                                </form>

                                            @else
                                                <button href="#!" style='color: white;background:red;border-radius:5px;padding:10px;' id='sell'>CAN'T SELL</button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($basketball_tickets as $basketball_ticket)
                            <tr>
                                <td>{{$basketball_ticket->home_team}} - {{$basketball_ticket->away_team}}</td>
                                <td>{{$basketball_ticket->country}}</td>
                                <td>${{$basketball_ticket->ticket_price}}</td>
                                <td>{{$basketball_ticket->purchase_number}}</td>
                                <td>{{$basketball_ticket->final_pay}}</td>
                                <td>{{$basketball_ticket->fixture_time}}</td>
                                <td>{{$basketball_ticket->fixture_date}}</td>
                                <td>{{$basketball_ticket->expected_profit}}%</td>
                                <td>{{$basketball_ticket->roi}}</td>
                                <td>
                                    @if($basketball_ticket->transaction_status == 1)
                                        <button style='color: white;background:green;border-radius:5px;padding:10px;' id='status'>ACTIVE</button>
                                    @else
                                        <button style='color: white;background:red;border-radius:5px;padding:10px;' id='status'>INACTIVE</button>
                                    @endif
                                </td>
                                <td>
                                    @if($basketball_ticket->isSold == 1)
                                        <button href="#!" style='color: white;background:green;border-radius:5px;padding:10px;' id='sell'>SOLD</button>
                                    @else
                                        @if($basketball_ticket->transaction_status == 1)
                                            <form method="POST" action="/sell_tickets">
                                                @csrf
                                                <input type="hidden" value={{$basketball_ticket->id}} name="id"/>
                                                <input type="hidden" value={{$basketball_ticket->roi}} name="roi"/>
                                                <input type="hidden" value={{$basketball_ticket->tickets_available}} name="tickets_available"/>
                                                <button type="submit" style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>SELL</button>
                                            </form>

                                        @else
                                            <button href="#!" style='color: white;background:red;border-radius:5px;padding:10px;' id='sell'>CAN'T SELL</button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You do not have any active ticket...</p>
                    @endif
                </div>
            </div>
            <!--TABLE ENDS-->

        </div>
    </div>
@endsection