@extends('layouts.base')
@section('title', 'Home')

@section('content')

    <div class="card-body">
       @if(auth()->user()->isDisabled == '1')
          <div class='alert alert-primary '>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong class=''>Account has been suspended..Contact us for more info</strong>
          </div>
        @endif
       @if(auth()->user()->isVerified == '0')
          <div class='alert alert-primary '>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong class=''>ID has not been verfied</strong>
          </div>
        @endif
       @if(auth()->user()->verfication == 'not agent' && auth()->user()->account_type == '2')
          <div class='alert alert-primary '>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong class=''>Upload a valid ID</strong>
          </div>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

              <!-- Top Statistics -->
              <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-6">
                  <div class="card card-mini mb-4">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h2 class="mb-1">${{number_format(auth()->user()->portfolio->balance,2)}}</h2>
                          <p><b>BALANCE</b></p>
                        </div>
                        <div>
                          <i class="mdi mdi-wallet"></i>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-6">
                  <div class="card card-mini mb-4">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h2 class="mb-1">
                            @if($ticket_number > 0)
                                {{$ticket_number}}
                            @else
                                {{auth()->user()->portfolio->tickets_number}}
                            @endif
                          </h2>
                          <p>
                            @if($ticket_number > 1)
                              <p><b>TICKETS</b></p>
                            @else
                              <p><b>TICKET</b></p>
                            @endif
                          </p>
                        </div>
                        <div>
                          <i class="fas fa-ticket-alt"></i>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-6">
                  <div class="card card-mini mb-4">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h2 class="mb-1">${{number_format($current_roi,2)}}</h2>
                          <p><b>TOTAL ROI</b></p>
                        </div>
                        <div>
                          <i class="fab fa-bitcoin"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-6">
                  <div class="card card-mini mb-4">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h2 class="mb-1">
                            @if(auth()->user()->portfolio->account_status == 0)
                                <span style="color: red;">INACTIVE</span>
                            @else
                                <span style="color: green;">ACTIVE</span>
                            @endif
                        </h2>
                        <p><b>STATUS</b></p>
                        </div>
                        <div>
                          @if(auth()->user()->portfolio->account_status == 0)
                                <i class="fas fa-user-slash"></i>
                            @else
                                <i class="fas fa-user-check"></i>
                            @endif
                        </div>
                      </div>
                      
                      
                    </div>
                  </div>
                </div>
              </div>
    <script>
     function getTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  const days = Math.floor(total / (1000 * 60 * 60 * 24));
  
  return {
    total,
    days,
    hours,
    minutes,
    seconds
  };
}

function initializeClock(id, endtime) {
  const clock = document.getElementById(id);
  const daysSpan = clock.querySelector('.days');
  const hoursSpan = clock.querySelector('.hours');
  const minutesSpan = clock.querySelector('.minutes');
  const secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    const t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  const timeinterval = setInterval(updateClock, 1000);
}

//const deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
const deadline = "2021-06-28"
initializeClock('clock', deadline);
    </script>
@endsection