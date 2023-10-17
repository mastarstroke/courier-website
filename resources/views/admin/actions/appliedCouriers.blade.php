
<!-- ========================= Applied couriers view page  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Applied Couriers')

<!-- css here include datatable css file  -->
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')<!-- content start  -->

<div class="col-12">
    <div class="card-body">
        <table id="table_id" class="display"><!-- datatable start  -->
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Vehicle</th>
            </thead>
            <tbody>

                 <!-- ========================= For each loop for applied couriers info fetching from the appliedCouriers table ========================= -->
                @foreach($appliedCouriers as $applied)
                <tr>
                    <th data-label="Id" style="border: 1px solid #add; ">{{$applied->name}}</th>
                    <td data-label="First Name" style="border: 1px solid #add; ">
                        {{$applied->email}}</td>
                    <td data-label="Middle Name" style="border: 1px solid #add; ">
                        {{$applied->phone}}</td>
                    <td data-label="Middle Name" style="border: 1px solid #add; ">
                        {{$applied->address}}</td>
                    <td data-label="Middle Name" style="border: 1px solid #add; ">
                        {{$applied->gender}}</td>
                    <td data-label="Middle Name" style="border: 1px solid #add; ">
                        {{$applied->vehicle}}</td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- datatable end  -->
    </div><!-- card-body end  -->
</div><!-- col-12 end  -->

@stop<!-- content end -->

<!-- js here include datatable js file  -->
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush