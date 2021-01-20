@extends('layouts.frontend_master')
@section('home')
    active
@endsection
@section('content')
<div class="product-area">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Searched Product</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            @forelse ($searched_products as $product)
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        <span>Sale</span>
                        <img src="{{ asset('/uploads/product_thumbnail') }}/{{ $product->product_thumbnail_photo }}" alt="">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="{{  route('product.show',$product->product_slug) }}">{{ $product->product_name }}</a></h3>
                        <h3>Category: {{ App\Category::find($product->category_id)->category_name }}</h3>
                        <p class="pull-left">${{ $product->product_price }}

                        </p>
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="col-12 text-center">
                <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
            </li>
            @empty
            <li  class="col-12 text-center">
                <span class="lead"><span class="badge badge-danger">No Result Found</span></span>
            </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
