@extends('layouts.frontend_master')
@section('contact')
    active
@endsection
@section('content')
<div class="breadcumb-area bg-img-5 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Contact Us</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Contact</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- contact-area start -->
<div class="google-map">
    <div class="contact-map">
        <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Uttara,dhaka+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="100%" height="600" frameborder="0"></iframe>
    </div>
</div>
<div class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="contact-form form-style">
                    <div class="cf-msg"></div>
                    <div class="contact-wrap">
                        <ul>
                            <li>
                                <i class="fa fa-home"></i> Address:
                                <p>Sector-10, Uttara,Dhaka-1230</p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> Email address:
                                <p>
                                    <span>sajidulhaque@gmail.com </span>
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> phone number:
                                <p>
                                    <span>+8801686662852</span>
                                    <span>+8801634174881</span>
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-commenting-o"></i>Want to Chat?
                                <p>
                                    <span>Create a free account and find us on live messenger</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                    {{-- <form action="http://themepresss.com/tf/html/tohoney/mail.php" method="post" id="cf">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <input type="text" placeholder="Name" id="fname" name="fname">
                            </div>
                            <div class="col-12  col-sm-6">
                                <input type="text" placeholder="Email" id="email" name="email">
                            </div>
                            <div class="col-12">
                                <input type="text" placeholder="Subject" id="subject" name="subject">
                            </div>
                            <div class="col-12">
                                <textarea class="contact-textarea" placeholder="Message" id="msg" name="msg"></textarea>
                            </div>
                            <div class="col-12">
                                <button id="submit" name="submit">SEND MESSAGE</button>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
            <div class="col-lg-4 col-12">
            </div>
        </div>
    </div>
</div>
<!-- contact-area end -->
<!-- start social-newsletter-section -->
@endsection
