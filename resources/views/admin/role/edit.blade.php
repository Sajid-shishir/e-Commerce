@php
    error_reporting(0);
@endphp
@extends('layouts.dashboard')
@section('manage_role')
    active
@endsection

@section('title')
    Manage Role
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href="{{ route('manage.role') }}"> Manage Role Page</a>
        <a class="breadcrumb-item" href=""> Edit Role Page</a>
    </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">
                    Change Permission for : {{ $user->name }}
                </div>
                <div class="card-body">
                        @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                    <form method="post" action="{{ route('role.permission.edit.post') }}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <label>Select Permission</label>
                            @foreach ($permissions as $permission)
                            <label class="ckbox">
                                <input {{ ($user->hasPermissionTo($permission->name)) ? "checked":"" }} type="checkbox" name="permission[]" value="{{ $permission->name  }}">
                                <span>{{ $permission->name }}</span>
                            </label>
                            @endforeach
                          </div>

                        <button type="submit" class="btn btn-dark">Add Permission</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
