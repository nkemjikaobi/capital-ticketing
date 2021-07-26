@extends('layouts.adminBase')
@section('title', 'Edit BasketBall Team')

@section('content')

    <div class="card-body">
       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page">Edit BasketBall Team</li>
            </ol>
        </nav>

    </div>
    <!-- Top Statistics -->
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Edit BasketBall Team</h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" enctype="multipart/form-data" method='POST' action="/admin/basketball/teams/edit">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value={{ $team->id }}>
                        <div class="form-group">
                            <label>Team_Name</label>
                            <input type="text" class="form-control" name="team_name" value={{ $team->team_name }} required>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo">
                            <input type="hidden" class="form-control" name="logo_backup" value={{ $team->logo }}>
                        </div>
                        <div class="form-footer">
                            <button type="submit"  name='btn-update' class="btn btn-team btn-default">Update BasketBall team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
@endsection