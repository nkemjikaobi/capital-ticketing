@extends('layouts.base')
@section('title', 'Deposits')

@section('content')
<style>
    .table-responsive {
	min-height:.01%;
	overflow-x:auto
}
@media screen and (max-width:767px) {
    .table-responsive {
    width:100%;
    margin-bottom:15px;
    overflow-y:hidden;
    -ms-overflow-style:-ms-autohiding-scrollbar;
    border:1px solid #ddd;
    color: blue !important;
    }
    .table-responsive>.table {
    margin-bottom:0
    }
        .table-responsive>.table>tbody>tr>td, .table-responsive>.table>tbody>tr>th, .table-responsive>.table>tfoot>tr>td, .table-responsive>.table>tfoot>tr>th, .table-responsive>.table>thead>tr>td, .table-responsive>.table>thead>tr>th {
    white-space:nowrap
    }
    .table-responsive>.table-bordered {
    border:0
    }
    .table-responsive>.table-bordered>tbody>tr>td:first-child, .table-responsive>.table-bordered>tbody>tr>th:first-child, .table-responsive>.table-bordered>tfoot>tr>td:first-child, .table-responsive>.table-bordered>tfoot>tr>th:first-child, .table-responsive>.table-bordered>thead>tr>td:first-child, .table-responsive>.table-bordered>thead>tr>th:first-child {
    border-left:0
    }
    .table-responsive>.table-bordered>tbody>tr>td:last-child, .table-responsive>.table-bordered>tbody>tr>th:last-child, .table-responsive>.table-bordered>tfoot>tr>td:last-child, .table-responsive>.table-bordered>tfoot>tr>th:last-child, .table-responsive>.table-bordered>thead>tr>td:last-child, .table-responsive>.table-bordered>thead>tr>th:last-child {
    border-right:0
    }
    .table-responsive>.table-bordered>tbody>tr:last-child>td, .table-responsive>.table-bordered>tbody>tr:last-child>th, .table-responsive>.table-bordered>tfoot>tr:last-child>td, .table-responsive>.table-bordered>tfoot>tr:last-child>th {
    border-bottom:0
    }
}
</style>
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
                    <li class="breadcrumb-item active-span" aria-current="page">Deposits</li>
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
                            <table id='dataTable' class='table table-bordered table-hover table-responsive' width='100%' cellspacing='0'>
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


