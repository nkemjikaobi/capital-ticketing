@extends('layouts.base')
@section('title', 'Deposits')

@section('content')

        <div class="card-body">
            <div class='alert alert-primary '>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong class=''>Refresh page to see current transaction status</strong>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Deposits</li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
        <div class="row">
            <div class="col-lg-12">

                <!--TABLE STARTS -->
                <div class='card-body'>
                    <div class='table-responsive'>
                    @if(count($deposits) > 0)
                        <!-- Table -->
                            <table id='dataTable' class='table table-bordered table-hover' width='100%' cellspacing='0'>
                                <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Description</th>
                                    <th>Amount($)</th>
                                    <th>Transaction Status</th>
                                    <th>Last Updated</th>
                                </tr>
                                </thead>
                                @foreach($deposits as $deposit)
                                    <tr>
                                        <td>{{$deposit->transaction_id}}</td>
                                        <td>{{$deposit->description}}</td>
                                        <td>${{$deposit->local_amount}}</td>
                                        <td>
                                            @switch($deposit->transaction_status)
                                                @case("charge:created")
                                                <button href="#!" style='color: white;background:orange;border-radius:5px;padding:10px;' id='sell'>PENDING</button>
                                                @break

                                                @case("charge:confirmed")
                                                <button href="#!" style='color: white;background:green;border-radius:5px;padding:10px;' id='sell'>CONFIRMED</button>
                                                @break

                                                @case("charge:failed")
                                                <button href="#!" style='color: white;background:red;border-radius:5px;padding:10px;' id='sell'>FAILED</button>
                                                @break

                                                @case("charge:delayed")
                                                <button href="#!" style='color: white;background:orange;border-radius:5px;padding:10px;' id='sell'>DELAYED</button>
                                                @break

                                                @case("charge:pending")
                                                <button href="#!" style='color: white;background:orange;border-radius:5px;padding:10px;' id='sell'>PENDING</button>
                                                @break

                                                @case("charge:resolved")
                                                <button href="#!" style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>RESOLVED</button>
                                                @break

                                                @default
                                                <span>Something went wrong, please try again</span>
                                            @endswitch
                                        </td>
                                        <td>{{$deposit->updated_at}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have not made any deposits...</p>
                        @endif
                    </div>
                </div>
                <!--TABLE ENDS-->
            </div>
@endsection


