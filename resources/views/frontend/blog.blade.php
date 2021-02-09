@extends('layouts.frontend_master')
@section('blog')
    active
@endsection
@section('content')
<div class="breadcumb-area bg-img-5 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Frequently Asked Questions (FAQ)</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Blog</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- blog-area start -->
<div class="blog-area">
    <div class="container">
        <div class="col-lg-12">
            <div class="section-title  text-center">
                <h2>Latest Blogs</h2>
                <img src="assets/images/section-title.png" alt="">
            </div>
        </div>
        <div class="row">
            @forelse ($blog_frontend as $blog)

            <div class="col-lg-4  col-md-6 col-12">
                <div class="blog-wrap">
                    <div class="blog-image">
                        <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="">

                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i>{{ $blog->connect_to_user->name  }}</a></li>
                                <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i>{{ $blog->created_at->toDayDateTimeString() }}</a></li>
                            </ul>
                        </div>
                        <h3><a href="{{ url('blog_show') }}/{{ $blog->id }}">{{ $blog->blog_title }}</a></h3>
                        <p>{{ $blog->desc }}</p>
                    </div>
                </div>
            </div>

            @empty

            @endforelse
        </div>
    </div>
</div>
@endsection
