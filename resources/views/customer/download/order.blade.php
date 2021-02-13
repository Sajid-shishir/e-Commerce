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
                                <span class="text-center">Catch Food Online- Receipt</span>
                                <p class="font-weight-bold mb-1">Invoice #{{ $order_info->id }}/{{ Str::random(6) }}</p>
                                <p class="text-muted">Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="row pb-5 p-5">
                            <div class="col-md-6">
                                {{-- <p class="font-weight-bold mb-4">Order ID: {{ $order_info->id }}</p> --}}
                                {{-- <p class="font-weight-bold mb-4">Purchase Date: {{ $order_info->created_at->format('d/m/Y H:i:s A') }}</p> --}}
                                <p class="mb-1">Name: {{ $order_info->full_name }}</p>
                                <p class="mb-1">Address: {{ $order_info->address }}</p>
                                <p class="mb-1">City: {{ $order_info->relationtocity->city_name }}</p>
                                <p class="mb-1">Email: {{ $order_info->email_address }}</p>
                                <p class="mb-1">Phone: {{ $order_info->phone_number }}</p>
                                <p class="mb-1">Coupon Name: {{ $order_info->coupon_name ??  "Null" }}</p>
                                <p class="mb-1">Total: {{ $order_info->amount }}/-</p>
                            </div>

                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-4">Payment Details</p>
                                @if ( $order_info->payment_method == 2 )
                                <p class="mb-1"><span class="text-muted"><strong>Type: </strong></span>Card</p>
                                <p class="mb-1"><span class="text-muted"><strong>Status: </strong></span>Paid</p>
                                @else
                                <p class="mb-1"><span class="text-muted"><strong>Type: </strong></span>Cash on delivery</p>
                                <p class="mb-1"><span class="text-muted"><strong>Status: </strong></span>Pending</p>
                                @endif
                            </div>
                        </div>

                        <div class="row p-5">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            {{-- <th class="border-0 text-uppercase small font-weight-bold">ID</th> --}}
                                            <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                            {{-- <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Total</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            {{-- <td>1</td> --}}
                                            <td>{{ $product->product_name }}</td>
                                            {{-- <td>LTS Versions</td>
                                            <td>21</td>
                                            <td>$321</td>
                                            <td>$3452</td> --}}
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Grand Total</div>
                                <div class="h2 font-weight-light">$234,234</div>
                            </div>

                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Discount</div>
                                <div class="h2 font-weight-light">10%</div>
                            </div>

                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Sub - Total amount</div>
                                <div class="h2 font-weight-light">$32,432</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
