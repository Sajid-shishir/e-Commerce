@extends('layouts.frontend_master')
@section('cart')
active
@endsection
@section('content')
<div class="breadcumb-area bg-img-5 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($errors->all())
                <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                        @endforeach
                </div>
                @endif
                <form method="post" action="{{ url('update/cart') }}">
                    @csrf
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach (cart_products() as $cart_product)

                            <tr>
                                <td class="images"><img src="{{ asset('uploads/product_thumbnail') }}/{{ $cart_product->relationtoproducttable->product_thumbnail_photo }}" alt="{{ $cart_product->relationtoproducttable->product_thumbnail_photo }}"></td>
                                <td class="product"><a href="{{ url('product') }}/{{ $cart_product->relationtoproducttable->product_slug }}" target="_blank">{{ $cart_product->relationtoproducttable->product_name }}</a></td>
                                <td class="ptice">TK: {{ $cart_product->relationtoproducttable->product_price }}</td>

                                <input type="hidden" value="{{ $cart_product->id }}" name="cart_id[]" />
                                <td class="quantity cart-plus-minus ">
                                    <input type="text" value="{{ $cart_product->amount }}" name="cart_quantity[]" />
                                </td>
                                <td class="total">TK: {{ $cart_product->relationtoproducttable->product_price * $cart_product->amount }}
                                </td>

                                <td class="remove" class="lead">
                                    <a class="lead" href="{{ url('delete/from/cart') }}/{{ $cart_product->id }}"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button>Update Cart</button>
                                    </li>
                                    <li>
                                        <a href="{{ url('/') }}">Continue Shopping</a></li>
                                </ul>
                            </form>
                            <br>
                                <h3>Coupon</h3>
                                <p>Enter Your Coupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input type="text" placeholder="Coupon Code" id="coupon_text" value="{{ $coupon_name ?? "" }}">
                                    <a class="btn btn-danger" style="color: white" id="apply-btn">Apply Coupon</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Subtotal </span>TK: {{ sub_total() }}</li>

                                    @isset($discount_amount)
                                    <li><span class="pull-left">Coupon Discount </span>TK: {{ $discount_amount }} %</li>
                                    @endisset

                                    <li><span class="pull-left"> Total </span>

                                      @isset($discount_amount)
                                      Tk: {{ $total_from_cart = (sub_total()-(($discount_amount/100) * sub_total())) }}
                                      @else
                                      TK: {{ $total_from_cart = sub_total() }}
                                      @endisset

                                    </li>
                                </ul>
                                @isset ($cart_product->id)
                                <form action="{{ url('/example2')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="coupon_from_cart" value="{{ $coupon_name ?? "" }}">
                                    <input type="hidden" name="discount_amount" value="{{ $discount_amount ?? "" }}">
                                    <input type="hidden" name="total_from_cart" value="{{ $total_from_cart }}">
                                    <button type="submit" class="btn btn-danger" href="">Proceed to Checkout</button>
                                </form>
                                @else
                                <span class="lead"><span class="badge badge-danger">Your Cart is Empty</span></span>
                                @endisset

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
    <script type="text/javascript">
    $(document).ready(function(){

        $('#apply-btn').click(function(){

            var coupon_text =$('#coupon_text').val();
            var link_to_go = "{{ url('cart') }}/"+coupon_text;
            window.location.href = link_to_go;
        });
    });
    </script>

@endsection
