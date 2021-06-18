@extends('layouts.base')
@section('title', 'Withdrawals')

@section('content')

        <div class="card-body">
            @include('.inc.messages')
            @if (!empty($success))
                {{ $success }}
            @endif

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

        </div>
@endsection


