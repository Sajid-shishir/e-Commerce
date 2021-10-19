<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Invoice</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row p-5">
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-1">Invoice #{{ $order_info->id }}-{{ uniqid() }}</p>
                                <p class="text-muted">Date: {{ \Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }}</p>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="row pb-5 p-5">
                            <div class="col-md-6">
                                {{-- <p class="font-weight-bold mb-4">Order ID: {{ $order_info->id }}</p> --}}

                                <p class="font-weight-bold mb-4">Purchase Date: {{ $order_info->created_at->format('d/m/Y H:i:s A') }}</p>

                                {{-- <p class="font-weight-bold mb-4">Purchase Date: {{ $order_info->created_at->format('d/m/Y H:i:s A') }}</p> --}}


                                <p class="mb-1">Name: {{ $order_info->full_name }}</p>
                                <p class="mb-1">Address: {{ $order_info->address }}</p>
                                <p class="mb-1">City: {{ $order_info->relationtocity->city_name }}</p>
                                <p class="mb-1">Email: {{ $order_info->email_address }}</p>
                                <p class="mb-1">Phone: {{ $order_info->phone_number }}</p>
                                <p class="mb-1">Coupon Name: {{ $order_info->coupon_name ??  "Null" }}</p>

                                <p class="mb-1">Total: {{ $order_info->total }}/-</p>

                                <p class="mb-1">Total: {{ $order_info->amount }}/-</p>


                                <p class="mb-1"><strong>Order ID: </strong> {{ $order_info->order_id }}</p>
                                <p class="mb-1"><strong>Name: </strong> {{ $order_info->full_name }}</p>
                                <p class="mb-1"><strong>Address: </strong> {{ $order_info->address }}</p>
                                <p class="mb-1"><strong>City: </strong> {{ $order_info->relationtocity->city_name }}</p>
                                <p class="mb-1"><strong>Email: </strong> {{ $order_info->email_address }}</p>
                                <p class="mb-1"><strong>Phone: </strong> {{ $order_info->phone_number }}</p>
                                <p class="mb-1"><strong>Coupon Used: </strong> {{ $order_info->coupon_name ?? Null }}</p>

                            </div>
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-4">Payment Details-</p>
                                @if ( $order_info->payment_method == 2 )
                                <p class="mb-1"><span class="text-muted"><strong>Type: </strong></span>Online</p>
                                <p class="mb-1"><span class="text-muted"><strong>Status: </strong></span>Paid</p>
                                @else
                                <p class="mb-1"><span class="text-muted"><strong>Type: </strong></span>Cash on delivery</p>
                                <p class="mb-1"><span class="text-muted"><strong>Status: </strong></span>Pending</p>
                                @endif
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="mb-1"><strong>Item-</strong>
                                            @foreach ($product as $item)
                                            <br>
                                            {{ $item }}/-

                                            @endforeach
                                        </p>
                                    </td>
                                    <br>
                                    <td>
                                        <p class="mb-1"><strong>Quantity-</strong>
                                            @foreach ($data2 as $v)
                                            <br>
                                           {{ $v }} x

                                            @endforeach
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-1"><strong>Price-</strong>
                                            @foreach ($price as $p)
                                            <br>
                                            {{ $p }}/-

                                            @endforeach
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                            <p class="mb-1"><strong>Total: </strong> {{ $order_info->amount }}/-</p>
                            <br>
                        </table>
                        <p class="mb-1"><strong>Thank you </strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
