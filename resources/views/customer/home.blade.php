@extends('layouts.dashboard')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Customer Home Page
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
                                    <th scope="col">Order ID:</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">User Created</th>
                                    <th scope="col">Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer_orders as $index=> $customer_order)
                                <tr>

                                    <td>{{ $customer_order->id}}</td>
                                    <td>{{ $customer_order->full_name}}</td>
                                    <td>{{ $customer_order->address}}</td>
                                    <td>{{ $customer_order->sub_total}}</td>
                                    <td>{{ $customer_order->total}}</td>
                                    <td>{{ $customer_order->created_at->format('d/m/Y H:i:s A') }}</td>
                                    <td>
                                        <a href="{{ url('order/download') }}/{{ $customer_order->id }}" class="btn btn-dark btn-sm">Download</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
