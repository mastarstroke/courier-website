
<!-- ========================= index/add service which displayed on welcome page, from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Front Service')

<!-- css file here -->
@push('css')
@endpush

@section('content')<!-- content start -->
<livewire:admin.front-service.add /><!-- view front-service.add page from the livewire folder  -->

@stop<!-- content end  -->

<!-- Js here  -->
@push('css')
@endpush