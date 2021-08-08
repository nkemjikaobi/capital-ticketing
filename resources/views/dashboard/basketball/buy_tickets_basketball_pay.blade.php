@extends('layouts.base')
@section('title', 'Fund Wallet')

@section('content')

        <div class="card-body">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active-span" aria-current="page"><a href="/buy_tickets" style="text-decoration: none !important;color:#4c84ff;">Buy Tickets</a></li>
                    <li class="breadcrumb-item active-span" aria-current="page"><a href="/buy_tickets/basketball" style="text-decoration: none !important;color:#4c84ff;">BasketBall</a></li>
                    <li class="breadcrumb-item active-span" aria-current="page"><a href="/buy_tickets/basketball/pay" style="text-decoration: none !important;color:#4c84ff;">Pay</a></li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
        <div class="card card-default">
            @foreach($pay as $p)

                <div class="card-header card-header-border-bottom">
                    <h2>Proceed to pay ${{  $p->purchase_number * $p->ticket_price }}</h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" method='POST' action='/buy_tickets/basketball/pay/process'>
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput3">Number of tickets you wish to purchase</label>
                            <input type="number"   name='purchase_number' class="form-control" id="exampleFormControlInput3" value={{$p->purchase_number}} disabled>
                            <input type="hidden"   name='purchase_number' class="form-control" id="exampleFormControlInput3" value={{$p->purchase_number}} >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Price per ticket ($)</label>
                            <input type="text" name='ticket_price' class="form-control" id="exampleFormControlPassword3" value={{$p->ticket_price}} disabled>
                            <input type="hidden" name='ticket_price' class="form-control" id="exampleFormControlPassword3" value={{$p->ticket_price}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Amount to Pay ($)</label>
                            <input type="text" name='final_pay' class="form-control" id="exampleFormControlPassword3" value="{{$p->purchase_number * $p->ticket_price}}" disabled>
                            <input type="hidden" name='final_pay' class="form-control" id="exampleFormControlPassword3" value="{{$p->purchase_number * $p->ticket_price}}">
                            <input type="hidden" name='tickets_available' class="form-control" id="exampleFormControlPassword3" value="{{$p->tickets_available}}">
                            <input type="hidden" name='ticket_id' class="form-control" id="exampleFormControlPassword3" value="{{$ticket_id}}">
                        </div>

                        <div class="form-footer">
                            <button type="submit"  class="btn btn-ticket btn-default">PAY</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

@endsection