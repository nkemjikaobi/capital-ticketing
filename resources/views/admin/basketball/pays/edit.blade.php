@extends('layouts.adminBase')
@section('title', 'Edit Basketball Pays')

@section('content')

    <div class="card-body">
       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page">Edit BasketBall Pays</li>
            </ol>
        </nav>

    </div>
    <!-- Top Statistics -->
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Edit BasketBall Pays</h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" method='POST' action="/admin/basketball/pays/edit">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value={{ $pay->id }} />
                        <div class="form-group">
                            <label>Home_Team</label>
                            <input type="text" class="form-control" name="home_team" value={{ $pay->home_team }} required>
                        </div>
                        <div class="form-group">
                            <label>Away_Team</label>
                            <input type="text" class="form-control" name="away_team" value={{ $pay->away_team }} required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country"  value={{ $pay->country }} required>
                        </div>
                        <div class="form-group">
                            <label>Purchase Number</label>
                            <input type="text" class="form-control" name="purchase_number"  value={{ $pay->purchase_number }} required>
                        </div>
                        <div class="form-group">
                            <label>Final Pay</label>
                            <input type="text" class="form-control" name="final_pay"  value={{ $pay->final_pay }} required>
                        </div>
                        <div class="form-group">
                            <label>Fixture_Date</label>
                            <input type="text" class="form-control" name="fixture_date"  value={{ $pay->fixture_date }} required>
                        </div>
                        <div class="form-group">
                            <label>Fixture_Time</label>
                            <input type="text" class="form-control" name="fixture_time"  value={{ $pay->fixture_time }}   required>
                        </div>
                        <div class="form-group">
                            <label>Competition</label>
                            <input type="text" class="form-control" name="competition"  value={{ $pay->competition }} required>
                        </div>
                        <div class="form-group">
                            <label>Ticket_Price</label>
                            <input type="text" class="form-control" name="ticket_price"  value={{ $pay->ticket_price }}   required>
                        </div>
                        <div class="form-group">
                            <label>Expected_Profit</label>
                            <input type="text" class="form-control" name="expected_profit"  value={{ $pay->expected_profit }} required>
                        </div>
                        <div class="form-group">
                            <label>Tickets_Available</label>
                            <input type="text" class="form-control" name="tickets_available"  value={{ $pay->tickets_available }} required>
                        </div>
                        <div class="form-group">
                            <label>Time_Left</label>
                            <input type="text" class="form-control" name="time_left"  value={{ $pay->time_left }}   required>
                        </div>
                        <div class="form-group">
                            <label>Transaction Status</label>
                            <input type="text" class="form-control" name="transaction_status"  value={{ $pay->transaction_status }}   required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email"  value={{ $pay->email }}   required>
                        </div>
                        <div class="form-group">
                            <label>Roi</label>
                            <input type="text" class="form-control" name="roi"  value={{ $pay->roi }}   required>
                        </div>
                        <div class="form-group">
                            <label>isSold</label>
                            <input type="text" class="form-control" name="isSold"  value={{ $pay->isSold }}   required>
                        </div>

                        <div class="form-footer">
                            <button type="submit"  name='btn-update' class="btn btn-ticket btn-default">Update BasketBall Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection