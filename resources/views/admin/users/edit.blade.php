@extends('layouts.adminBase')
@section('title', 'Edit User')

@section('content')

    <div class="card-body">
       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page">Edit User</li>
            </ol>
        </nav>

    </div>
    <!-- Top Statistics -->
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Edit User</h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" method='POST' action="/admin/index/edit">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>FirstName</label>
                            <input type="text" class="form-control" name="firstname" value={{ $user->firstname }} placeholder="400"   required>
                        </div>
                        <div class="form-group">
                            <label>LastName</label>
                            <input type="text" class="form-control" name="lastname" value={{ $user->lastname }} placeholder="400"   required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="400" value={{ $user->username }}   required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" placeholder="400" value={{ $user->email }} disabled   required>
                            <input type="hidden" class="form-control" name="email" placeholder="400" value={{ $user->email }} required>
                        </div>
                        <div class="form-group">
                            <label>Account Type</label>
                            <input type="text" class="form-control" name="account_type" placeholder="400" value={{ $user->account_type }}   required>
                        </div>

                        <div class="form-footer">
                            <button type="submit"  name='btn-update' class="btn btn-ticket btn-default">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection