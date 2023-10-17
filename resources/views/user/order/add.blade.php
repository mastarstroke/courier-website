<!-- ======================== Order for courier Page ========================= -->


@extends('user.layouts.user')
<!-- Extension from the user/layouts file -->
@section('title', 'Order For Courier')
@push('css')
<!-- Css here -->
@endpush

@section('content')
<!-- Content start -->

<div class="my-4">

    <!-- ========================= Page Container ========================= -->
    <div class="container px-5">
        <!-- Container start -->
        <h3 class="m-3 text-center"> Order A nearBy Courier</h3>
        <div class="card mb-4">
            <!-- Card start -->

            <div class="col-12">
                @include('user.alert')
                <!-- Alert here -->
            </div>

            <div class="card-header">
                <!-- Card-header start -->
                <a href="/" class="float-left btn btn-secondary">Back</a><!-- Go Back button -->
            </div><!-- Card-header end -->

            <div class="card-body">
                <!-- Card-body start -->

                @if($errors->any())
                @foreach($errors->all() as $error)
                <p class="text-danger">{{$error}}</p>
                @endforeach
                @endif

                <!-- ========================= Order form ========================= -->
                <form action="{{route('order-courier')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" placeholder="Enter Product Name" required>
                    @error('product_name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <label for="product_type">Product Type</label>
                    <select type="text" name="product_type" required>
                        <option>Choose Product</option>

                        @foreach($front_services as $service)
                        <option value="{{$service->name}}">{{$service->name}}</option>
                        @endforeach

                    </select>
                    @error('product_type')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <label for="service_type">Service Type/Price</label>
                    <select type="text" name="service_price" required>
                        <option>Choose Service</option>

                        @foreach($services as $service)
                        <option value="{{$service->price}}">{{$service->service_name}} || {{$service->per_kg_rate}}
                        </option>
                        @endforeach

                    </select>
                    @error('service_type')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <label for="from_location">From location</label>
                    <textarea type="text" name="from_location" id="from_location" rows="2"
                        placeholder="The Location of the Product, where you want it picked up" required></textarea>
                    @error('from_location')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <label for="to_location">To Location</label>
                    <textarea type="text" name="to_location" id="to_location" rows="2"
                        placeholder="The Location where you want your Products delivered" required></textarea>
                    @error('to_location')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <label for="image">Parcel's Photo</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                    @error('image')
                    <small class="text-danger">{{$message}}</small>
                    @enderror

                    <div class="row mt-4">
                        <div class="col-6">
                            <button type="submit" class="checkout btn btn-primary">Proceed to Checkout</button>
                        </div>

                    </div>

                </form><!-- Order form end -->
            </div><!-- Card-body end -->
        </div><!-- Card end -->
    </div><!-- Container end -->

</div>

@stop
<!-- Page content end -->

<!-- Js here -->
@push('js')
@endpush