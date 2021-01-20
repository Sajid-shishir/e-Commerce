@extends('layouts.dashboard')
@section('add_product')
    active
@endsection

@section('title')
    Add Product
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href=""> Add Product Page</a>
    </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    List of Product
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Thumbnail Photo</th>                               
                                <th>Product multiple Photo</th>                               
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index=> $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $index }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_price }}</td>                                
                                    <td>
                                        <img width="170" height="130" src="{{ asset('uploads/product_thumbnail') }}/{{ $product->product_thumbnail_photo }}" alt="not found">
                                    </td>
                                    <td>
                                    @forelse ($product->get_multiple_photos as $multiple_photo)
                                    <img width="80"  src="{{ asset('uploads/product_multiple') }}/{{ $multiple_photo->multiple_photo_name }}" alt="not found">
                                    <br>
                                    <br>
                                    @empty
                                    <span>No photo</span>
                                    @endforelse
                                    </td>
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50" class="text-center text-danger">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Product
                </div>
                <div class="card-body">
                        @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                    <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                                               
                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="category_id" class="form-control">
                            <option value="">-Select one-</option>
                            @foreach ($categories as $category)
                                
                            <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                            @endforeach
                            
                            </select>
                          </div>                                                         
                        <div class="form-group">
                          <label>Product Name</label>
                          <input type="text" class="form-control" name="product_name">
                        </div>
                        <div class="form-group">
                          <label>Product Price</label>
                          <input type="text" class="form-control" name="product_price">
                        </div>
                        <div class="form-group">
                          <label>Product Quantity</label>
                          <input type="text" class="form-control" name="quantity">
                        </div>
                        <div class="form-group">
                          <label>Product Short Description</label>
                          <textarea name="product_short_desc" class="form-control"  rows="4"></textarea>
                        </div>
                        <div class="form-group">
                          <label>Product Long Description</label>
                          <textarea name="product_long_desc" class="form-control"  rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Thumbnail Photo</label>
                            <input type="file" class="form-control" name="product_thumbnail_photo">
                          </div>
                          <div class="form-group">
                            <label>Product Multiple Photos</label>
                            <input required type="file" class="form-control" name="product_multiple_photos[]" multiple>
                          </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>   

@endsection