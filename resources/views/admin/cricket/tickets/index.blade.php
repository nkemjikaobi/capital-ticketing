@extends('layouts.adminBase')
@section('title', 'Admin Cricket Tickets')

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
                    <li class="breadcrumb-item active" aria-current="page">Cricket Tickets</li>
                </ol>
            </nav>

        </div>
        <!-- Top Statistics -->
        <div class="row">
            <div class="col-lg-12">
                <a href={{ route('admin_cricket_ticket_create') }} style='color: white;background:#003699;border-radius:5px;padding:10px;'>ADD CRICKET TICKET</a>
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
                                    <th>Fixture Date</th>
                                    <th>Fixture Time</th>
                                    <th>Competition</th>
                                    <th>Home_Team_Logo</th>
                                    <th>Away_Team_Logo</th>
                                    <th>Ticket_Price($)</th>
                                    <th>Expected_Profit(%)</th>
                                    <th>Tickets_Available</th>
                                    <th>Time_Left(day(s))</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                                </thead>
                                @foreach($cricketTickets as $cricketTicket)
                                    <tr>
                                        <td>{{$cricketTicket->id}}</td>
                                        <td>{{$cricketTicket->home_team}}</td>
                                        <td>{{$cricketTicket->away_team}}</td>
                                        <td>{{$cricketTicket->country}}</td>
                                        <td>{{$cricketTicket->fixture_date}}</td>
                                        <td>{{$cricketTicket->fixture_time}}</td>
                                        <td>{{$cricketTicket->competition}}</td>
                                        <td><img src="/storage/{{$basketballTicket->home_team_logo  }}" width="50px" height="50px" alt="team_logo" /></td>
                                        <td><img src="/storage/{{$basketballTicket->away_team_logo  }}" width="50px" height="50px" alt="team_logo" /></td>
                                        <td>{{$cricketTicket->ticket_price}}</td>
                                        <td>{{$cricketTicket->expected_profit}}</td>
                                        <td>{{$cricketTicket->tickets_available}}</td>
                                        <td>{{$cricketTicket->time_left}}</td>
                                        
                                        <td><a href="/admin/cricket/edit/{{ $cricketTicket->id }}" style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>EDIT</a></td>
                                        <td>
                                            <form action="/admin/cricket/delete" method='POST'>
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value={{ $cricketTicket->id }}>
                                                <button type='submit'  style='color: white;background:red;border-radius:5px;padding:10px;' id='sell'>DELETE</button>
                                            </form>
                                        </td>
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
              {{$cricketTickets->links("pagination::bootstrap-4")}}
            </div>
          </div>
        </div>
@endsection