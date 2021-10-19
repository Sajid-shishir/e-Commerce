@extends('layouts.dashboard')
@section('edit_coupon')
    active
@endsection

@section('title')
    Edit Coupon
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href="{{ route('coupon.index') }}">Coupon Page</a>
        <a class="breadcrumb-item" href=""> Edit Coupon</a>
    </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Coupon
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
                    <form method="post" action="{{ route('coupon.update', $coupon->id) }}" enctype="multipart/form-data">
                        {{ method_field('put') }}
                        @csrf
                        <div class="form-group">
                          <label>Coupon Name</label>
                          <input type="text" class="form-control" placeholder="Enter your category Name" name="coupon_name" value="{{ $coupon->coupon_name }}">
                        </div>
                        <div class="form-group">
                            <label>Discount Amount (%)</label>
                            <input type="text" class="form-control" name="discount_amount" value="{{ $coupon->discount_amount }}">
                          </div>
                          <div class="form-group">
                            <label>Valid Till </label>
                            <input type="date" class="form-control" name="valid_till" min="{{ \Carbon\carbon::now()->format('Y-m-d') }}">
                          </div>
                        <button type="submit" class="btn btn-success">Update</button>
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
