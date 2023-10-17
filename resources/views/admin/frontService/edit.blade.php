
<!-- ========================= edit service displayed on welcome page, from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Edit Existing Service')

<!-- css file here -->
@push('css')
@endpush

@section('content')<!-- content start  -->
<livewire:admin.front-service.edit :services="$services" /><!-- view front-service.edit page from the livewire folder  -->

@stop<!-- content end  -->

<!-- Js here -->
@push('js')
@endpush