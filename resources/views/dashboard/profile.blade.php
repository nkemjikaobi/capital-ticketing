@extends('layouts.base')
@section('title', 'Profile')

@section('content')
				<div class="card-body">
                    
                    @if(auth()->user()->verification == 'not agent' && auth()->user()->account_type == '2')
                        <div class='alert alert-primary '>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong class=''>ID is not yet verified</strong>
                        </div>
                    @elseif(auth()->user()->isVerified == '0')
                        <div class='alert alert-primary '>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong class=''>Upload a valid ID</strong>
                        </div>
                    @elseif(auth()->user()->mobile == 'null')
                        <div class='alert alert-primary '>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong class=''>Add a phone number</strong>
                        </div>
                    @endif
				<nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-inverse">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active-span" aria-current="page">Profile</li>
                    </ol>
                    </nav>

			   </div>
                  <!-- Top Statistics -->
                  <div class="row">

                  <div class="col-lg-6">

                  <div class="card card-default">
				<div class="card-header card-header-border-bottom">
                        <h2>User Profile</h2>
                    </div>
                    <div class="card-body">
                        <form class="form-pill" method='POST' enctype="multipart/form-data" action="/profile">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Username</label>
                                <input type="text" name="username" class="form-control" id="exampleFormControlInput3" value={{auth()->user()->username}} disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlPassword3">First Name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="exampleFormControlPassword3"
                                      name="firstname"  value={{auth()->user()->firstname}} required>
                                @error('firstname')
                                <div style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlPassword3">Last Name</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="exampleFormControlPassword3"
                                       name="lastname" value={{auth()->user()->lastname}} required>
                                @error('lastname')
                                <div style="color:red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Email</label>
                                <input type="text" name="email" class="form-control" id="exampleFormControlInput3" value={{auth()->user()->email}} disabled>
                            </div>
                            @if(auth()->user()->verification !== 'not agent' && auth()->user()->account_type == '2' && auth()->user()->isVerified == '0')
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">Verification Status</label>
                                    <input type="text"  class="form-control" id="exampleFormControlInput3" value='VERIFICATION IN PROGRESS' disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">Upoad Different ID</label>
                                    <input type="file" name="verification" class="form-control" id="exampleFormControlInput3">
                                </div>
                            @elseif(auth()->user()->verification == 'not agent' && auth()->user()->account_type == '2')
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">Upload ID</label>
                                    <input type="file" name="verification" class="form-control" id="exampleFormControlInput3">
                                </div>
                            @elseif(auth()->user()->verification !== 'not agent' && auth()->user()->account_type == '2' && auth()->user()->isVerified == '1')
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">Verification Status</label>
                                    <input type="text" name="verification" class="form-control" value='ID VERIFIED' disabled id="exampleFormControlInput3">
                                </div>
                            @endif
                            <div class="form-footer">
                                <button type="submit"  name='btn-update' class="btn btn-ticket btn-default">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
				</div>
                  <div class="col-lg-6">

                  <div class="card card-default">
				<div class="card-header card-header-border-bottom">
                        <h2>Details of Logged In User</h2>
                    </div>
                    <div class="card-body">
                        <form class="form-pill">
                            <div class="form-group">
                                <label for="exampleFormControlInput3">IP Address</label>
                                <input type="text" class="form-control" id="exampleFormControlInput3"
                                value="{{$ip_address}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlPassword3">Browser Details</label>
                                <input type="text" class="form-control" id="exampleFormControlPassword3"
                                value="{{$browser}}"

                            disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlPassword3">Operating System</label>
                                <input type="text" class="form-control" id="exampleFormControlPassword3"
                                value="{{$operating_system}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlPassword3">Device</label>
                                <input type="text" class="form-control" id="exampleFormControlPassword3"
                                value="{{$device}}" disabled>
                            </div>
                        </form>
                    </div>
                </div>
				</div>

                  </div>

 @endsection
