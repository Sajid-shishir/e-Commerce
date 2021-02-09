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
<<<<<<< HEAD

    </nav>
@endsection
@section('content')
=======
    </nav>
@endsection
@section('content')
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>By Date</h4>
                        </div>
                        <div class="card-body">
                          <form action="{{ route("check.report") }}" method="get">
                            @csrf
                                <input type="date" class="form-control" name="filter[created_at]" max="{{ \Carbon\carbon::now()->format('Y-m-d') }}" required>
                                <br>
                                <button type="submit" class="btn btn-info">Search</button>
                          </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>By Month</h4>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <label for="">Select Month</label>
                                <select name="month" class="form-control">
                                    <option value="Jan">Jan</option>
                                    <option value="Feb">Feb</option>
                                    <option value="Mar">Mar</option>
                                    <option value="Apr">Apr</option>
                                    <option value="May">May</option>
                                    <option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option>
                                    <option value="Aug">Aug</option>
                                    <option value="Sep">Sep</option>
                                    <option value="Oct">Oct</option>
                                    <option value="Nov">Nov</option>
                                    <option value="Dec">Dec</option>
                                </select>
                                <label for="">Select Year</label>
                                <select name="year" class="form-control">
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-info">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>By Year</h4>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <label for="">Select Year</label>
                                <select name="year" class="form-control">
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-info">Search</button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
>>>>>>> testing

@endsection
