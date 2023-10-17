
<!-- ========================= Add courier form/page, from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Add New Courier')

<!-- css here  -->
@push('css')
@endpush

@section('content')<!-- content  -->

<!-- Alert here -->
<div class="col-12">
    @include('admin.alert')
</div>

<div class="card card-primary card-outline">

    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <a href="{{route('admin.courier.view')}}" class="btn btn-secondary btn-sm">Back</a>
            </div>
        </div>
    </div><!-- card-header end  -->

    <form action="{{route('admin.courier.store')}}" method="POST" enctype="multipart/form-data"><!-- form start  -->
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <label for="name">Courier's Name</label>
                            <input name="name" id="name" class="form-control">
                            @error('name')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-6 mt-3">
                            <label for="email">Email</label>
                            <input name="email" id="email" class="form-control">
                            @error('email')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="phone">Phone</label>
                            <input type="phone" name="phone" id="phone" class="form-control">
                            @error('phone')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="branch">Branch</label>
                            <select name="branch" id="branch" class="form-control">
                                @foreach($branchs as $branch)
                                <option value="{{$branch->branch_name}}">{{$branch->branch_name}}</option>
                                @endforeach

                            </select>
                            @error('branch')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('branch_id')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="vehicle">Type Of Vehicle</label>
                            <input name="vehicle" id="vehicle" class="form-control">
                            @error('vehicle')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-12 mt-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" rows="4" class="form-control"></textarea>
                            @error('address')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="city">City</label>
                            <input name="city" id="city" class="form-control">
                            @error('city')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="state">State</label>
                            <input name="state" id="state" class="form-control">
                            @error('state')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="pincode">Pincode</label>
                            <input name="pincode" id="pincode" class="form-control">
                            @error('pincode')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="country">Country</label>
                            <input name="country" id="country" class="form-control">
                            @error('country')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-4">
                            <label for="password">Give Password</label>
                            <input name="password" id="password" class="form-control">
                            @error('password')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-4">
                            <label for="company_logo">Courier's Photo</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if($image)
                            Photo Preview::
                            <img height="100" width="100" class="mt-3" src="{{$image->temporaryUrl() }}" alt="">
                            @endif
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <input type="hidden" value="2" name="role_id" id="role_id"><!-- Automatimatically add this to column "role" in the courier_model table  -->

                    </div><!-- row end  -->
                </div><!-- col-lg-12  -->
            </div><!-- row end  -->
        </div><!-- card-body end  -->

        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary">Add Courier</button>
                </div>
            </div>
        </div><!-- card-footer end  -->
    </form><!-- form end  -->
</div><!-- Card end  -->

@stop<!-- Content end  -->

<!-- Js here  -->
@push('js')
@endpush