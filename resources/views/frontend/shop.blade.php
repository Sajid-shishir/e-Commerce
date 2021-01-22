@extends('layouts.frontend_master')
@section('shop')
    active
@endsection

@section('content')

<div class="breadcumb-area bg-img-5 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shop Page</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Shop</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- product-area start -->
<div class="product-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="product-menu">
                    <ul class="nav justify-content-center">
                        <li>
                            <a class="active" data-toggle="tab" href="#all">All product</a>
                        </li>
                        @foreach ($categories as $category)
                        <li>
                            <a data-toggle="tab" href="#category_id_{{ $category->id }}">{{ $category->category_name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <ul class="row">
                    @foreach ($products as $product)
                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                        <div class="product-wrap">
                            <div class="product-img">
                                <img src="{{ asset('uploads/product_thumbnail') }}/{{ $product->product_thumbnail_photo }}" alt="">
                                <div class="product-icon flex-style">
                                    <ul>
                                        <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="single-product.html">{{ $product->product_name }}</a></h3>
                                <p class="pull-left">TK: {{ $product->product_price }}
                                </p>
                                <br>
                                <ul class="rating">
                                    @if(review_star_amount($product->id)  == 1)
                                    <li><i class="fa fa-star"></i></li>
                                    @elseif(review_star_amount($product->id)== 2)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    @elseif(review_star_amount($product->id) == 3)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    @elseif(review_star_amount($product->id) == 4)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    @elseif(review_star_amount($product->id) == 5)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    @else
                                    <li>No Review</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @foreach ($categories as $category)
            <div class="tab-pane" id="category_id_{{ $category->id }}">
                <ul class="row">
                    @foreach ($category->connect_to_product_table as $categorywise_product)
                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                        <div class="product-wrap">
                            <div class="product-img">

                                <img src="{{ asset('uploads/product_thumbnail') }}/{{ $categorywise_product->product_thumbnail_photo }}" alt="">
                                <div class="product-icon flex-style">
                                    <ul>
                                        <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="single-product.html">{{ $categorywise_product->product_name }}</a></h3>
                                <p class="pull-left">TK: {{ $categorywise_product->product_price }}
                                </p>
                                <ul class="rating">
                                    @if(review_star_amount($categorywise_product->id)  == 1)
                                    <li><i class="fa fa-star"></i></li>
                                    @elseif(review_star_amount($categorywise_product->id)== 2)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    @elseif(review_star_amount($categorywise_product->id) == 3)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    @elseif(review_star_amount($categorywise_product->id) == 4)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    @elseif(review_star_amount($categorywise_product->id) == 5)
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    @else
                                    <li>No Review</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
