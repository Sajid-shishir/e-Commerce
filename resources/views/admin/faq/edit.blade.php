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
        <a class="breadcrumb-item" href="{{ route('faq_post') }}">FAQ</a>
        <a class="breadcrumb-item" href="">{{ $faq->faq_question }}</a>
    </nav>
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
            @if (session('UpdateStatus'))
                <div class="alert alert-warning">
                    {{ session('UpdateStatus') }}
                </div>
            @endif
                <div class="card-header">
                  Edit FAQ
                </div>
                <div class="card-body">
                    {{-- @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif --}}
                    <form method="POST" action="{{ route('faq_edit_post') }}">
                        @csrf
                        <input type="hidden" name="faq_id" value="{{ $faq->id }}">
                        <div class="form-group">
                          <label>Questions</label>
                          <input type="text" class="form-control" name="faq_question" placeholder="Enter question" value="{{ $faq->faq_question }}">

                        </div>
                        <div class="form-group">
                          <label>Answers</label>
                          <textarea name="faq_answer" class="form-control" rows="10">{{ $faq->faq_answer }}</textarea>

                        </div>

                        <button type="submit" class="btn btn-warning">Edit FAQ</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
