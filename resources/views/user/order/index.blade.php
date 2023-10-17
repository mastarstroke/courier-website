<!-- ========================= New Orders page for users ========================= -->

@extends('user.layouts.user')
<!-- Extension from the user/layouts file -->
@section('title', 'New Orders')

@push('css')
<!-- Css here including datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush


@section('content')
<!-- Content start -->

<!-- ========================= Page Container ========================= -->
<div class="container my-5">
    <h4 class="text-center mb-3">Your New Orders</h4>
    <div class="col-lg-12">
        <div class="card-header">
            <!-- card-header start -->
            <div class="row">
                <div class="col-md-12">
                    <a href="/">Home</a>
                    <a href="{{route('order-history')}}" class="btn btn-warning float-right">Order History</a>
                </div>
            </div>
        </div><!-- card-header end -->

        <div class="card-body">
            <table id="table_id" class="display table-order">
                <!-- Datatable start -->
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>

                        @if($item->status == 'New')
                        <!-- status is pending from the order table  -->
                        <td>
                            <small class="mt-3 p-1 btn-sm btn-warning">Pending</small>
                        </td>  
                        @endif                     
                        
                        @if($item->status == 'cancel')
                        <!-- status is cancelled from the order table  -->
                        <td>
                            <small class="mt-3 p-1 btn-sm btn-danger">Cancelled</small>
                        </td>
                        @endif

                        @if($item->status == '0')
                        <!-- status is confirmed from the order table  -->
                        <td>
                            <small class="mt-3 p-1 btn-sm btn-primary">Approved</small>
                        </td>
                        @endif

                        @if($item->status == '1')
                        <!-- status is taken by a courier from the order table  -->
                        <td>
                            <small class="mt-3 p-1 btn-sm btn-secondary">Delivering</small>
                        </td>
                        @endif

                        @if($item->status == '2')
                        <!-- status is delivered from the order table  -->
                        <td>
                            <small class="mt-3 p-1 btn-sm btn-success">Delivering</small>
                        </td>
                        @endif

                        <td>{{date('d-m-y', strtotime($item->created_at))}}</td>
                        <!-- orders date for each loop  -->
                        <td>
                            <a href="{{route('view-order' ,$item->id)}}"><ion-icon size="large" name="eye-outline"></ion-icon></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table><!-- Datatable end -->
        </div><!-- card-body end -->

    </div><!-- col-lg-12 end -->
</div><!-- Container end -->

@stop
<!-- Content end -->

@push('js')
<!-- Js here including Datatable -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush