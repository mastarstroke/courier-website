
<!-- ========================= Index company details page, from admin end. 
Also some info here are the company details that displays on the frontend pages  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Settings')

<!-- css here -->
@push('css')
@endpush

@section('content')
<!-- content start -->

<!-- Alert here -->
<div class="col-12">
    @include('admin.alert')
</div>

<div class="col-md-12">
    <div class="card card-primary card-outline">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <hr class="my-4">
            <form action="{{route('admin.payment.setting')}}" method="POST">
                @csrf
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Payment Settings</h3>
                    <div class="section-intro">Choose which Payment Method 
                        you want to be active on the website. 
                        If you check it will be active for payment else it wiil be disappeared.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <hr class="my-3">			    
                        <div class="app-card-body">

                            <div class="form-check form-switch mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox"  name="paypal" {{$payment->paypal == '1' ?'checked' : ''}}>
                                                <label class="form-check-label text-uppercase"><Strong>PayPal</Strong></label>
                                                <p>Recieve payment with PayPal account by checking this box.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr class="my-3">
                            </div>

                            <div class="form-check form-switch mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox" name="stripe" {{$payment->stripe == '1' ?'checked' : ''}}>
                                                <label class="form-check-label text-uppercase"><Strong>Stripe</Strong></label>
                                                <p>Recieve payment with your stripe account by checking this box.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr class="my-3">
                            </div>

                            <div class="form-check form-switch mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox" name="paystack" {{$payment->paystack == '1' ?'checked' : ''}}>
                                                <label class="form-check-label text-uppercase"><Strong>PayStack</Strong></label>
                                                <p>Recieve payment with Paystack by checking this box.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr class="my-3">
                            </div>

                            <div class="form-check form-switch mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox" name="razorpay" {{$payment->razorpay == '1' ?'checked' : ''}}>
                                                <label class="form-check-label text-uppercase"><Strong>RazorPay</Strong></label>
                                                <p>Recieve payment with RazorPay by checking this box.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr class="my-3">
                            </div>

                            <div class="form-check form-switch mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox" name="cod" {{$payment->cod == '1' ?'checked' : ''}}>
                                                <label class="form-check-label text-uppercase"><Strong>COD (cash on delivery)</Strong></label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr class="my-3">
                            </div>

                        </div><!--//app-card-body-->
                        <div class="app-card-body">
                            <a href="{{route('admin.currency.add')}}" class="btn-sm btn-primary float-right px-1">Add New Currency+</a>
                        <div class="m-4">
                            <h6>Select Your Currency</h6>
                            <select name="currency" id="" class="w-50">
                                <option>{{$payment->currency}}</option>
                                @foreach($currency as $item)
                                <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->
            <hr class="my-3">

            <div class="pb-5">
                <button type="submit" class="btn btn-primary float-end">Save Changes</button>
            </div>

            </form>

		    </div><!--//container-fluid-->
	    </div><!--//app-content-->

    </div><!-- card end -->
</div><!-- col-md-12 end -->

@stop<!-- content end -->

<!-- Js here including the form submit functions -->
@push('js')

@endpush