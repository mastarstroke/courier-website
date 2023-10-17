<!-- ========================= Orders View page for users ========================= -->

@extends('user.layouts.user')
<!-- Extension from the user/layouts file -->
@section('title', 'View Orders')
<base href="/public">

@push('css')
<!-- Css here including datatable -->
@endpush

@section('content')
<!-- Content start -->

<!-- ========================= Page Container ========================= -->
<div class="container py-5">

    <div class="card">
        <div class="card-header">
            <a href="/">Home</a>
            <a href="{{url('myorders')}}" class="btn-sm btn-warning text-white float-right"><ion-icon name="arrow-back-outline"></ion-icon>Back</a>
        </div><!-- Card-header end -->

        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <!-- col-lg-7 start -->

                    <!-- ========================= Shipping Details of the User ========================= -->
                    <h4>Shipping Details</h4>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="mt-3">User's Name</label>
                            <div class="border p-2">{{ $orders->name }}</div>
                        </div>
                        <div class="col-sm-6">
                            <label class="mt-3">Email</label>
                            <div class="border p-2">{{ $orders->email }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">Phone</label>
                            <div class="border p-2">{{ $orders->phone }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">From Location</label>
                            <div class="border p-2">
                                {{ $orders->from_location }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">To Location</label>
                            <div class="border p-2">
                                {{ $orders->to_location }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">Tracking Number</label>
                            <div class="border p-2">{{ $orders->tracking_no }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">Payment Mode</label>
                            <div class="border p-2">{{ $orders->payment_mode }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">Payment ID</label>
                            <div class="border p-2">{{ $orders->payment_id }}</div>
                        </div>
                    </div><!-- row end -->
                </div><!-- col-lg-7 end -->


                <!-- ========================= Details of the order in details ========================= -->
                <div class="col-lg-5 mt-5">
                    <!-- col-lg-5 start -->
                    <h4>Order Details</h4>
                    <table class="table table-bordered">
                        <!-- table start -->
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Product_type</th>
                                <th>Price($)</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $orders->product_name }}</td>
                                <td>{{ $orders->product_type }}</td>
                                <td>{{$currency->currency}} {{ $orders->service_price }}</td>
                                <td>
                                    <img width="80" src="/orderimage/{{$orders->image}}" alt="Product image">
                                </td>
                            </tr>

                        </tbody>
                    </table><!-- Table end -->
                    <h5 class="px-2">Grand Total: <span class="float-end">{{$currency->currency}} <strong>{{ $orders->service_price }}</strong></span>
                    </h5>

                    <form action="{{route('order-review', $orderId)}}" method="post">
                        <!-- Status update form start -->
                        @csrf
                        <div class="col-sm-5 mt-4">
                            @if($orders->status == '3')
                            <!-- Status 3 means delivered -->
                            <div class="bg-success p-2 btn btn-sm text-white text-center">Delivered/Completed</div>
                        </div>

                        @if($orders->review == '')
                        <!-- if review empty -->
                        <div class="mt-4">
                            <label for="">Write a Review?</label>
                            <textarea type="text" class="border" name="review" cols="2"></textarea>
                            <button type="submit" class="btn btn-primary mt-0">Send</button>
                        </div>

                        @else
                        <!-- If there is a review -->
                        <div class="mt-4">
                            <label for="">Your Review, Thanks</label>
                            <div class="border p-2">{{ $orders->review }}</div>
                        </div>
                        @endif

                        @endif
                    </form><!-- Review update form end -->

                    @if($orders->status == 'New')
                    <form action="{{route('cancel-order', $orderId)}}" method="post">
                        @csrf
                        <!-- If the status of the order is new -->
                        <input type="hidden" name="cancel-order" value="cancel">
                        <button type="submit" class="btn btn-secondary mt-3">Cancel Order</button>
                    </form>
                    @endif

                    @if($orders->status == 'cancel')
                    <!-- If the status of the order is cancelled by the user -->
                    <div class="bg-danger p-2 btn btn-sm text-white text-center">Cancelled</div>
                    @endif

                </div><!-- col-lg-5 end -->

            </div><!-- row end -->
        </div><!-- Card-body end -->

    </div><!-- Card end -->
</div><!-- Container end -->

</div>


@stop
<!-- Content end -->

@push('js')
<!-- Js here -->
@endpush