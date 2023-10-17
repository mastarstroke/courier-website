
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
            <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Addind new Currency</h3>
		                <div class="section-intro">This currency will be added to your settings and it will be ready for activation!</a></div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						<div class="app-card-body">
						<form action="{{route('admin.currency.store')}}" method="POST">
							@csrf
							<div class="mb-3">
							<label class="form-label m-auto">Currency Name</label>
								<input type="text" class="form-control" name="name" placeholder="ie: USD">
							</div>
							<div class="mb-3">
							<label class="form-label">Currency Sign</label>
								<input type="text" class="form-control" name="sign" placeholder="ie: $">
							</div>
							<div class="pb-5">
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

@stop<!-- content end -->

<!-- Js here including the form submit functions -->
@push('js')

@endpush