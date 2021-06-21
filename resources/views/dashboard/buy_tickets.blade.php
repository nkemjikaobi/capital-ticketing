@extends('layouts.base')
@section('title', 'Buy Tickets')

@section('content')

        <div class="card-body">
           
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Buy Tickets</li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
        <div class='row'>
            <div class='col-lg-6 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h3 class='card-title'>SOCCER</h3>
                        <hr>
                        <div class='row padding'>
                            <div class='col-md-6'>
                                <p class='mb-3'><span class='con '>Min:</span><span class='connn'>  $100</span></p>
                                <p class='mb-3'><span class='con'>Max:</span><span class='connn'>  $9,999</span></p>
                                <p class='mb-3'><span class='con'>Daily Profit (ROI):</span><span class='connn'>1.2%</span></p>
                                <p class='mb-3'><span class='con'>Support:</span><span class='connn'>24 Hours</span></p>
                                <p class='mb-3'><span class='con'>Ref Bonus</span><span class='connn'>5%</span></p>

                            </div>

                        </div>


                        <a href='{{route('buy_tickets_soccer')}}' class='btn btn-primary fun'><span class='select_plan'>VIEW TICKETS</span></a>

                    </div>
                </div>
            </div>

            <div class='col-lg-6 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h3 class='card-title'>BASKETBALL</h3>
                        <hr>
                        <div class='row padding'>
                            <div class='col-md-6'>
                                <p class='mb-3'><span class='con'>Min:</span><span class='connn'>  $10,000</span></p>
                                <p class='mb-3'><span class='con'>Max:</span><span class='connn'>  $99,999</span></p>
                                <p class='mb-3'><span class='con'>Daily Profit:</span><span class='connn'>1.4%</span></p>
                                <p class='mb-3'><span class='con'>Support:</span><span class='connn'>24 Hours</span></p>
                                <p class='mb-3'><span class='con'>Ref Bonus</span><span class='connn'>5%</span></p>

                            </div>

                        </div>

                        <a href='{{route('buy_tickets_basketball')}}' class='btn btn-primary fun'><span class='select_plan'>VIEW TICKETS</span></a>
                    </div>
                </div>
            </div>

            <div class='col-lg-6 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h3 class='card-title'>FOOTBALL</h3>
                        <hr>
                        <div class='row padding'>
                            <div class='col-md-6'>
                                <p class='mb-3'><span class='con'>Min:</span><span class='connn'>  $100,000</span></p>
                                <p class='mb-3'><span class='con'>Max:</span><span class='connn'>  $499,999</span></p>
                                <p class='mb-3'><span class='con'>Daily Profit (ROI):</span><span class='connn'>1.6%</span></p>
                                <p class='mb-3'><span class='con'>Support:</span><span class='connn'>24 Hours</span></p>
                                <p class='mb-3'><span class='con'>Ref Bonus</span><span class='connn'>5%</span></p>

                            </div>

                        </div>

                        <a href='{{route('buy_tickets_football')}}' class='btn btn-primary fun'><span class='select_plan'>VIEW TICKETS</span></a>
                    </div>
                </div>
            </div>

            <div class='col-lg-6 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h3 class='card-title'>CRICKET</h3>
                        <hr>
                        <div class='row padding'>
                            <div class='col-md-6'>
                                <p class='mb-3'><span class='con'>Min:</span><span class='connn'>  $500,000.00</span></p>
                                <p class='mb-3'><span class='con'>Max:</span><span class='connn'>  UNLIMITED</span></p>
                                <p class='mb-3'><span class='con'>Daily Profit (ROI):</span><span class='connn'>1.8%</span></p>
                                <p class='mb-3'><span class='con'>Support:</span><span class='connn'>24 Hours</span></p>
                                <p class='mb-3'><span class='con'>Ref Bonus</span><span class='connn'>5%</span></p>

                            </div>

                        </div>

                        <a href='{{route('buy_tickets_cricket')}}' class='btn btn-primary fun'><span class='select_plan'>VIEW TICKETS</span></a>
                    </div>
                </div>
            </div>

@endsection

