@extends('layouts.dashboard')
@section('add_product')
    active
@endsection

@section('title')
    Edit Item
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href="{{route('product.index')}}">Item Page</a>
        <a class="breadcrumb-item" >{{ $product->product_name }}</a>
    </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Item
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
                    <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                        {{ method_field('put') }}
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="category_id" class="form-control" required>
                            <option value="" >-Select one-</option>
                            @foreach ($categories as $category)

                            <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                            @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                          <label> Name</label>
                          <input type="text" class="form-control" placeholder="Enter your category Name" name="product_name" value="{{ $product->product_name }}">
                        </div>
                        <div class="form-group">
                            <label> Price</label>
                            <input type="text" class="form-control" placeholder="Enter your category Name" name="product_price" value="{{ $product->product_price }}">
                          </div>
                          <div class="form-group">
                            <label> Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter your category Name" name="quantity" value="{{ $product->quantity }}">
                          </div>
                        <div class="form-group">
                            <label> Thumbnail Photo</label>
                            <input type="file" class="form-control" name="product_thumbnail_photo">
                          </div>
                        <button type="submit" class="btn btn-warning">Update</button>
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
