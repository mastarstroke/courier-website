<!-- ========================= The Page for new orders for couriers ========================= -->


<!-- ========================= The Page for order history for couriers ========================= -->

@extends('courier.layouts.courier')
<!-- include courier file from layout folder  -->
@section('title', 'My Info')


@section('content')
<!-- Content start -->

<!-- Alert here -->
<div class="col-12">
    @include('admin.alert')
</div>

<div class="col-md-12">
    <div class="card card-primary card-outline">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <hr class="my-4">
            <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Your Recorded Info</h3>
		                <div class="section-intro">You can make changes to your submited information here!</a></div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						<div class="app-card-body">
						<form action="{{route('courier.courier-infos')}}" method="POST"enctype="multipart/form-data">
							@csrf

                            <img class="pb-3" width="100" src="/courierimage/{{$courierInfo->image}}" alt="">
                            
                            <div class="my-3">
							    <label for="image" class="form-label">Change Image</label>
                                <input type="file" name="image" id="image" class="form-control mt-0">
							</div>
							<div class="my-3">
							<label class="form-label">Name</label>
								<input type="text" class="form-control mt-0" name="name" value="{{Auth::user()->name}}">
							</div>
							<div class="my-3">
							<label class="form-label">Email</label>
								<input type="text" class="form-control mt-0" name="email" value="{{Auth::user()->email}}">
							</div>
							<div class="my-3">
							<label class="form-label">Phone</label>
								<input type="text" class="form-control mt-0" name="phone" value="{{Auth::user()->phone}}">
							</div>
							<div class="my-3">
							<label class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="{{$courierInfo->gender}}">{{$courierInfo->gender}}</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
							</div>
							<div class="my-3">
							<label class="form-label">Address</label>
								<input type="text" class="form-control mt-0" name="address" value="{{Auth::user()->address}}">
							</div>
							<div class="my-3">
							<label class="form-label">City</label>
								<input type="text" class="form-control mt-0" name="city" value="{{Auth::user()->city}}">
							</div>
							<div class="my-3">
							<label class="form-label">State</label>
								<input type="text" class="form-control mt-0" name="state" value="{{Auth::user()->state}}">
							</div>
							<div class="my-3">
							<label class="form-label">Country</label>
								<input type="text" class="form-control mt-0" name="country" value="{{Auth::user()->country}}">
							</div>
							<div class="my-3">
							<label class="form-label">Pincode</label>
								<input type="text" class="form-control mt-0" name="pincode" value="{{Auth::user()->pincode}}">
							</div>
							<div class="my-3">
							<label class="form-label">Transportation</label>
                                <select class="form-control" name="vehicle">
                                    <option value="{{$courierInfo->vehicle}}">{{$courierInfo->vehicle}}</option>
                                    <option value="motor-cycle">Motor-cycle</option>
                                    <option value="tri-cycle">Tri-cycle</option>
                                    <option value="car">Car</option>
                                    <option value="truck">Truck</option>
                                </select>
							</div>
							<div class="pb-5 mt-5">
								<button type="submit" class="btn btn-primary float-end">Save Changes</button>
							</div>
						</form>
						</div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->

		    </div><!--//container-fluid-->
	    </div><!--//app-content-->

    </div><!-- card end -->
</div><!-- col-md-12 end -->

@stop
<!-- Content end -->


<!-- Js here including datatable js file -->
@push('js')

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush