@extends('layouts.frontend_master')
@section('checkout')
    active
@endsection

@section('content')

<div class="breadcumb-area bg-img-5 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
             <form method="post" action="{{ url('checkout/post') }}">
                        @csrf
                        <span class="lead"><span class="badge badge-success">You are logged in as: {{ Auth::user()->name }}</span></span>
                        <div class="row">
                            <div class="col-12">
                                <p>Full Name</p>
                                <input type="text" value="{{ Auth::user()->name }}" name="full_name">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" value="{{ Auth::user()->email }}" name="email_address">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="phone_number" required>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country. *</p>
                                <select name="country_id" id="country_list" required>
                                    <option value="">-Select One-</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>City. *</p>
                                <select name="city_id" id="city_list" required>
                                    <option value="">-Select One-</option>
                                    {{-- <option value="2">Sylhet</option> --}}
                                </select>
                            </div>
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input type="text" name="address" required>
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea  placeholder="Notes about Your Order, e.g- Special Note for Delivery" name="note" required></textarea>
                            </div>
                        </div>
                  </div>
              </div>
             <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        @foreach (cart_products() as $cart_product)

                        <li>{{ $cart_product->relationtoproducttable->product_name }} <span class="pull-right">Tk: {{ $cart_product->relationtoproducttable->product_price *$cart_product->amount }}</span></li>
                        @endforeach
                        <input type="hidden" name="currency" value="BDT">
                        <input type="hidden" name="sub_total" value="{{ sub_total() }}">
                        <input type="hidden" name="amount" value="{{ $total_from_cart }}">
                        <input type="hidden" name="coupon_name" value="{{ $coupon_from_cart ?? "Null" }}">
                        <li>Subtotal: <span class="pull-right"><strong>Tk: {{ sub_total() }}</strong></span></li>
                        <li>Coupon: <span class="pull-right"><strong>{{ $coupon_from_cart ?? "Null" }}</strong></span></li>
                        <li>Discount: <span class="pull-right"><strong>{{ $discount_amount ?? "0" }} %</strong></span></li>
                        <li>Total:<span class="pull-right">Tk: {{ $total_from_cart }}</span></li>
                    </ul>
                    <ul class="payment-method">
                        <li>
                            <input id="delivery" type="radio" name="payment_method" value="1" checked>
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                        <li>
                            <input id="card" type="radio" name="payment_method" value="2" checked>
                            <label for="card">Credit Card/Paypal</label>
                        </li>
                        {{-- <li>
                            <input id="payment-form" type="radio" name="payment_method" value="3" >
                            <label for="card">Local Payments</label>
                        </li> --}}
                        {{-- <li>
                            <input id="bKash_button" type="radio" name="payment_method" value="3" >
                            <label for="card">Bkash</label>
                        </li> --}}
                    </ul>
                    @isset($cart_product)
                    <button type="submit">Place Order</button>
                    @else
                    <ul class="d-flex">
                        <li>
                            <span class="lead"><span class="badge badge-danger">Your Cart is Empty,Can't Place any Order</span></span>
                            <span class="lead"><span class="badge badge-danger"></span></span>
                            <br>
                        </li>
                    </ul>
                    @endisset
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer_script')
<script type="text/javascript">
$(document).ready(function(){

    $('#country_list').change(function(){
        var country_id =$(this).val();
               //ajax setup start
               $.ajaxSetup({
                   headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
                });
                //ajax setup end
                $.ajax({
                    type:'POST',
                    url:'/get/city/list',
                    data:{country_id:country_id},
                    success:function(data){
                        $('#city_list').html(data);
                    }
                });
    });
});

</script>
@endsection
