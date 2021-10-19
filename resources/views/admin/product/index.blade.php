@extends('layouts.dashboard')
@section('add_product')
    active
@endsection

@section('title')
    Add Item
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href=""> Add Item Page</a>
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
            @endif
            <div class="card">
                <div class="card-header">
                    List of Product
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                                <th>Item Quantity</th>
                                <th>Item Category</th>
                                <th>Thumbnail Photo</th>
                                <th>Multiple Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index=> $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $index }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->relation_to_category->category_name }}</td>
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
                                    @can('edit product')
                                    <td>
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-light btn-sm fa fa-edit"> Edit</a>

                                    </td>
                                    <td>
                                        <form action="{{ route('product.destroy', $product->id)}}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i> Trash</button>
                                          </form>
                                    </td>
                                    @endcan
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
        <br>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Add Item
                </div>
                @can('add product')
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
                            <select name="category_id" class="form-control" required>
                            <option value="" >-Select one-</option>
                            @foreach ($categories as $category)

                            <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                            @endforeach

                            </select>
                          </div>
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}">
                        </div>
                        <div class="form-group">
                          <label>Price</label>
                          <input type="text" class="form-control" name="product_price" value="{{ old('product_price') }}">
                        </div>
                        <div class="form-group">
                          <label>Quantity</label>
                          <input type="text" class="form-control @error('name') border-red-500 @enderror"  name="quantity" value="{{ old('quantity') }}">
                        </div>
                        <div class="form-group">
                          <label>Short Description</label>
                          <textarea name="product_short_desc" class="form-control"  rows="4" value="">{{ old('product_short_desc') }}</textarea>
                        </div>
                        <div class="form-group">
                          <label>Long Description</label>
                          <textarea name="product_long_desc" class="form-control"  rows="4" value="">{{ old('product_long_desc') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Thumbnail Photo</label>
                            <input type="file" class="form-control" name="product_thumbnail_photo" value="{{ old('product_thumbnail_photo') }}">
                          </div>
                          <div class="form-group">
                            <label>Multiple Photos</label>
                            <input required type="file" class="form-control" name="product_multiple_photos[]" multiple>
                          </div>
                        <button type="submit" class="btn btn-success">Add</button>
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
