
<!-- ========================= Edit courier form/page, from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Edit Existing Courier')

<!-- css here  -->
@push('css')
@endpush

@section('content')<!-- content start  -->

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

    <form action="{{route('admin.courier.update', $couriers->id )}}" method="post" enctype="multipart/form-data"><!-- form start  -->
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <label for="name">Courier's Name</label>
                            <input name="name" id="name" value="{{$couriers->name}}" class="form-control">
                            @error('name')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <!-- Email cannot be edited because its unique -->
                        <div class="col-sm-6 mt-3">
                            <label for="email">Email</label>
                            <div class="border p-2 form-control">
                                {{$couriers->email}}
                            </div>
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="phone">Phone</label>
                            <input type="phone" name="phone" id="phone" value="{{$couriers->phone}}"
                                class="form-control">
                            @error('phone')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="branch">Branch</label>
                            <select name="branch" id="branch" value="{{$couriers->branch_name}}" class="form-control">

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
                                <option>{{$couriers->gender}}</option>
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
                            <input name="vehicle" id="vehicle" value="{{$couriers->vehicle}}" class="form-control">
                            @error('vehicle')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-12 mt-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" rows="4"
                                class="form-control">{{$couriers->address}}</textarea>
                            @error('address')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="city">City</label>
                            <input name="city" id="city" value="{{$couriers->city}}" class="form-control">
                            @error('city')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="state">State</label>
                            <input name="state" id="state" value="{{$couriers->state}}" class="form-control">
                            @error('state')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="pincode">Pincode</label>
                            <input name="pincode" id="pincode" value="{{$couriers->pincode}}" class="form-control">
                            @error('pincode')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-3">
                            <label for="country">Country</label>
                            <input name="country" id="country" value="{{$couriers->country}}" class="form-control">
                            @error('country')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="col-sm-3 mt-4">
                            <label for="password">Give Password</label>
                            <input name="password" id="password" value="{{$couriers->password}}" class="form-control">
                            @error('password')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-3 mt-4">
                            <label for="image">Old Photo</label>
                            <img height="80" width="100" src="/courierimage/{{$couriers->image }}" alt="Old Image">
                        </div>

                        <div class="col-sm-3 mt-4">
                            <label for="courier_image">Choose New Photo</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <input type="hidden" value="2" name="role_id" id="role_id">

                    </div><!-- row end  -->
                </div><!-- col-lg-12 end  -->
            </div><!-- row end  -->
        </div><!-- card-body end -->

        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary">Update Courier</button>
                </div>
            </div>
        </div><!-- card-form  -->
    </form><!-- form end -->
</div><!-- card end -->

@stop<!-- content end  -->

<!-- Js here -->
@push('js')
@endpush