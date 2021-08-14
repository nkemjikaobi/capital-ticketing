@extends('layouts.adminBase')
@section('title', 'Admin Soccer Pays')

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
                    <li class="breadcrumb-item active" aria-current="page">Soccer Pays</li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
        <div class="row">
            <div class="col-lg-12">
                <!--TABLE STARTS -->
                <div class='card-body'>
                    <div class='table-responsive'>
                        <!-- Table -->
                            <table id='dataTable' class='table table-bordered table-hover table-responsive' width='100%' cellspacing='0'>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Home_Team</th>
                                    <th>Away_Team</th>
                                    <th>Country</th>
                                    <th>Purchase Number</th>
                                    <th>Final Pay</th>
                                    <th>Fixture Date</th>
                                    <th>Fixture Time</th>
                                    <th>Competition</th>
                                    <th>Ticket_Price($)</th>
                                    <th>Expected_Profit(%)</th>
                                    <th>Tickets_Available</th>
                                    <th>Time_Left(day(s))</th>
                                    <th>Transaction Status</th>
                                    <th>Email</th>
                                    <th>ROI</th>
                                    <th>isSold</th>
                                    <th>EDIT</th>
                                </tr>
                                </thead>
                                @foreach($soccerPays as $soccerPay)
                                    <tr>
                                        <td>{{$soccerPay->id}}</td>
                                        <td>{{$soccerPay->home_team}}</td>
                                        <td>{{$soccerPay->away_team}}</td>
                                        <td>{{$soccerPay->country}}</td>
                                        <td>{{$soccerPay->purchase_number}}</td>
                                        <td>{{$soccerPay->final_pay}}</td>
                                        <td>{{$soccerPay->fixture_date}}</td>
                                        <td>{{$soccerPay->fixture_time}}</td>
                                        <td>{{$soccerPay->competition}}</td>
                                        <td>{{$soccerPay->ticket_price}}</td>
                                        <td>{{$soccerPay->expected_profit}}</td>
                                        <td>{{$soccerPay->tickets_available}}</td>
                                        <td>{{$soccerPay->time_left}}</td>
                                        <td>{{$soccerPay->transaction_status}}</td>
                                        <td>{{$soccerPay->email}}</td>
                                        <td>{{$soccerPay->roi}}</td>
                                        <td>
                                             @if($soccerPay->isSold == 1)
                                                SOLD
                                            @else
                                                NOT SOLD
                                            @endif
                                        </td>
                                        
                                        <td><a href="/admin/soccer/pays/edit/{{ $soccerPay->id }}" style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>EDIT</a></td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
                <!--TABLE ENDS-->
            </div>
        </div>
         <div class="container">
          <div class="row">
            <div class="col-md-8 offset-4">
              {{$soccerPays->links("pagination::bootstrap-4")}}
            </div>
          </div>
        </div>
@endsection