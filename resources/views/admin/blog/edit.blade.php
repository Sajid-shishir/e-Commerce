@extends('layouts.dashboard')
@section('blog')
    active
@endsection

@section('title')
    Blog
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href="{{ route('blog_post') }}">Blog</a>
        <a class="breadcrumb-item" href=""> {{ $blog->blog_title }}</a>
    </nav>
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
            @if (session('UpdateStatus'))
                <div class="alert alert-warning">
                    {{ session('UpdateStatus') }}
                </div>
            @endif
                <div class="card-header">
                  Edit Blog
                </div>
                <div class="card-body">
                    {{-- @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif --}}
                    <form method="POST" action="{{ route('blog_edit_post') }}">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" class="form-control" name="blog_title" placeholder="Enter question" value="{{ $blog->blog_title }}">

                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea name="desc" class="form-control" rows="10">{{ $blog->desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Thumbnail Photo</label>
                            <input type="file" class="form-control" name="image">
                          </div>
                        <button type="submit" class="btn btn-warning">Edit Blog</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
