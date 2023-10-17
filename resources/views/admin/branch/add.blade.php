
<!-- ========================= Add Branch form/page  ========================= -->


@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Add New Branch')

<!-- css here -->
@push('css')
@endpush

@section('content')<!-- content start  -->
<livewire:admin.branch.add /><!-- include Add branch file view from the livewire folder  -->

@stop<!-- content end  -->

<!-- js here -->
@push('js')
@endpush