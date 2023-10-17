
<!-- ========================= Checkout page for users after the Order requests ========================= -->


@extends('user.layouts.user')<!-- Extension from the user/layouts file -->

@section('title', 'checkout')
<base href="/public">

@section('content')<!-- Content Start -->

<div class="container my-4"><!-- container start -->
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <h1 class="page-title">Checkout<span>Page</span></h1>
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('order-index')}}">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="col-12">
        @include('user.alert')<!-- Alert Here -->
        </div>

    <!-- ========================= Checkout Form validated for all payments with specific errors underneath ========================= -->
    <form action="" id="billing-form" method="POST">
    @csrf
        <div class="row my-5">
            <div class="col-lg-8">
                <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                @if(Session::has('stripe_error'))
                <div class="alert alert-danger" role="alert">{{Session::get('stripe_error')}}</div>
                @endif
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <label>Full Name *</label>
                        <input type="text" class="form-control name" value="{{Auth::user()->name}}" name="name" required>
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="name_error" class="text-danger"></span>
                    </div><!-- End .col-sm-6 -->

                    <div class="col-sm-6">
                        <label>Email address *</label>
                        <input type="email" class="form-control email mb-0" value="{{Auth::user()->email}}" name="email"
                            required>
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="email_error"  class="text-danger"></span>
                    </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->
                <div class="row mt-4">
                    <div class="col-sm-6">
                        <label>Gender *</label>
                        <input type="text" name="gender" class="form-control gender" value="{{Auth::user()->gender}}" required>
                        @error('gender')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="gender_error" class="text-danger"></span>

                    </div><!-- End .row -->

                    <div class="col-sm-6">
                        <label>Country *</label>
                        <input type="text" class="form-control mb-0 country" value="{{Auth::user()->country}}" name="country"
                            required>
                        @error('country')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="country_error" class="text-danger"></span>

                    </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->


                <div class="row mt-4">
                    <div class="col-sm-6">
                        <label>City *</label>
                        <input type="text" class="form-control city" value="{{Auth::user()->city}}" name="city" required>
                        @error('city')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="city_error" class="text-danger"></span>
                    </div><!-- End .col-sm-6 -->

                    <div class="col-sm-6">
                        <label>State*</label>
                        <input type="text" class="form-control mb-0 state" value="{{Auth::user()->state}}" name="state"
                            required>
                        @error('state')
                        <small id="state_error" class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="state_error" class="text-danger"></span>
                    </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->

                <div class="row mt-4">
                    <div class="col-sm-6">
                        <label>Postcode / ZIP *</label>
                        <input type="text" class="form-control postcode" value="{{Auth::user()->pincode}}" name="postcode"
                            required>
                        @error('postcode')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="postcode_error" class="text-danger"></span>
                    </div><!-- End .col-sm-6 -->

                    <div class="col-sm-6 mb-0">
                        <label>Phone *</label>
                        <input type="text" class="form-control mb-0 phone" value="{{Auth::user()->phone}}" name="phone"
                            required>
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="phone_error" class="text-danger"></span>
                    </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->

                <div class="row mt-4">
                    <div class="col-sm-6 mb-0">
                        <label>Street address *</label>
                        <textarea type="text" class="form-control address" name="address" cols="4" rows="2"
                            placeholder="House number and Street name" required>{{Auth::user()->address}}</textarea>
                        @error('address')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <span id="address_error" class="text-danger"></span>
                    </div>

                    <div class="col-sm-6">
                        <label>Order notes (optional)</label>
                        <textarea type="text" class="form-control" name="message" cols="30" rows="4"
                            placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                    </div>
                </div>
            </div><!-- End .col-lg-8 -->

            <aside class="col-lg-4">
                <div class="summary">
                    <h3 class="summary-title mt-3">Your Order</h3><!-- End .summary-title -->

                    <table class="table table-summary">
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr class="summary-subtotal">
                                <td><strong>Parcel's name</strong></td>
                                <td>{{$checkout->product_name}}</td>
                            </tr>

                            <tr>
                                <td><strong>From</strong></td>
                                <td>{{$checkout->from_location}}</td>
                            </tr>

                            <tr>
                                <td><strong>To</strong></td>
                                <td>{{$checkout->to_location}}</td>
                            </tr>

                            <tr>
                                <td><strong>Image</strong></td>
                                <td> <img height="80" width="100" src="orderimage/{{$checkout->image}}" alt="">
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Service Price</strong></td>
                                <td>{{$payment->currency}} <strong>{{$checkout->service_price}}</strong></td>
                            </tr>


                        </tbody>
                    </table><!-- End .table table-summary -->

                    <br>

                    @if($checkout->payment_mode == '')

                    @if($payment->cod == '1')
                    <input type="hidden" name="payment_mode" value="COD">
                    <button onclick="CODSubmit()" class="btn btn-success w-100 mb-3">Place-Order | COD</button><!-- COD payment button -->
                    @endif

                    <input type="hidden" class="price" name="price" value="{{$checkout->service_price}}">
                    @if($payment->paypal == '1')
                    <button onclick="PaypalSubmit()" class="btn btn-outline-primary w-100 mb-3">Pay with PayPal</button><!-- PayPal payment button -->
                    @endif

                    @if($payment->stripe == '1')
                    <button class="btn btn-outline-secondary w-100 mb-3" onclick="openForm()">Pay with Card/Stripe</button><!-- Card/Stripe payment button -->
                    @endif
                    <!-- Card/Stripe Payment form hidden by default -->
                    <div id="myForm" class="card-from mb-3">
                        <div class="row mt-3">
                        <div class="col-12 mb-2">
                            <p><strong>Note:</strong> For testing purpose only, 
                            you can use this Card No: 4242424242424242 ...
                            Any name, cvc and valid date of your choice can be used.</p>
                        </div>
                            <div class="col-sm-12">
                                <label>Card Name</label>
                                <input type="text" class="form-control mt-0" name="card_name" required>
                                @error('card_name')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-md-12">
                                <label>Card Number</label>
                                <input type="text" class="form-control mt-0" name="card_no" required>
                                @error('card_no')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-sm-4">
                                <label>Expiry Month</label>
                                <input type="text" class="form-control mt-0" name="exp_month" placeholder="MM" required>
                                @error('exp_month')<small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="col-sm-4">
                                <label>Expiry year</label>
                                <input type="text" class="form-control mt-0" name="exp_year" placeholder="YYYY"
                                    required>
                                @error('exp_year')<small class="text-danger">{{$message}}</small>@enderror
                            </div>

                            <div class="col-sm-4">
                                <label>CVC</label>
                                <input type="text" class="form-control mt-0" name="cvc" placeholder="123" required>
                                @error('cvc')<small class="text-danger">{{$message}}</small>@enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100" onclick="cardPayment()">Pay
                                {{$checkout->service_price}} <small>{{$payment->currency}}</small></button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger w-100 cancel"
                                    onclick="closeForm()">Close</button>
                            </div>
                        </div>
                    </div><!-- End .card form -->

                    <input type="hidden" name="currency" value="NGN">
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                    @if($payment->paystack == '1')
                    <button class="btn btn-outline-success w-100 mb-3" onclick="PaystackSubmit()">Pay with Paystack</button><!-- PayStack payment button -->
                    @endif

                    @if($payment->razorpay == '1')
                    <input type="hidden" name="currency" class="currency" value="{{$payment->currency}}">
                    <button class="btn btn-outline-primary w-100 razorpay_btn">Pay with RazorPay</button><!-- RazorPay payment button -->
                    @endif

                    @else
                    <div class="mt-4">
                        <h4>This Order has been placed. Thanks</h4>
                        <p class="mt-3">View All Orders <a href="{{route('myorders')}}">Here</a></p>
                    </div> 
                    @endif

                </div><!-- End .summary -->
            </aside><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </form>
</div><!-- End .container -->

@stop<!-- Content stop -->

@push('js')<!-- Js here -->

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="assets/js/checkout.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script>
// function including route for COD payment
function CODSubmit() {
    $('#billing-form').attr('action', '{{ route('place-order') }}').submit();
}

// function including route for PayPal payment
function PaypalSubmit() {
    $('#billing-form').attr('action', '{{ route('payment') }}').submit();
}

// function including route for Card/Stripe payment
function cardPayment() {
    $('#billing-form').attr('action', '{{ route('card-payment') }}').submit();
}

// function including route for Paystack payment
function PaystackSubmit() {
    $('#billing-form').attr('action', '{{ route('paystack') }}').submit();
}

</script>

@endpush