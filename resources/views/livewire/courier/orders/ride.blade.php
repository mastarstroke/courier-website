
<!-- ========================= Ride Page and section for Couriers ========================= -->

@extends('courier.layouts.courier')<!-- Extension from the courier/layouts file -->
@section('title', 'Delivering page')

@push('css')<!-- Css here -->
@endpush

@section('content')<!-- Content start -->

<div class="container py-5 w-100"><!-- Container start -->
    <div class="card"><!-- Card start -->

        <div class="card-body"><!-- Card-body start -->
            <table class="table table-bordered"><!-- Table start -->
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Parcel's Image</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{$orders->product_name}}</td>
                        <td>{{$orders->product_type}}</td>
                        <td>
                            <img width="80" src="/orderimage/{{$orders->image}}" alt="Product image">
                        </td>
                    </tr>

                </tbody>
            </table><!-- Table end -->

            <div class="row my-5"><!-- row start -->
                <div class="col-lg-6"><!-- col-lg-6 start -->
                    <h6 class="bg-light border p-2">Picking this parcel from:
                        <strong> {{$orders->from_location}} </strong>
                    </h6>
                    <h6 class="bg-light border p-2">Delivering this parcel to
                        :<strong> {{$orders->to_location}} </strong></h6>
                    <h6 class="bg-light border p-2">Client's name: <strong> {{$orders->name}} </strong></h6>
                    <h6 class="bg-light border p-2">Client's Phone: <strong> {{$orders->phone}} </strong></h6>
                    <h6 class="bg-light border p-2">Payment Mode :<strong> {{$orders->payment_mode}} </strong></h6>
                    <h6 class="bg-light border p-2">Price :<strong> <small>{{$currency->currency}}</small> {{$orders->service_price}} </strong></h6>
                </div><!-- col-lg-6 end -->
            </div><!-- row end -->

            <form action="{{route('courier.update-order',$orderId)}}" method="post"><!-- form start/update order status -->
                @csrf
                <div class="col-sm-5"><!-- col-sm-5 start -->
                    <div class="mt-4">
                        <input type="hidden" value="2" name="order_status">
                        @if($orders->status == '2')<!-- if order status is 2 = Delivered by the courier -->
                        <div class="btn btn-success px-3">Delivered Successfully</div>
                        <div class="bg-light p-2 mt-3">
                            <span class="text-success">Hope you get a good review. <a
                                    href="{{route('courier.order-completed')}}">orderhistory?</a></span>
                        </div>
                        @else
                        <div class="bg-light p-3 mb-3">
                            <span class="text-secondary">You Can only Click on "delivered" when it has been delivered to
                                the client.</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Delivered</button><!-- Update button to deliver by the courier -->
                        @endif
                    </div><!-- div mt-4 end -->
                </div><!-- col-sm-5 end -->
            </form><!-- form end -->

        </div><!-- Card-body end -->
    </div><!-- Card end -->

</div><!-- Container end -->

@stop<!-- Content end -->

@push('js')<!-- Js here -->
@endpush