@extends('layouts.frontend_master')
@section('faq')
    active
@endsection
@section('content')
 <!-- .breadcumb-area start -->
 <div class="breadcumb-area bg-img-5 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Frequently Asked Questions (FAQ)</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>FAQ</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- about-area start -->
<div class="about-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
              <div class="about-wrap text-center">
                <h3>FAQ</h3>
              </div>
              <div class="accordion" id="accordionExample">
                        @forelse ($faqs_frontend as $faqs)
                        <div class="card border-0">
                            <div class="card-header border-0 p-0 my-3">
                                <button class="btn btn-link text-left py-3 w-100 text-white" type="button" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                {{ $faqs->faq_question }}
                                </button>
                            </div>

                            <div id="faq1" class="collapse show" aria-labelledby="faq1" data-parent="#accordionExample">
                            <div class="card-body">
                                {{ $faqs->faq_answer }}
                            </div>
                            </div>
                        </div>
                        @empty
                        <h6><span>No FAQ available</span></h6>
                        @endforelse
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
