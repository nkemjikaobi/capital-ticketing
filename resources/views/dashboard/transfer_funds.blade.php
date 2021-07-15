@extends('layouts.base')
@section('title', 'Transfer Funds')

@section('content')
        <div class="card-body">
            @if(auth()->user()->isVerified == '0')
                <div class='alert alert-primary '>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong class=''>ID is not yet verified</strong>
                </div>
            @endif
            @if(auth()->user()->verification == 'not agent')
                <div class='alert alert-primary '>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong class=''>Upload a valid ID</strong>
                </div>
            @endif
            @if(auth()->user()->isDisabled == '1')
                <div class='alert alert-primary '>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong class=''>Account Suspended....Contact us for more info.</strong>
                </div>
            @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page">Transfer Funds</li>
            </ol>
            </nav>

        </div>
            <!-- Top Statistics -->
            <div class="row">

            <div class="col-lg-12">
                 <div class="card card-default">
				<div class="card-header card-header-border-bottom">
                        <h2>Transfer Funds</h2>
                    </div>
                    <div class="card-body">
                        <form class="form-pill" method='POST' action="/transfer_funds/transfer">
                            @csrf
                            <input type="hidden" name="seller_id" value={{ auth()->user()->portfolio->user_id }}>
                            <input type="hidden" name="balance" value={{ auth()->user()->portfolio->balance }}>
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput3" required placeholder="Enter the email of the recipient">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlPassword3">Amount($)</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="exampleFormControlPassword3"
                                      name="amount" placeholder="Enter the amount you wish to transfer" required>
                            </div>
                            <div class="form-footer">
                                @if(auth()->user()->isDisabled == '1' || auth()->user()->isVerified == '0')
                                    <a href="#!" class='btn btn-ticket fun disabled'>Transfer Funds</a>
                                @else
                                    <button type="submit"  name='btn-transfer' class='btn btn-ticket btn-default'>Transfer Funds</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>

 @endsection
