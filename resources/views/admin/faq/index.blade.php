@extends('layouts.dashboard')
@section('faq')
    active
@endsection

@section('title')
    FAQ
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('home')}}">Home Page</a>
        <a class="breadcrumb-item" href="">FAQ</a>
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
                  List Of FAQ
                </div>
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">SL No:</th>
                            <th scope="col">Question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($faqs as $faq)
                            <tr>

                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $faq->faq_question }}</td>
                                <td>{{ $faq->faq_answer }}</td>
                                <td>
                                    @can('add faq')

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a type="button" class="btn btn-light btn-sm text-black fa fa-edit" href="{{ url('faq_edit') }}/{{ $faq->id }}"> Edit</a>
                                        <a type="button" class="btn btn-danger btn-sm text-white fa fa-trash" href="{{ url('faq_delete') }}/{{ $faq->id }}"> Trash</a>
                                    </div>
                                    @endcan

                                </td>

                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">No data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @can('add faq')
            <div class="card">


                <div class="card-header">
                  Frequently Asked Questions
                </div>
                <div class="card-body">
                    {{-- @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif --}}
                    <form method="POST" action="{{ route('faq_add') }}">
                        @csrf
                        <div class="form-group">
                          <label>Questions</label>
                          <input type="text" class="form-control" name="faq_question" placeholder="Enter question" value="{{ old('faq_question') }}">
                          @error('faq_question')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Answers</label>
                          <textarea name="faq_answer" class="form-control" rows="10">{{ old('faq_answer') }}</textarea>
                          @error('faq_answer')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Add FAQ</button>
                      </form>
                </div>
            </div>
            @else
            <span class="lead m-auto"><h1 class="badge badge-danger">UnAuthorized</h1></span>
            <span class="lead m-auto"><h1 class="badge badge-danger">Only Blog Writter can Add Faq</h1></span>
            @endcan
        </div>
    </div>
</div>
@endsection
