@extends('layouts.dashboard')
@section('edit_profile')
    active
@endsection

@section('title')
    Edit Profile
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href=""> Edit Profile Page</a>
{{--        <a class="breadcrumb-item" href="">Edit Profile</a>--}}

    </nav>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                @if(session('password_change_success'))
                    <div class="alert alert-success">
                        {{ session('password_change_success')}}

                    </div>
                    @endif()
                <div class="card">
                     <div class="card-header">
                         Change Password
                     </div>
                       <div class="card-body">
                           <form method="post" action="{{ route('change_password') }}">
                               @csrf
                               <div class="form-group">
                                   <label>Old Password</label>
                                   <input type="password" class="form-control" placeholder="Enter Old Password" name="old_password">
                               </div>
                               <div class="form-group">
                                   <label>New Password</label>
                                   <input type="password" class="form-control" placeholder="Enter New Password" name="password">
                               </div>
                               <div class="form-group">
                                   <label>Confirm Password</label>
                                   <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
                               </div>
                               <button type="submit" class="btn btn-outline-info">Change Password</button>
                           </form>
                           <br>
                           @if($errors->all())
                               <div class="alert alert-danger">
                                   @foreach($errors->all() as $error)
                                       <li>{{$error}}</li>
                                   @endforeach

                               </div>
                           @endif
                       </div>

                </div>
            </div>
        </div>
    </div>


@endsection
