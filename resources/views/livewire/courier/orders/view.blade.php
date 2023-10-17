
<!-- ========================= View Order Page and section for Couriers ========================= -->

<div>
    <div class="container py-5 w-100"><!-- Container start -->
        <div class="card"><!-- Card start -->

            <div class="card-header"><!-- Card-header start -->
                <h4 class="text-black">Order View
                    <a href="{{route('courier.orders')}}" class="btn btn-warning text-white float-right">Back</a>
                </h4>
            </div><!-- Card-header end -->

            <div class="card-body"><!-- Card-body start -->
                <div class="row"><!-- row start -->
                    <div class="col-lg-7"><!-- col-lg-7 start -->
                        <h4>Billing Details</h4>

                        <div class="row">
                            <div class="col-sm-6">
                                <label class="mt-3">Client's Name</label>
                                <div class="border p-2">{{$orders->name}}</div>
                            </div>
                            <div class="col-sm-6">
                                <label class="mt-3">Email</label>
                                <div class="border p-2">{{$orders->email}}</div>
                            </div>

                            <div class="col-sm-6">
                                <label class="mt-3">Gender</label>
                                <div class="border p-2">{{$orders->gender}}</div>
                            </div>

                            <div class="col-sm-6">
                                <label class="mt-3">Phone</label>
                                <div class="border p-2">{{$orders->phone}}</div>
                            </div>

                            <div class="col-sm-6">
                                <label class="mt-3">From Location</label>
                                <div class="border p-2">
                                    {{$orders->from_location}}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="mt-3">To Location</label>
                                <div class="border p-2">
                                    {{$orders->to_location}}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="mt-3">Payment Mode</label>
                                <div class="border p-2">{{$orders->payment_mode}}</div>
                            </div>

                            <div class="col-sm-6">
                                <label class="mt-3">Payment ID</label>
                                <div class="border p-2">{{$orders->payment_id}}</div>
                            </div>
                        </div>
                    </div><!-- col-lg-7 end -->

                    <div class="col-lg-5 mt-5"><!-- col-lg-5 start -->
                        <h5>Order Details</h5>
                        <table class="table table-bordered"><!-- table start -->
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Product type</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{$orders->product_name}}</td>
                                    <td>{{$orders->product_type}}</td>
                                    <td><small>{{$currency->currency}}</small> {{$orders->service_price}}</td>
                                    <td>
                                        <img width="80" src="/orderimage/{{$orders->image}}" alt="Product image">
                                    </td>
                                </tr>

                            </tbody>
                        </table><!-- table end -->
                        <h6 class="px-2 float-end">Grand Total: <span><small>{{$currency->currency}}</small> {{$orders->service_price}}</span><!-- Grand price here -->
                        </h6>

                        <form action="{{route('courier.update-order', $orderId)}}" method="post"><!-- form start/update order by courier -->
                            @csrf
                            <div class="col-sm-6">
                                <div class="mt-4">
                                    <input type="hidden" value="1" name="order_status">
                                    @if($orders->status == '0')<!-- if order status is 0 = available for delivery -->
                                    <div class="bg-light p-3 mb-3">
                                        <span class="text-secondary">Make sure you are ready to ride in a second before
                                            takin the ride to avoid suspension.</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Take Ride</button>
                                    @endif

                                    @if($orders->status == '1')<!-- if order status is 1 = Taken by the courier -->
                                    <div class="btn btn-danger px-3">Taken</div>
                                    @endif

                                    @if($orders->status == '3')<!-- if order status is 3 = Delivered by courier/Approved by Admin -->
                                    <div class="bg-success p-2">Delivered/Completed</div>

                                    @if($orders->review == '')<!-- if order revieiw is NULL -->
                                    <div class="my-3">
                                        <div class="badge badge-secondary">No Review yet</div>
                                    </div>

                                    @else<!-- if there is order revieiw -->
                                    <div class="my-4">
                                        <label for="">Customer Review</label>
                                        <div class="border p-2">{{ $orders->review }}</div>
                                    </div>
                                    @endif
                                    @endif

                                </div><!-- div mt-4 end -->
                            </div><!-- col-sm-6 end -->
                        </form><!-- form end -->

                    </div><!-- col-lg-5 end -->
                </div><!-- row end -->

            </div><!-- Card-body end -->
        </div><!-- Card end -->

    </div><!-- Container end -->
</div>