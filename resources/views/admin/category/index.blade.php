@extends('layouts.dashboard')
@section('add_category')
    active
@endsection

@section('title')
    Add Category
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href=""> Add Category Page</a>
    </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    List of Category
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Category Name</th>
                                <th>Added By</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->connect_to_user_table->name }}</td>
                                    <td>
                                        <img width="80"  src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt="{{ $category->category_photo }}">
                                    </td>

                                    @can('edit category')
                                    <td>
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-info btn-sm">Edit</a>
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
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">

                <div class="card-header">
                    Add Category
                </div>
                @can('add category')
                <div class="card-body">
                    @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif
                <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Category Name</label>
                      <input type="text" class="form-control" placeholder="Enter your category Name" name="category_name" value="{{ old('category_name') }}">
                    </div>
                    <div class="form-group">
                        <label>Category Photo</label>
                        <input type="file" class="form-control" name="category_photo">
                      </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                  </form>
                @else
                    <span class="lead m-auto"><h1 class="badge badge-danger">UnAuthorized</h1></span>
                @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
