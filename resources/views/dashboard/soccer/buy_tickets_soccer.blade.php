 <!---APP CSS -->
 <link  rel="stylesheet" href="{{ asset('css/app.css') }}" />

@extends('layouts.base')
@section('title', 'Buy Soccer Tickets')
@section('content')


    <div class="card-body">
   
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page"><a href="/buy_tickets" >Buy Tickets</a></li>
                <li class="breadcrumb-item active-span" aria-current="page">Soccer</li>
            </ol>
        </nav>

    </div>

    <!-- Top Statistics -->
    <div class='row'>
        @foreach($tickets as $ticket)
                <div class="col-md-6">
                  <div id='ticket'>
                    <div class='back'>
                      <div class='left'>
                        <div class="left-bar">
                          <span class='time' data-title='time'>{{ $ticket->fixture_time }}</span>
                          <span class='gate' data-title='available'>{{ $ticket->tickets_available }}</span>
                          <span class='seat' data-title='date'>{{ $ticket->fixture_date }}</span>
                        </div>
                        <div class='details-section'>
                    
                          <div class='details-body'>
                            <div class='details-travel'>
                              
                    
                              <div class='from-to'>
                                <div class="from" :data-code='depart.code' data-title=''>
                                  <img 
                                    src="{{ asset('images/manu-logo.png') }}"
                                    width="25px"
                                    height="25px"
                                    alt="">
                                  {{ $ticket->home_team }}
                                </div>
                                <span class="line"></span>
                                <div class="to":data-code='arrive.code' data-title=''>
                                  <img 
                                    src="{{ asset('images/chelsea-logo.png') }}"
                                    width="25px"
                                    height="25px"
                                    alt="">
                                    {{ $ticket->away_team }}
                                  </div>
                              </div>
                            </div>
                    
                          </div>
                          <div class='details-logo'>
                          <div v-html='logo' class='logo'></div> 
                            <div class="logo-text">{{ $ticket->country }}</div>
                            
                          </div>
                        </div>
                      </div>
                      <div class='right'>
                           <div class='details-logo'>
                            <span v-html='logo' class='logo'></span> <span class='logo-text'>{{ $ticket->competition }}</span>
                          </div>
                          <div class="travel-details">
                            <span class="name" data-title='profit'>{{ $ticket->expected_profit }}%</span>
                            <div class="flight">
                              
                               <span class='flight-time' data-title='expires in' :data-date='travelDate'>{{ $ticket->time_left }} days</span>
                            </div>
                           
                            <div class='ticket-id'>
                            ${{ $ticket->ticket_price }}
                          </div>
                          </div>
                          {{-- <a href="" class="btn btn-ticket">Buy Now</a> --}}
                      </div>
                    </div>
                   
                    </div>
                 
                </div>
        @endforeach
@endsection


