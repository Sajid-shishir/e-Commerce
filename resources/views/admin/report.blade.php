@extends('layouts.dashboard')
@section('report')
    active
@endsection

@section('title')
    Report
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href="">Report</a>

    </nav>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="card-body">
                <h2>Report</h2>
            </div>
        </div>
    </div>
@endsection
