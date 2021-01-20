@extends('layouts.dashboard')
@section('add_category')
    active
@endsection

@section('title')
    Edit Category
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href="{{route('category.index')}}">Category Page</a>
        <a class="breadcrumb-item" >{{ $category->category_name }}</a>
    </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Category
                </div>
                @can('edit category')
                <div class="card-body">
                        @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                    <form method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                        {{ method_field('put') }}
                        @csrf
                        <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" class="form-control" placeholder="Enter your category Name" name="category_name" value="{{ $category->category_name }}">
                        </div>
                        <div class="form-group">
                            <label>Category Photo</label>
                            <input type="file" class="form-control" name="category_photo">
                          </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                      </form>
                </div>
                @else
                <span class="lead m-auto"><h1 class="badge badge-danger">UnAuthorized</h1></span>
                @endcan

            </div>
        </div>
    </div>
</div>


@endsection
