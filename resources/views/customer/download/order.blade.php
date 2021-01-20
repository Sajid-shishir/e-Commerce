<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
      <div class="container">
        <div class="card">
          <div class="card-header">
          Invoice-Date:
           <strong>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</strong>
            <span class="float-right"> <strong>Status:</strong> Paid</span>
          </div>
          <div class="card-body">
             <div class="row mb-4">
                        <div class="col-sm-6">
                                <h6 class="mb-3">From:</h6>
                                <div>
                                <strong>Catch Food Online</strong>
                                </div>
                                <div>Uttara</div>
                                <div>Dhaka-1230, Bangladesh</div>
                                <div>Email: sajidulhaque007@gmail.com.</div>
                                <div>Phone: +880 1686662852</div>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="mb-3">To:</h6>
                            <div><strong>Order ID: {{ $order_info->id }}</strong></div>
                            <div>
                            <strong>Name: {{ $order_info->full_name }}</strong>
                            </div>
                            <div>
                               <strong> Address:</strong> {{ $order_info->address }}
                            </div>
                            <div>
                                <strong> City:</strong> {{ $order_info->relationtocity->city_name }}
                             </div>
                            <div>
                              <strong>  Email: </strong>{{ $order_info->email_address }}
                            </div>
                            <div>
                              <strong>  Phone: </strong>{{ $order_info->phone_number }}
                            </div>
                            {{-- <div>
                             <strong> Coupon Name: </strong>{{ $order_info->coupon_name ??  "Null" }}
                            </div>
                            <div>
                               <strong> Sub-total: </strong>{{ $order_info->sub_total }}/-
                            </div>
                            <div>
                               <strong> Total: </strong>{{ $order_info->total }}/-
                            </div> --}}
                        </div>
                  </div>
            <br>
            {{-- <div class="table table-bordered"> --}}
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th >Sl No:</th>
                        <th>Item</th>
                        <th >Unit Cost</th>
                        <th >Qty</th>
                        <th >Total</th>
                        </tr>
                   </thead>
                   <tbody>
                       @foreach (orderinfo() as  $info)
                       <tr>
                           <td >1</td>
                           <td >{{ $info->id }}</td>
                           <td >$999,00</td>
                           <td >1</td>
                           <td class="right">$999,00</td>
                       </tr>
                       @endforeach
                   </tbody>
                </table>
            {{-- </div> --}}

          <div class="row">
          <div class="col-lg-4 col-sm-5">

          </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                          <tbody>
                            <tr>
                                <td class="left">
                                <strong>Subtotal</strong>
                                </td>
                                <td class="right">$8.497,00</td>
                            </tr>
                            <tr>
                                <td class="left">
                                <strong>Discount (20%)</strong>
                                </td>
                                <td class="right">$1,699,40</td>
                            </tr>
                            <tr>
                                <td class="left">
                                <strong>VAT (10%)</strong>
                                </td>
                                <td class="right">$679,76</td>
                            </tr>
                            <tr>
                                <td class="left">
                                <strong>Total</strong>
                                </td>
                                <td class="right">
                                <strong>$7.477,36</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
