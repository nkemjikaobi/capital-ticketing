@extends('layouts.adminBase')
@section('title', 'Admin Home')

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
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Account Type</th>
                                    <th>isDisabled</th>
                                    <th>Verification ID</th>
                                    <th>IsVerified</th>
                                    <th>EDIT</th>
                                    <th>VERIFY</th>
                                    <th>DISABLE</th>
                                    <th>DELETE</th>
                                </tr>
                                </thead>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->firstname}}</td>
                                        <td>{{$user->lastname}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if($user->account_type == 1)
                                                User
                                            @elseif($user->account_type == 2)
                                                Seller
                                            @else
                                                Admin
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->isDisabled == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td><img src="/storage/{{$user->verification  }}" width="200px" height="150px" alt="verification_id" /></td>
                                        <td>
                                            @if($user->isVerified == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td><a href="/admin/index/edit/{{ $user->id }}" style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>EDIT</a></td>
                                        <td>
                                            <form action="/admin/make_admin" method='POST'>
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="email" value={{ $user->email }}>
                                                <button type='submit'  style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>MAKE ADMIN</button>
                                            </form>
                                        </td>
                                        <td>
                                            @if($user->isVerified == '0')
                                                <form action="/admin/index/verify" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="email" value={{ $user->email }}>
                                                    <button type='submit' style='color: white;background:#003699;border-radius:5px;padding:10px;' id='sell'>VERIFY</button>
                                                </form>
                                            @else
                                                <form action="/admin/index/unverify" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="email" value={{ $user->email }}>
                                                    <button type='submit' style='color: white;background:orangered;border-radius:5px;padding:10px;' id='sell'>UNVERIFY</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->isDisabled == '0')
                                                <form action="/admin/index/disable" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="email" value={{ $user->email }}>
                                                    <button type='submit' style='color: white;background:red;border-radius:5px;padding:10px;' id='sell'>DISABLE</button>
                                                </form>
                                            @else
                                                <form action="/admin/index/activate" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="email" value={{ $user->email }}>
                                                    <button type='submit' style='color: white;background:green;border-radius:5px;padding:10px;' id='sell'>ACTIVATE</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="/admin/index/delete" method='POST'>
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="email" value={{ $user->email }}>
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
              {{$users->links("pagination::bootstrap-4")}}
            </div>
          </div>
        </div>
@endsection