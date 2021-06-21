@extends('layouts.base')
@section('title', 'Fund Wallet')

@section('content')

    <div class="card-body">
       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Fund Wallet</li>
            </ol>
        </nav>

    </div>
    <!-- Top Statistics -->
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Deposit Funds</h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" method='POST' action="{{ route('fund_wallet_create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlPassword3">Amount you wish to deposit($)</label>
                            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="exampleFormControlPassword3"
                                    name="amount" placeholder="400"   required>
                            @error('amount')
                            <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-footer">
                            <button type="submit"  name='btn-update' class="btn btn-primary btn-default">Deposit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection