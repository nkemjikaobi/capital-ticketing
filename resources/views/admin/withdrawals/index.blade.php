@extends('layouts.adminBase')
@section('title', 'Admin Withdrawals')

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
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Withdrawals</li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
        <div class="row">
            <div class="col-lg-12">

                <!--TABLE STARTS -->
                <div class='card-body'>
                    <div class='table-responsive'>
                        @if(count($withdrawals) > 0)
                        <!-- Table -->
                            <table id='dataTable' class='table table-bordered table-hover table-responsive' width='100%' cellspacing='0'>
                                <thead>
                                <tr>
                                    <th>Amount($)</th>
                                    <th>Payment Type</th>
                                    <th>Wallet Address</th>
                                    <th>Email</th>
                                    <th>Transaction Status</th>
                                    <th>Last Updated</th>
                                    <th>WITHDRAWAL SUCCESS</th>
                                    <th>WITHDRAWAL FAIL</th>
                                </tr>
                                </thead>
                                @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{$withdrawal->amount}}</td>
                                        <td>{{$withdrawal->payment_type}}</td>
                                        <td>{{$withdrawal->wallet_address}}</td>
                                        <td>{{$withdrawal->email}}</td>
                                        <td>
                                            @switch($withdrawal->status)
                                                @case(0)
                                                <button href="#!" style='color: white;background:orange;border-radius:5px;padding:10px;' id='sell'>PENDING</button>
                                                @break

                                                @case(1)
                                                <button href="#!" style='color: white;background:green;border-radius:5px;padding:10px;' id='sell'>CONFIRMED</button>
                                                @break

                                                @case(-1)
                                                <button href="#!" style='color: white;background:red;border-radius:5px;padding:10px;' id='sell'>FAILED</button>
                                                @break

                                                @default
                                                <span>Something went wrong, please try again</span>
                                            @endswitch
                                        </td>
                                        <td>{{$withdrawal->updated_at}}</td>
                                         <td>
                                            <form action="/admin/withdrawals/success" method='POST'>
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value={{ $withdrawal->id }}>
                                                <button type='submit'  style='color: white;background:green;border-radius:5px;padding:10px;' id='sell'>WITHDRAWAL SUCCESS</button>
                                            </form>
                                        </td>
                                         <td>
                                            <form action="/admin/withdrawals/fail" method='POST'>
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value={{ $withdrawal->id }}>
                                                <button type='submit'  style='color: white;background:red;border-radius:5px;padding:10px;' id='sell'>WITHDRAWAL FAIL</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have not made any withdrawals...</p>
                        @endif
                    </div>
                </div>
                <!--TABLE ENDS-->
            </div>
        </div>
         <div class="container">
          <div class="row">
            <div class="col-md-8 offset-4">
              {{$withdrawals->links("pagination::bootstrap-4")}}
            </div>
          </div>
        </div>
@endsection