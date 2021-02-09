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
        <a class="breadcrumb-item" href="">Add Blog</a>
    </nav>
@endsection
@section('content')
<div class="container">
    <div class="row-mb-6">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @elseif(session('deleteStatus'))
            <div class="alert alert-danger">
                {{ session('deleteStatus') }}
            </div>
            @elseif(session('UpdateStatus'))
            <div class="alert alert-warning">
                {{ session('UpdateStatus') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                  List Of Blog
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No:</th>
                                <th>Blog Title</th>
                                <th>Added By</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $blog->blog_title }}</td>
                                <td>{{ $blog->connect_to_user->name }}</td>
                                <td>{{ $blog->desc }}</td>
                                <td>
                                    <img width="80"  src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="{{ $blog->image }}">
                                </td>
                            </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <br>
    <div class="row-mb-6">
        @can('add blog')
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                  Blog Post
                </div>
                <div class="card-body">
                    @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('blog_add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" class="form-control" name="blog_title" placeholder="Enter title" value="{{ old('blog_title') }}">
                          {{-- @error('blog_title')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror --}}
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea name="desc" class="form-control" rows="10">{{ old('desc') }}</textarea>
                          {{-- @error('desc')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror --}}
                        </div>
                        <div class="form-group">
                            <label>Thumbnail Photo</label>
                            <input type="file" class="form-control" name="image">
                          </div>
                        <button type="submit" class="btn btn-success">Add Blog</button>
                      </form>
                </div>
            </div>
        </div>
        @else
        <span class="lead m-auto"><h1 class="badge badge-danger">UnAuthorized</h1></span>
        <span class="lead m-auto"><h1 class="badge badge-danger">Only Blog Writter can can post blogs</h1></span>
        @endcan
    </div>
  </div>
</div>
@endsection
