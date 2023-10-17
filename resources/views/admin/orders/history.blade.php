
<!-- ========================= History orders page from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Orders History')

<!-- css here including datatable css file -->
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')<!-- content start  -->

<div class="col-12">

    <div class="card-header">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('admin.orders.view')}}" class="btn btn-warning float-right">New Orders</a>
            </div>
        </div>
    </div><!-- card-header end -->

    <div class="card-body">
        <table id="table_id" class="display"><!-- datatable start -->
            <thead>
                <tr>
                    <th>Tracking Number</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>

             <!-- ========================= For each loop for history orders info from the order_couriers table ========================= -->
                @foreach ($orders as $item)
                <tr>
                    <td>{{ $item->tracking_no }}</td>
                    <td><small>{{$currency->currency}}</small> <strong>{{ $item->service_price }}</strong></td>
                    <td>{{ $item->status == '0' ? 'pending' : 'completed' }}</td>
                    <td><small class="badge badge-primary">
                            {{date('d-m-y', strtotime($item->created_at))}}</small></td>
                    <td>
                        <a href="{{route('admin.orderView' ,$item->id)}}"><ion-icon size="large" name="eye-outline"></ion-icon></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- datatable end -->
    </div><!-- card-body end -->
</div><!-- col-12 end -->

@stop<!-- content end  -->

<!-- js here including datatable js file -->
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush