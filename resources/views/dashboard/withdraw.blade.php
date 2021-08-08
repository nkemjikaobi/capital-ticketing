@extends('layouts.base')
@section('title', 'Withdrawals')

@section('content')

        <div class="card-body">
             <div class='alert alert-primary'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong class=''>It can take up to six hours to get credited</strong>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Withdraw Funds</li>
                </ol>
            </nav>

        </div>
         <div class="row">

                  <div class="col-lg-12">

                  <div class="card card-default">
				<div class="card-header card-header-border-bottom">
                        <h2>Withdraw Earnings</h2>
                    </div>
                    <div class="card-body">
                        <form class="form-pill" method='POST' action="/withdraw_funds">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Amount</label>
                                <input type="text" name="amount" class="form-control" required id="exampleFormControlInput3">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Payment Type</label>
                                <select name="payment_type" id="" required class="form-control">
                                    <option value="btc">BTC</option>
                                    <option value="eth">ETH</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Wallet Address</label>
                                <input type="text" name="wallet_address" required class="form-control" id="exampleFormControlInput3">
                            </div>
                            <div class="form-footer">
                                <button type="submit"  name='btn-update' class="btn btn-ticket btn-default">Withdraw</button>
                            </div>
                        </form>
                    </div>
                </div>
				</div>

            </div>
@endsection


