
<!-- ========================= Edit registered Users Page ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Edit User')

<!-- Js here  -->
@push('css')
@endpush

@section('content')<!-- Content start  -->

<div>
    <div class="card card-primary card-outline">

    <!-- Alert here -->
        <div class="col-12">
            @include('admin.alert')
        </div>

        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <a href="{{route('admin.company.users')}}" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
        </div><!-- Card-header end -->

        <form action="{{route('admin.update.user',$users->id)}}" method="post"><!-- Form start -->
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <label for="name">Name</label>
                                <input type="text" id="branch_name" name="name" class="form-control"
                                    value="{{$users->name}}">
                            </div>

                            <div class="col-sm-6 mt-3">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{$users->email}}">
                            </div>


                            <div class="col-sm-4 mt-3">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                    value="{{$users->phone}}">
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="gender">Gender</label>
                                <input type="text" id="gender" name="gender" class="form-control"
                                    value="{{$users->gender}}">
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="branch_address">State</label>
                                <input type="text" id="state" name="state" class="form-control"
                                    value="{{$users->state}}">
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" class="form-control" value="{{$users->city}}">
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="state">Country</label>
                                <input type="text" id="country" name="country" class="form-control"
                                    value="{{$users->country}}">
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="pin">Pincode</label>
                                <input type="text" id="pincode" name="pincode" class="form-control"
                                    value="{{$users->pincode}}">
                            </div>

                            <div class="col-sm-6 mt-3">
                                <label for="address">Address</label>
                                <textarea type="text" name="address" id="address" cols="4"
                                    class="form-control">{{$users->address}}</textarea>
                            </div>

                        </div><!--Row end -->
                    </div><!--col-lg-12 end -->
                </div><!--Row end -->
            </div><!--Card-body end -->

            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>

                </div>
            </div><!--Card-footer end -->

        </form><!--Form end -->
    </div><!--Card end -->

</div>

@stop<!-- Content end -->

<!-- Js here -->
@push('js')
@endpush