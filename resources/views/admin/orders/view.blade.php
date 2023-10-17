
<!-- ========================= View orders page from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'View Orders')

<!-- css here  -->
@push('css')
@endpush

@section('content')<!-- content start  -->

<div class="container">
    <div class="card">

        <div class="card-header">
            <h4 class="text-black">Orders View
                <a href="{{route('admin.orders.view')}}" class="btn-sm btn-warning text-white float-right"><ion-icon name="arrow-back-outline"></ion-icon>Back</a>
            </h4>
        </div><!-- card-header end  -->

        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <h4>Shipping Details</h4>

                    <div class="row">

                    <!-- fetching data of user from both users and order_couriers tables  -->
                        <div class="col-sm-6">
                            <label class="mt-3">User's Name</label>
                            <div class="border p-2">{{ $orders->name }}</div>
                        </div>
                        <div class="col-sm-6">
                            <label class="mt-3">Email</label>
                            <div class="border p-2">{{ $orders->email }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">Gender</label>
                            <div class="border p-2">{{ $orders->gender }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">Phone</label>
                            <div class="border p-2">{{ $orders->phone }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">From Location</label>
                            <div class="border p-4">
                                {{ $orders->from_location }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">To Location</label>
                            <div class="border p-4">
                                {{ $orders->to_location }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">Payment Mode</label>
                            <div class="border p-2">{{ $orders->payment_mode }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="mt-3">Payment ID</label>
                            <div class="border p-2">{{ $orders->payment_id }}</div>
                        </div>
                    </div><!-- row end  -->
                </div><!-- col-lg-7 end  -->

                <div class="col-lg-5 mt-5 px-2">
                    <h5>Order Details</h5>
                    <table class="table table-bordered order_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>

                        <!-- Data from the order_couriers table  -->
                            <tr>
                                <td>{{ $orders->product_name }}</td>
                                <td>{{ $orders->product_type }}</td>
                                <td><small>{{$currency->currency}}</small> <strong>{{ $orders->service_price }}</strong></td>
                                <td>
                                    <img width="50" src="/orderimage/{{$orders->image}}" alt="Product image">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <h6 class="px-2">Grand Total: <span class="float-end"><small>{{$currency->currency}}</small> {{ $orders->service_price }}</span><!-- Calculated grand total of price  -->
                    </h6>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="mt-4">
                                <label for="">Order Status</label>
                                <form action="{{route('admin.update-order' ,$orderId->id)}}" method="POST"><!-- Form started  -->
                                    @csrf

                                    <select class="form-select" name="order_status">
                                        <option>{{$orders->status}}</option>
                                        <option {{ $orders->status == 'New'? 'selected': '' }} value="New">Pending
                                        </option><!-- if status is NEW = select pending from the option  -->

                                        <option {{ $orders->status == 'cancel'? 'selected': '' }} value="cancel">Cancelled
                                        </option><!-- if status is NEW = select pending from the option  -->

                                        <option {{ $orders->status == '0'? 'selected': '' }} value="0">Confirmed
                                        </option><!-- if status is 0 = select confirmed from the option  -->

                                        <option {{ $orders->status == '3'? 'selected': '' }} value="3">Completed
                                        </option><!-- if status is 3 = select completed from the option  -->
                                    </select>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary py-1 mt-3">Update</button><!-- update option button  -->
                                        </div>
                                    </div>
                                </form><!-- form end  -->
                            </div><!-- Div mt-4 end  -->
                        </div><!-- col-md-5 end  -->

                        @if($orders->status == '1')<!-- if status is 1 from the order_couriers table, show these infos  -->
                        <div class="col-md-7 mt-4 pr-1 bg-light">
                            <span class="text-secondary">Taken</span>
                            <p>Courier: {{$orders->courier}}</p>
                            <p>Courier Id: {{$orders->courier_id}}</p>
                        </div>
                        @endif

                        @if($orders->status == '2')<!-- if status is 2 from the order_couriers table, show these infos  -->
                        <div class="col-md-7 mt-4 pr-1 bg-light">
                            <span class="text-success">Delivered By:</span>
                            <p>{{$orders->courier}}</p>
                            <p>Id: {{$orders->courier_id}}</p>

                        </div>
                        @endif

                        @if($orders->status == '3')<!-- if status is 3 from the order_couriers table, show these infos  -->
                        <div class="col-md-7 mt-4">
                            <span class="text-success">Delivered By:</span>
                            <p>{{$orders->courier}}</p>
                            <p>Id: {{$orders->courier_id}}</p>


                            @if($orders->review == '')<!-- if review is NULL from the order_couriers table, show these infos  -->
                            <div class="mb-3">
                                <div class="badge badge-secondary">No Review yet</div>
                            </div>

                            @else<!-- if review is not NULL from the order_couriers table, show these infos  -->
                            <div class="my-4">
                                <label for="">Customer Review</label>
                                <div class="border p-2">{{ $orders->review }}</div>
                            </div>
                            @endif
                        </div>

                        @endif

                    </div><!-- row end  -->


                </div><!-- col-lg-5 end  -->
            </div><!-- row end  -->

        </div><!-- card-body end  -->
    </div><!-- card end  -->

</div><!-- container start  -->

@stop<!-- content start  -->

<!-- js here  -->
@push('js')
@endpush