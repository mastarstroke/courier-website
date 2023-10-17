
<!-- ========================= Index company details page, from admin end. 
Also some info here are the company details that displays on the frontend pages  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Company Master')

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

        <form action="" id="company-form" method="POST" enctype="multipart/form-data"><!-- form start -->
            @if(count($companies) > 0)<!-- if the company table has added data -->
            @method('PUT')
            @endif
            @csrf

            <div class="card-header">
                <h5 class="m-0" id="heading">
                    @if(count($companies) > 0)
                    Edit existing Company
                    @else
                    Add new Company
                    @endif
                </h5>
            </div><!-- card-header end -->

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-sm-6">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control"
                                    @if(count($companies)>0)
                                value="{{$company->company_name}}"
                                @endif
                                >
                                @error('company_name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="company_logo">Company Logo</label>
                                <input type="file" name="company_logo" id="company_logo" class="form-control">
                                @if(count($companies)>0)
                                <img height="100" width="100" class="mt-3"
                                    src="/storage/company/{{$company->company_logo}}" alt="">
                                @endif
                                @error('company_logo')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="company_city">Company City</label>
                                <input type="text" name="company_city" id="company_city" class="form-control"
                                    @if(count($companies)>0)
                                value="{{$company->company_city}}"
                                @endif
                                >
                                @error('company_city')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="company_state">Company State</label>
                                <input type="text" name="company_state" id="company_state" class="form-control"
                                    @if(count($companies)>0)
                                value="{{$company->company_state}}"
                                @endif
                                >
                                @error('company_state')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="company_pin">Company Pincode</label>
                                <input type="text" name="company_pin" id="company_pin" class="form-control"
                                    @if(count($companies)>0)
                                value="{{$company->company_pin}}"
                                @endif
                                >
                                @error('company_pin')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-3 mt-3">
                                <label for="company_country">Company Country</label>
                                <input type="text" name="company_country" id="company_country" class="form-control"
                                    @if(count($companies)>0)
                                value="{{$company->company_country}}"
                                @endif
                                >
                                @error('company_country')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-3 mt-3">
                                <label for="company_phone">Company Phone</label>
                                <input type="text" name="company_phone" id="company_phone" class="form-control"
                                    @if(count($companies)>0)
                                value="{{$company->company_phone}}"
                                @endif
                                >
                                @error('company_phone')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-3 mt-3">
                                <label for="company_phone">Company Email</label>
                                <input type="text" name="company_email" id="company_email" class="form-control"
                                    @if(count($companies)>0)
                                value="{{$company->company_email}}"
                                @endif
                                >
                                @error('company_email')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-3 mt-3">
                                <label for="company_gst">Company GST</label>
                                <input type="text" name="company_gst" id="company_gst" class="form-control"
                                    @if(count($companies)>0)
                                value="{{$company->company_gst}}"
                                @endif
                                >
                                @error('company_gst')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-sm-6 mt-3">
                                <label for="address">Company Address</label>
                                <textarea type="text" name="address" id="address" rows="2"
                                    class="form-control">@if(count($companies)>0) {!! $company->address !!} @endif</textarea>
                                @error('address')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        </div><!-- row end -->
                    </div><!-- col-lg-12 -->
                </div><!-- row end -->
            </div><!-- card-body end -->

            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <button onclick="companyFormSubmit()"
                            class="btn btn-primary">{{ count($companies)>0 ? 'Update Company Details' : 'Save Company Details'}}</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{route('admin.dashboard')}}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div><!-- card-footer end -->
        </form><!-- form end -->

    </div><!-- card end -->
</div><!-- col-md-12 end -->

@stop<!-- content end -->

<!-- Js here including the form submit functions -->
@push('js')
<script>
function companyFormSubmit() {
    var heading = $('#heading').val();
    if (heading == 'Add new Company') {
        $('#company-form').attr('action', '{{ route('admin.company.store') }}').submit();
    } else {
        $('#company-form').attr('action', '{{ route('admin.company.update') }}').submit();
    }
}
</script>
@endpush