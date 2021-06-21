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
                {{-- <div class="col-xl-6 col-sm-4">
                  <div class="card card-mini mb-4">
                    <div class="card-body">
                      <style>
                        
                      </style>
                      <div id="clock">
                          <div>
                            <span class="days"></span>
                            <div class="smalltext">Days</div>
                          </div>
                          <div>
                            <span class="hours"></span>
                            <div class="smalltext">Hours</div>
                          </div>
                          <div>
                            <span class="minutes"></span>
                            <div class="smalltext">Minutes</div>
                          </div>
                          <div>
                            <span class="seconds"></span>
                            <div class="smalltext">Seconds</div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div> --}}

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