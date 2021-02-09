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
                                    <th scope="col">Sl No:</th>
                                    <th scope="col">Order ID:</th>
                                    {{-- <th scope="col">Product ID:</th> --}}
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Payment Time</th>
                                    <th scope="col">Invoice</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach($customer_orders as $index=> $customer_order)
                                <tr>
                                    <td>{{ $customer_orders->firstItem()+$loop->index}}</td>
                                    <td>{{ $customer_order->id}}</td>
                                    {{-- <td>{{ App\Order_list::find($customer_order->user_id)->amount }}</td> --}}
                                    <td>{{ $customer_order->full_name}}</td>
                                    <td>{{ $customer_order->email_address}}</td>
                                    <td>{{ $customer_order->address}}</td>
<<<<<<< HEAD
                                    @if( $customer_order->paid_status == 1)
                                    <td>
                                        <span class="badge badge-light">Cash on delivery</span>
                                    </td>
                                    @else
                                    <td>
                                        <span class="badge badge-primary">Card</span>
                                    </td>
                                    @endif
                                    <td>৳ {{ $customer_order->sub_total}}</td>
                                    <td>৳ {{ $customer_order->total}}</td>
                                    <td>{{ $customer_order->created_at->format('d/m/Y H:i:s A') }}</td>
=======
                                    @if( $customer_order->status == 1)
                                    <td>
                                        <span class="badge badge-light">Cash on delivery</span>
                                    </td>
                                    @elseif($customer_order->status == 2)
                                    <td>
                                        <span class="badge badge-primary">Online</span>
                                    </td>
                                    @else
                                    <td>
                                        <span class="badge badge-primary">SSLCommerz</span>
                                    </td>
                                    @endif
                                    <td>৳ {{ $customer_order->sub_total}}</td>
                                    <td>৳ {{ $customer_order->amount}}</td>
                                    @if($customer_order->created_at)
                                    <td style="color: green">{{ $customer_order->created_at->toDayDateTimeString() }}</td>
                                    @else
                                    <td style="color: red">Processing</td>
                                    @endif
>>>>>>> testing
                                    <td>
                                        <a href="{{ url('order/download') }}/{{ $customer_order->id }}" class="btn btn-dark btn-sm">Download</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $customer_orders->links() }}
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
