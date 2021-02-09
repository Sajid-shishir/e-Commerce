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
        <a class="breadcrumb-item" href="{{route('report')}}">Report</a>
        <a class="breadcrumb-item" href="{{route('report')}}">Searched Report</a>
    </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <span class="lead">All Orders</span>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <table class="table table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">Sl No:</th>
                                    <th scope="col">User ID:</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone no</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Order Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($searched_orders as $index=> $searched_order)
                                <tr>
                                    <td>{{ $loop->index +1}}</td>
                                    <td>{{ $searched_order->user_id }}</td>
                                    <td>{{ $searched_order->full_name }}</td>
                                    <td>{{ $searched_order->email_address}}</td>
                                    <td>{{ $searched_order->phone_number }}</td>
                                    <td>{{ $searched_order->address }}</td>
                                    <td>{{ $searched_order->payment_method }}</td>
                                    <td>{{ $searched_order->amount }}</td>
                                    <td class="badge badge-light">{{ $searched_order->created_at }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="text-center text-danger">No Order Found</td>
                                </tr>

                                @endforelse
                            </tbody>

                        </table>
                        {{-- {{ $customer_orders->links() }} --}}
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
