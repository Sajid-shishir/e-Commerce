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
                    <h2>Product Details</h2>
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
<!-- single-product-area start-->
<div class="single-product-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-single-img">
                    <div class="product-active owl-carousel">
                        <div class="item">
                            <img src="{{ asset('uploads/product_thumbnail') }}/{{ $product_info->product_thumbnail_photo }}" alt="">
                        </div>
                        @foreach ($product_info->get_multiple_photos as $multiple_photo)
                        <div class="item">
                            <img src="{{ asset('uploads/product_multiple') }}/{{ $multiple_photo->multiple_photo_name }}" alt="">
                        </div>
                        @endforeach

                    </div>
                    <div class="product-thumbnil-active  owl-carousel">
                        <div class="item">
                            <img src="{{ asset('uploads/product_thumbnail') }}/{{ $product_info->product_thumbnail_photo }}" alt="">
                        </div>
                        @foreach ($product_info->get_multiple_photos as $multiple_photo)
                        <div class="item">
                            <img src="{{ asset('uploads/product_multiple') }}/{{ $multiple_photo->multiple_photo_name }}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-single-content">
                    <h3>{{ $product_info->product_name }}</h3>
                    <h6>Available Quantity: {{ $product_info->quantity }}</h6>
                    <div class="rating-wrap fix">
                        <span class="pull-left">৳ {{ $product_info->product_price }}</span>
                        <ul class="rating pull-right">
                            @if(review_star_amount($product_info->id) == 1)
                            <li><i class="fa fa-star"></i></li>
                            @elseif(review_star_amount($product_info->id) == 2)
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            @elseif(review_star_amount($product_info->id) == 3)
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            @elseif(review_star_amount($product_info->id) == 4)
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            @elseif(review_star_amount($product_info->id) == 5)
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            @else
                            <li>No review</li>
                            @endif
                            <li><strong>({{ App\Order_list::where('product_id',$product_info->id)->whereNotNull('review')->count() }}</strong> Customer Review)</li>
                        </ul>
                    </div>
                    <p>
                        {{ $product_info->product_short_desc }}

                    </p>
                    <ul class="input-style">
                        <form action="{{ url('add/to/cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                            <li class="quantity cart-plus-minus">
                                <input type="text" value="1" name="amount" />
                            </li>
                            <li><button type="submit" class="btn btn-danger">Add to Cart</button></li>
                        </form>
                    </ul>
                    <ul class="cetagory">
                        <li><strong>Categories:</strong></li>
                        <li><a href="#">{{ App\Category::find($product_info->category_id)->category_name }}</a></li>
                    </ul>
                    {{-- <ul class="socil-icon">
                        <li>Share :</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-12">
                <div class="single-product-menu">
                    <ul class="nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>

                        <li><a data-toggle="tab" href="#review">Review</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <div class="description-wrap">
                            <p>{{ $product_info->product_long_desc }}</p>
                        </div>
                    </div>

                    <div class="tab-pane" id="review">
                        <div class="review-wrap">
                            <ul>
                                @foreach (App\Order_list::where('product_id',$product_info->id)->whereNotNull('review')->get() as $review)
                                <li class="review-items">
                                    <div class="review-content">
                                        <h3><a href="#">{{ App\User::find($review->user_id)->name }}</a></h3>
                                        <span>{{ $review->updated_at->toDayDateTimeString() }}</span>
                                        <p>{{ $review->review }}</p>
                                        <ul class="rating">
                                            @if($review->star == 1)
                                            <li><i class="fa fa-star"></i></li>
                                            @elseif($review->star== 2)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            @elseif($review->star == 3)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            @elseif($review->star == 4)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            @elseif($review->star == 5)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            @else
                                            <li>No review</li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>

                                @endforeach

                            </ul>
                        </div>
                        <div class="add-review">
                            <h4>Add A Review?</h4>
                            @auth
                            @if (App\Order_list::where('user_id',Auth::id())->where('product_id',$product_info->id)->whereNull('review')->exists())
                            <form method="post" action="{{ url('add/review') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                            <div class="ratting-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>task</th>
                                            <th>1 Star</th>
                                            <th>2 Star</th>
                                            <th>3 Star</th>
                                            <th>4 Star</th>
                                            <th>5 Star</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>How Many Stars?</td>
                                            <td>
                                                <input type="radio" name="star" value="1" />
                                            </td>
                                            <td>
                                                <input type="radio" name="star" value="2" />
                                            </td>
                                            <td>
                                                <input type="radio" name="star" value="3" />
                                            </td>
                                            <td>
                                                <input type="radio" name="star" value="4" />
                                            </td>
                                            <td>
                                                <input type="radio" name="star" value="5" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <h4>Name:</h4>
                                    <input type="text" value="{{ Auth::user()->name }}" disabled/>
                                </div>
                                <div class="col-md-6 col-12">
                                    <h4>Email:</h4>
                                    <input type="email" value="{{Auth::user()->email }}" disabled/>
                                </div>
                                <div class="col-12">
                                    <h4>Your Review:</h4>
                                    <textarea name="review" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn-style" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                            @else
                            <span class="lead"><span class="badge badge-danger">You Already Reviewed or Haven't Purchased the Product Yet</span></span>
                            @endif
                            @else
                            <span class="lead"><strong class="badge badge-danger">Login First</strong></span>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- single-product-area end-->
<!-- featured-product-area start -->
<div class="featured-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-left">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($related_products as $related_product)
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="featured-product-wrap">
                    <div class="featured-product-img">
                        <img src="{{ asset('/uploads/product_thumbnail') }}/{{ $related_product->product_thumbnail_photo }}"  alt="">
                    </div>

                    <div class="featured-product-content">
                        <div class="row">
                            <div class="col-7">
                                <h3><a href="{{  route('product.show',$related_product->product_slug) }}">{{ $related_product->product_name }}</a></h3>
                                <p>৳ {{ $related_product->product_price }}</p>
                            </div>
                            <div class="col-5 text-right">
                                <ul>
                                    <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
