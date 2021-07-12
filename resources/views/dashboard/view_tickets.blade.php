@extends('layouts.base')
@section('title', 'View Tickets')

@section('content')
<style>
    .table-responsive {
	min-height:.01%;
	overflow-x:auto
}
@media screen and (max-width:767px) {
    .table-responsive {
    width:100%;
    margin-bottom:15px;
    overflow-y:hidden;
    -ms-overflow-style:-ms-autohiding-scrollbar;
    border:1px solid #ddd;
    color: blue !important;
    }
    .table-responsive>.table {
    margin-bottom:0
    }
        .table-responsive>.table>tbody>tr>td, .table-responsive>.table>tbody>tr>th, .table-responsive>.table>tfoot>tr>td, .table-responsive>.table>tfoot>tr>th, .table-responsive>.table>thead>tr>td, .table-responsive>.table>thead>tr>th {
    white-space:nowrap
    }
    .table-responsive>.table-bordered {
    border:0
    }
    .table-responsive>.table-bordered>tbody>tr>td:first-child, .table-responsive>.table-bordered>tbody>tr>th:first-child, .table-responsive>.table-bordered>tfoot>tr>td:first-child, .table-responsive>.table-bordered>tfoot>tr>th:first-child, .table-responsive>.table-bordered>thead>tr>td:first-child, .table-responsive>.table-bordered>thead>tr>th:first-child {
    border-left:0
    }
    .table-responsive>.table-bordered>tbody>tr>td:last-child, .table-responsive>.table-bordered>tbody>tr>th:last-child, .table-responsive>.table-bordered>tfoot>tr>td:last-child, .table-responsive>.table-bordered>tfoot>tr>th:last-child, .table-responsive>.table-bordered>thead>tr>td:last-child, .table-responsive>.table-bordered>thead>tr>th:last-child {
    border-right:0
    }
    .table-responsive>.table-bordered>tbody>tr:last-child>td, .table-responsive>.table-bordered>tbody>tr:last-child>th, .table-responsive>.table-bordered>tfoot>tr:last-child>td, .table-responsive>.table-bordered>tfoot>tr:last-child>th {
    border-bottom:0
    }
}
</style>
        <div class="card-body">
            
            <div class='alert alert-primary '>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong class=''>Once you sell a ticket, the current ROI of the ticket is used to top up your balance.</strong>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active-span" aria-current="page">View Tickets</li>
                </ol>
            </nav>

        </div>
    <!-- Top Statistics -->
    <div class="row">
        <div class="col-lg-12">

            <!--TABLE STARTS -->
            <div class='card-body'>
                <div class='table-responsive'>
                @if(count($soccer_tickets) > 0 || count($basketball_tickets) || count($football_tickets) > 0 || count($cricket_tickets))
                    <!-- Table -->
                    <table id='dataTable' class='table table-bordered table-hover table-responsive' width='100%' cellspacing='0'>
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
                        @foreach($football_tickets as $football_ticket)
                                <tr>
                                    <td>{{$football_ticket->home_team}} - {{$football_ticket->away_team}}</td>
                                    <td>{{$football_ticket->country}}</td>
                                    <td>${{$football_ticket->ticket_price}}</td>
                                    <td>{{$football_ticket->purchase_number}}</td>
                                    <td>{{$football_ticket->final_pay}}</td>
                                    <td>{{$football_ticket->fixture_time}}</td>
                                    <td>{{$football_ticket->fixture_date}}</td>
                                    <td>{{$football_ticket->expected_profit}}%</td>
                                    <td>{{$football_ticket->roi}}</td>
                                    <td>
                                        @if($football_ticket->transaction_status == 1)
                                            <button style='color: white;background:green;border-radius:5px;padding:10px;' id='status'>ACTIVE</button>
                                        @else
                                            <button style='color: white;background:red;border-radius:5px;padding:10px;' id='status'>INACTIVE</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($football_ticket->isSold == 1)
                                            <button href="#!" style='color: white;background:green;border-radius:5px;padding:10px;' id='sell'>SOLD</button>
                                        @else
                                            @if($football_ticket->transaction_status == 1)
                                                <form method="POST" action="/sell_tickets">
                                                    @csrf
                                                    <input type="hidden" value={{$football_ticket->id}} name="id"/>
                                                    <input type="hidden" value={{$football_ticket->roi}} name="roi"/>
                                                    <input type="hidden" value={{$football_ticket->tickets_available}} name="tickets_available"/>
                                                    <button type="submit" style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>SELL</button>
                                                </form>

                                            @else
                                                <button href="#!" style='color: white;background:red;border-radius:5px;padding:10px;' id='sell'>CAN'T SELL</button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                        @foreach($cricket_tickets as $cricket_ticket)
                            <tr>
                                <td>{{$cricket_ticket->home_team}} - {{$cricket_ticket->away_team}}</td>
                                <td>{{$cricket_ticket->country}}</td>
                                <td>${{$cricket_ticket->ticket_price}}</td>
                                <td>{{$cricket_ticket->purchase_number}}</td>
                                <td>{{$cricket_ticket->final_pay}}</td>
                                <td>{{$cricket_ticket->fixture_time}}</td>
                                <td>{{$cricket_ticket->fixture_date}}</td>
                                <td>{{$cricket_ticket->expected_profit}}%</td>
                                <td>{{$cricket_ticket->roi}}</td>
                                <td>
                                    @if($cricket_ticket->transaction_status == 1)
                                        <button style='color: white;background:green;border-radius:5px;padding:10px;' id='status'>ACTIVE</button>
                                    @else
                                        <button style='color: white;background:red;border-radius:5px;padding:10px;' id='status'>INACTIVE</button>
                                    @endif
                                </td>
                                <td>
                                    @if($cricket_ticket->isSold == 1)
                                        <button href="#!" style='color: white;background:green;border-radius:5px;padding:10px;' id='sell'>SOLD</button>
                                    @else
                                        @if($cricket_ticket->transaction_status == 1)
                                            <form method="POST" action="/sell_tickets">
                                                @csrf
                                                <input type="hidden" value={{$cricket_ticket->id}} name="id"/>
                                                <input type="hidden" value={{$cricket_ticket->roi}} name="roi"/>
                                                <input type="hidden" value={{$cricket_ticket->tickets_available}} name="tickets_available"/>
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