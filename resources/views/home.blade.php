@extends('layouts.base')
@section('title', 'Home')

@section('content')

        <div class="card-body">
            <div class='alert alert-primary '>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong class=''>Your investments would become active  if (at least 2) confirmations have been made from the Blockchain network</strong>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

                  <!-- Top Statistics -->
                  <div class="row">
                    <div class="col-xl-6 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">${{number_format(auth()->user()->portfolio->balance,2)}}</h2>
                          <p>BALANCE</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-sm-4">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">
                           @if($ticket_number > 0)
                               {{$ticket_number}}
                           @else
                               {{auth()->user()->portfolio->tickets_number}}
                           @endif
                          </h2>
                          <p>
                              @if($ticket_number > 1)
                                <p>TICKETS</p>
                              @else
                                <p>TICKET</p>
                              @endif
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-sm-4">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">${{number_format($current_roi,2)}}</h2>
                          <p>TOTAL ROI</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-sm-4">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">
                              @if(auth()->user()->portfolio->account_status == 0)
                                  <span style="color: red;">INACTIVE</span>
                              @else
                                  <span style="color: green;">ACTIVE</span>
                              @endif
                          </h2>
                          <p>STATUS</p>
                        </div>
                      </div>
                    </div>

                  </div>
@endsection