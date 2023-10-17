
<!-- ========================= Edit Branch form/page  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Edit Existing Branch')

<!-- css here -->
@push('css')
@endpush

@section('content')<!-- content start  -->
<livewire:admin.branch.edit :branch="$branch" /><!-- include edit branch file view from the livewire folder, with the assigned Id  -->
@stop<!-- content end  -->

<!-- js here -->
@push('js')
@endpush