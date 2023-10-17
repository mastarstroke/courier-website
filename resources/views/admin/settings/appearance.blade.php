
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
			    <h1 class="app-page-title">Appearances</h1>

				<h2 class="text-center">Section-One</h2>

			    <hr class="mb-4">
				<form class="settings-form" action="{{route('admin.section-one')}}" method="POST" enctype="multipart/form-data">
					@csrf
                <div class="row g-4 settings-section">

	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Hero Section</h3>
						<div class="section-intro">First View section which displays with grey backgrounds</a></div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    <div class="app-card-body">
								<div class="mb-3">
									<label for="title" class="form-label">Title(Words here appear bold on the fron page)</label>
									<textarea type="text" class="" id="title" name="hero_title" required cols="3" rows="2">{{$setting_one->hero_title}}</textarea>
								</div>

								<div class="mb-3">
									<label for="paragraph" class="form-label">Paragraph</label>
									<textarea type="text" class="" id="paragraph" name="hero_paragraph" required cols="10" rows="5">{{$setting_one->hero_paragraph}}</textarea>
								</div>

								<div class="mb-3">
									<label for="image" class="form-label">Change Image</label>
									<input type="file" name="hero_image" id="image" class="form-control">
									<img class="pt-3" width="200" src="/settingsimage/{{$setting_one->hero_image}}" alt="">
								</div>
							</div><!--//app-card-body-->						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->

                <hr class="my-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">About Us</h3>
		                <div class="section-intro">About-Us section intro goes here. Update About us section here!</a></div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						<div class="app-card-body">
							<div class="mb-3">
								<label for="title" class="form-label">Title (Words here appear bold on the fron page)</label>
								<textarea type="text" class="" id="title" name="about_title" required cols="3" rows="2">{{$setting_one->about_title}}</textarea>
							</div>

							<div class="mb-3">
								<label for="paragraph" class="form-label">Paragraph</label>
								<textarea type="text" class="" id="paragraph" name="about_paragraph" required cols="10" rows="5">{{$setting_one->about_paragraph}}</textarea>
							</div>

							<div class="mb-3">
								<label for="image" class="form-label">Image</label>
								<input type="file" name="about_image" id="about_image" class="form-control">
								<img class="pt-3" width="200" src="/settingsimage/{{$setting_one->about_image}}" alt="">
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

				<h2 class="text-center">Section-Two</h2>

				<hr class="my-3">

				<!-- Modify How it works and contact_us section -->

				<form class="settings-form" action="{{route('admin.section-two')}}" method="POST" enctype="multipart/form-data">
					@csrf
                <div class="row g-4 settings-section">

	                <div class="col-12 col-md-4">
		                <h3 class="section-title">How It Works</h3>
						<div class="section-intro">Here you modify "How it works" section.</a></div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    <div class="app-card-body">
								<div class="mb-3">
									<label for="title" class="form-label">Title(Words here appear bold on the fron page)</label>
									<textarea type="text" class="" id="how_title" name="how_title" required cols="3" rows="2">{{$setting_two->how_title}}</textarea>
								</div>

								<div class="mb-3">
									<label for="paragraph" class="form-label">Paragraph</label>
									<textarea type="text" class="" id="paragraph" name="how_paragraph" required cols="10" rows="5">{{$setting_two->how_paragraph}}</textarea>
								</div>

								<div class="mb-3">
									<label for="image" class="form-label">Image</label>
									<input type="file" name="how_image" id="how_image" class="form-control">
									<img class="pt-3" width="200" src="/settingsimage/{{$setting_two->how_image}}" alt="">
								</div>
							</div><!--//app-card-body-->						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->

                <hr class="my-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Contact-Less</h3>
		                <div class="section-intro">Contact-Less section intro goes here. Update Contact us section here!</a></div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						<div class="app-card-body">
							<div class="mb-3">
								<label for="title" class="form-label">Title (Words here appear bold on the fron page)</label>
								<textarea type="text" class="" id="contact_title" name="contact_title" required cols="3" rows="2">{{$setting_two->contact_title}}</textarea>
							</div>

							<div class="mb-3">
								<label for="paragraph" class="form-label">Paragraph</label>
								<textarea type="text" class="" id="contact_paragraph" name="contact_paragraph" required cols="10" rows="5">{{$setting_two->contact_paragraph}}</textarea>
							</div>

							<div class="mb-3">
								<label for="image" class="form-label">Image</label>
								<input type="file" name="contact_image" id="contact_image" class="form-control">
								<img class="pt-3" width="200" src="/settingsimage/{{$setting_two->contact_image}}" alt="">
							</div>
						</div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->

                <hr class="my-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Contact Us</h3>
		                <div class="section-intro">Contact-Us section intro goes here. Update Contact us section here!</a></div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						<div class="app-card-body">

							<div class="mb-3">
								<label for="image" class="form-label">Image</label>
								<input type="file" name="contact_us" id="contact_image" class="form-control">
								<img class="pt-3" width="200" src="/settingsimage/{{$setting_two->contact_us}}" alt="">
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