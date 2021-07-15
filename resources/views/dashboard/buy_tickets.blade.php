@extends('layouts.base')
@section('title', 'Buy Tickets')

@section('content')

        <div class="card-body">
           @if(auth()->user()->isDisabled == '1')
                <div class='alert alert-primary '>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong class=''>Account has been suspended.. Contact us for more info.</strong>
                </div>
            @endif
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active-span" aria-current="page">Buy Tickets</li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
        <style>
            .tickets-cover{
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .basketball{
                background-image: url('/images/basketball.jpg') !important;  
            }
            .soccer{
                background-image: url('/images/soccer.jpg') !important;  
            }
            .american-football{
                background-image: url('/images/american-football.jpg') !important;  
            }
            .cricket{
                background-image: url('/images/cricket.jpg') !important;  
            }
        </style>
        <div class='row'>
            <div class='col-lg-6 mb-4 '>
                <div class='card tickets-cover soccer'>
                    <div class='card-body'>
                        <h1 class='card-title text-white' style="color:transparent !important;">-</h1>
                        
                        <div class='row padding'>
                            <div class='col-md-6'>
                                <p class='mb-3'><span class='con text-white '>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>

                            </div>

                        </div>
                        <a href=
                        '{{ auth()->user()->isVerified == '0' ? route('profile') : route('buy_tickets_soccer')}}' class='btn btn-ticket fun {{ auth()->user()->isDisabled == '1' ? 'disabled' : ''}}'>
                            <span class='select_plan'>
                                VIEW TICKETS
                            </span>
                        </a>

                    </div>
                </div>
            </div>

            <div class='col-lg-6 mb-4'>
                <div class='card tickets-cover basketball'>
                    <div class='card-body'>
                        <h1 class='card-title text-white' style="color:transparent !important;">-</h1>
                        
                        <div class='row padding'>
                            <div class='col-md-6'>
                                <p class='mb-3'><span class='con text-white '>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>

                            </div>

                        </div>

                        <a href='{{ auth()->user()->isVerified == '0' ? route('profile') : route('buy_tickets_basketball')}}' class='btn btn-ticket fun {{ auth()->user()->isDisabled == '1' ? 'disabled' : ''}}'><span class='select_plan'>VIEW TICKETS</span></a>
                    </div>
                </div>
            </div>

            <div class='col-lg-6 mb-4'>
                <div class='card tickets-cover american-football'>
                    <div class='card-body'>
                        <h1 class='card-title text-white' style="color:transparent !important;">-</h1>
                        
                        <div class='row padding'>
                            <div class='col-md-6'>
                                <p class='mb-3'><span class='con text-white '>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>

                            </div>

                        </div>

                        <a href='{{ auth()->user()->isVerified == '0' ? route('profile') : route('buy_tickets_football')}}' class='btn btn-ticket fun {{ auth()->user()->isDisabled == '1' ? 'disabled' : ''}}'><span class='select_plan'>VIEW TICKETS</span></a>
                    </div>
                </div>
            </div>

            <div class='col-lg-6 mb-4'>
                <div class='card tickets-cover cricket'>
                    <div class='card-body'>
                        <h1 class='card-title text-white' style="color:transparent !important;">-</h1>
                        
                        <div class='row padding'>
                            <div class='col-md-6'>
                                <p class='mb-3'><span class='con text-white '>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>
                                <p class='mb-3'><span class='con text-white'>-</span><span class='connn text-white'>-</span></p>

                            </div>

                        </div>

                        <a href='{{ auth()->user()->isVerified == '0' ? route('profile') : route('buy_tickets_cricket')}}' class='btn btn-ticket fun {{ auth()->user()->isDisabled == '1' ? 'disabled' : ''}}'><span class='select_plan'>VIEW TICKETS</span></a>
                    </div>
                </div>
            </div>

@endsection

