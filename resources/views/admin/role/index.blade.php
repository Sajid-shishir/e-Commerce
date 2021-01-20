{{-- @php
    error_reporting(0);
@endphp// it is used for not showing any error --}}
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
        <a class="breadcrumb-item" href=""> Manage Role Page</a>
    </nav>
@endsection
@section('content')
<div class="container">
    @can('manage role')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">
                    List of Roles
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $index=> $role)
                                <tr>
                                    <td>{{ $loop->index+ 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                    @foreach ($role->getPermissionNames() as $permission)
                                        <li> {{ $permission }} </li>
                                    @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50" class="text-center text-danger">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{$products->links()}} --}}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    List of Users
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>User Name</th>
                                <th>Roles</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index=> $user)
                                <tr>
                                    <td>{{ $loop->index+ 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                    @foreach ($user->getRoleNames() as $role)
                                        <li> {{ $role }} </li>
                                    @endforeach
                                    </td>
                                    <td>
                                    <ol>
                                        @foreach ($user->getAllPermissions() as $permission)
                                        <li> {{ $permission->name }} </li>
                                    @endforeach
                                    </ol>
                                    </td>
                                    <td>
                                        <a href="{{ url('role/permission/edit') }}/{{ $user->id }}"class="btn btn-light">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50" class="text-center text-danger">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{$products->links()}} --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    Add Role
                </div>
                <div class="card-body">
                        @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                    <form method="post" action="{{ route('role.add') }}">
                        @csrf
                        <div class="form-group">
                          <label>Role Name</label>
                          <input type="text" class="form-control" name="role_name">
                        </div>
                        <div class="form-group">
                            <label>Select Permission</label>
                            @foreach ($permissions as $permission)
                            <label class="ckbox">
                                <input type="checkbox" name="permission[]" value="{{ $permission->name  }}">
                                <span>{{ $permission->name }}</span>
                            </label>
                            @endforeach
                          </div>

                        <button type="submit" class="btn btn-secondary">Add Role</button>
                      </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Assign Role
                </div>
                <div class="card-body">
                        @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                    <form method="post" action="{{ route('role.assign') }}">
                        @csrf
                        <div class="form-group">
                          <label>User Name</label>
                          <select class="form-control" name="user_id">
                              @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                          </select>
                        </div>
                       <div class="form-group">
                          <label>Role Name</label>
                          <select class="form-control" name="role_name">
                              @foreach ($roles as $role)
                              <option value="{{ $role->name }}">{{ $role->name }}</option>
                              @endforeach
                          </select>
                        </div>
                        <button type="submit" class="btn btn-secondary">Assign Role</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <span class="lead m-auto"><h1 class="badge badge-danger">Only SuperAdmin Can Manage Role</h1></span>
    @endcan

</div>

@endsection
