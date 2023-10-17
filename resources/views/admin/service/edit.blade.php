
<!-- ========================= Edit service page from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Edit Existing Branch')

<!-- Css here -->
@push('css')
@endpush

@section('content')<!-- content start  -->

<livewire:admin.service.edit :service="$service" /><!-- view this file from the livewire folder  -->

@stop<!-- content end  -->

<!-- Js here  -->
@push('css')
@endpush