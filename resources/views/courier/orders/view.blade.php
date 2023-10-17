
<!-- ========================= The view Page for orders for couriers ========================= -->

@extends('courier.layouts.courier')<!-- include courier file from layout folder  -->
@section('title', 'View Orders')

<!-- include css files here and datatable css file  -->
@push('css')
@endpush


@section('content')<!-- Content start -->

<livewire:courier.orders.view :orders="$orders" /><!-- Order File link from livewire folder -->

@stop<!-- Content end -->

@push('js')<!-- Js here -->
@endpush