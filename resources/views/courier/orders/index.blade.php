<!-- ========================= The Page for new orders for couriers ========================= -->


<!-- ========================= The Page for order history for couriers ========================= -->

@extends('courier.layouts.courier')
<!-- include courier file from layout folder  -->
@section('title', 'New Orders')

<!-- include css files here and datatable css file  -->
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')
<!-- Content start -->

<div class="col-md-12">
    <!-- col-md-12 start -->
    <div class="card-header">
        <!-- card-header start -->
        <div class="row">
            <div class="col-md-12">
                <a href="/">Home</a>
                <a href="{{route('courier.order-completed')}}" class="btn btn-warning float-right">Order History</a>
            </div>
        </div>
    </div><!-- card-header end -->

    <div class="card-body">
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Tracking Number</th>
                    <th>Total Price</th>
                    <th>Product_type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                <tr>
                    <td>{{ $item->tracking_no }}</td>
                    <td><small>{{$currency->currency}}</small> {{ $item->service_price }}</td>
                    <td>{{ $item->product_type }}</td>
                    <td>
                        <a href="{{route('courier.orderView' ,$item->id)}}" class="btn btn-outline-primary">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- table end -->
    </div><!-- card-body end -->

</div><!-- col-md-12 end -->

@stop
<!-- Content end -->


<!-- Js here including datatable js file -->
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush