@extends('layouts.adminBase')
@section('title', 'Add BasketBall Team')

@section('content')

    <div class="card-body">
       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-inverse">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active-span" aria-current="page">Add BasketBall Team</li>
            </ol>
        </nav>

    </div>
    <!-- Top Statistics -->
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add BasketBall Team</h2>
                </div>
                <div class="card-body">
                    <form class="form-pill" method='POST' enctype="multipart/form-data" action="/admin/basketball/teams/add">
                        @csrf
                        <div class="form-group">
                            <label>Team_Name</label>
                            <input type="text" class="form-control" name="team_name" required>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo" required>
                        </div>

                        <div class="form-footer">
                            <button type="submit"  name='btn-add' class="btn btn-ticket btn-default">Add Basketball Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection