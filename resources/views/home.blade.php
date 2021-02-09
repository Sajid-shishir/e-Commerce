@extends('layouts.dashboard')
@section('home')
    active
@endsection
@section('title')
    Dashboard
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home Page</a>

    </nav>
@endsection

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header card-header-default bg-dark" style="color: rgb(255, 255, 255)">Last 7 Days Sale</div> {{--$users->total()--}}
                <div class="card-body">

                        {!! $weekly_chart->container() !!}
                        {!! $weekly_chart->script() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header card-header-default bg-dark" style="color: rgb(255, 255, 255)">Payment Type Chart</div> {{--$users->total()--}}
                <div class="card-body">

                        {!! $Payment_method_chart->container() !!}
                        {!! $Payment_method_chart->script() !!}
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-6">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-default bg-dark">Total Users: {{$total_users}}  </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Sl no:</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">User Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index=> $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->created_at->format('d/m/Y H:i:s A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="ht-80 bd bg-dark d-flex align-items-center justify-content-center">
                        <nav aria-label="Page navigation">
                          <ul class="pagination pagination-dark mg-b-0">
                            {{$users->links()}}
                          </ul>
                        </nav>
                      </div>
                    {{-- {{$users->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
