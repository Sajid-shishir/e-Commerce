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
@can('edit category')

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Date:</h4>
                        </div>
                        <div class="card-body">
                          <form action="{{ route("check.report") }}" method="get">
                            @csrf
                                <input type="date" class="form-control" name="filter[created_at]" max="{{ \Carbon\carbon::now()->format('Y-m-d') }}" required>
                                <br>
                                <button type="submit" class="btn btn-dark">Get Report</button>
                          </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>By Year</h4>
                        </div>
                            <div class="card-body">
                                <form action="{{ route("check.report") }}" method="get">
                                  @csrf
                                  <select name="filter[created_at]" class="form-control">
                                      <option value="2020">2020</option>
                                      <option value="2021">2021</option>
                                  </select>
                                      <br>
                                      <button type="submit" class="btn btn-info">Search</button>
                                </form>
                            </div>
                    </div>
                </div> --}}
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Date to Date : </h4>
                        </div>
                            <div class="card-body">
                                <form method="get" action="{{route('check.report.from')}}">
                                    @csrf
                                    <div class="">
                                       <p>From:</p>
                                        <input type="date" name="start" max={{ \Carbon\carbon::now()->format('Y-m-d') }} class="form-control"><br/>
                                        <p>To:</p>
                                        <input type="date" name="end" max={{ \Carbon\carbon::now()->format('Y-m-d') }} class="form-control"><br/>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-dark">Get Report</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>By Month</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route("check.report") }}" method="get">
                                @csrf
                                <select name="created_at" class="form-control">
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-info">Search</button>
                              </form>
                        </div>
                    </div>
                </div> --}}
            </div>
            @else
                    <span class="lead m-auto"><h1 class="badge badge-danger">UnAuthorized</h1></span>
            @endcan
@endsection
