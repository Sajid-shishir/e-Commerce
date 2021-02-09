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
                    <h2>Blog Details</h2>
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
<!-- blog-details-area start-->
<div class="blog-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-details-wrap">
                    <img src="{{ asset('uploads/blog') }}/{{ $blog_info->image }}" alt="">
                    <h3>{{ $blog_info->blog_title }}</h3>
                    <ul class="meta">
                        <li>{{ $blog_info->created_at->toDayDateTimeString() }}</li>
                        <li>By {{ $blog_info->connect_to_user->name }}</li>
                    </ul>
                    <p>{{ $blog_info->desc }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <aside class="sidebar-area">
                    <div class="widget widget_recent_entries recent_post">
                        <h4 class="widget-title">Related Blogs</h4>
                        <ul>
                            @foreach ($related_blogs as $related_blog)
                            <li>
                                <div class="post-img">
                                    {{-- <img src="{{ asset('uploads/blog') }}/{{ $related_blog->image }}" alt=""> --}}
                                </div>
                                <div class="post-content">
                                    <a href="{{ url('blog_show') }}/{{ $related_blog->id }}">{{ $related_blog->blog_title }} </a>
                                    <p>{{ $related_blog->created_at->toDayDateTimeString() }}</p>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

@endsection
