
<!-- ========================= The Suspended Page for couriers ========================= -->

@extends('courier.layouts.courier')<!-- include courier file from layout folder  -->
@section('title', 'Suspended')

<!-- Js here  -->
@push('css')
@endpush

@section('content')<!-- Content start  -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-content">
                                <h4 class="wow fadeInUp" data-wow-delay=".2s">Your Account
                                    <span>Has been suspended</span>
                                </h4>
                                <h6 class="wow fadeInUp" data-wow-delay=".4s">
                                    Your Account with email ({{Auth::user()->email}}) Was suspended due to some breach
                                    of
                                    our courier rules and policies.
                                </h6>
                                <button id="contact" class="btn btn-danger mt-4" data-wow-delay=".6s">Send
                                    Message</button>

                                <div id="contactForm">

                                    <h1>Send Us Message!</h1>
                                    <small>The Admin will get back to you once recieved</small>

                                    <form action="{{route('contact-form')}}" method="post">
                                        @csrf
                                        <input placeholder="Name" name="name" type="text" required />
                                        <input placeholder="Email" name="email" type="email" required />
                                        <input placeholder="Subject" name="subject" type="text" required />
                                        <textarea type="text" placeholder="Comment" name="comment"></textarea>
                                        <input class="formBtn" type="submit" />
                                        <input class="formBtn" type="reset" />
                                    </form>
                                </div><!-- contactForm end -->

                            </div><!-- hero-content end -->
                        </div><!-- col-lg-12 end -->
                    </div><!-- row end -->

                </div><!-- card-body end -->
            </div><!-- card end -->
        </div><!-- col-md-12 end -->
    </div><!-- row end -->
</div><!-- Container end -->

@stop<!-- Content end -->

<!-- Js here -->
@push('Js')
@endpush