<!-- ========================= Index orders page from admin end  ========================= -->

@extends('admin.layouts.master')
<!-- include master file from layout folder  -->
@section('title', 'View Orders')

<!-- css here including datatable css file  -->
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')
<!-- content start  -->

<!-- Alert here  -->
<div class="col-12">
    @include('admin.alert')
</div>

<div class="col-12">

    <div class="card-header">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('admin.order-history')}}" class="btn btn-warning float-right">Order History</a>
            </div>
        </div>
    </div><!-- card-header end  -->

    <div class="card-body">
        <table id="table_id" class="display">
            <!-- datatable start  -->
            <thead>
                <tr>
                    <th>Tracking Number</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>View</th>
                    <th>Del</th>
                </tr>
            </thead>
            <tbody>
                <!-- ========================= For each loop for new orders info from the order_couriers table ========================= -->
                @foreach ($orders as $item)
                <tr>
                    <td>{{ $item->tracking_no }}</td>
                    <td><small>{{$currency->currency}}</small> <strong>{{ $item->service_price }}</strong></td>

                    @if($item->status == 'New')
                    <!-- status is NEW from the order table  -->
                    <td>
                        <h1 class="px-2 mt-3 badge badge-warning">Pending</h1>
                    </td>
                    @endif

                    @if($item->status == 'cancel')
                    <!-- status is cancelled from the order table  -->
                    <td>
                        <h1 class="px-2 mt-3 badge badge-danger">Cancelled</h1>
                    </td>
                    @endif

                    @if($item->status == '0')
                    <!-- status is 0 from the order_couriers table  -->
                    <td>
                        <h1 class="px-2 mt-3 badge badge-primary">Confirmed</h1>
                    </td>
                    @endif

                    @if($item->status == '1')
                    <!-- status is 1 from the order_couriers table  -->
                    <td>
                        <h1 class="px-3 mt-2 badge badge-secondary">Taken</h1>
                        <p class="mb-1"><small>by {{$item->courier}}</small> </p>
                    </td>
                    @endif

                    @if($item->status == '2')
                    <!-- status is 2 from the order_couriers table  -->
                    <td>
                        <h1 class="px-2 mt-2 badge badge-success">Delivered</h1>
                        <p class="mb-1"><small>by {{$item->courier}}</small> </p>
                    </td>
                    @endif

                    <td><small class="badge badge-primary">
                            {{date('d-m-y', strtotime($item->created_at))}}</small></td>
                    <!-- orders date for each loop  -->

                    <td class="px-3">
                        <a href="{{route('admin.orderView' ,$item->id)}}"><ion-icon size="large" name="eye-outline"></ion-icon></a>
                    </td>

                    <!-- delete order here  -->
                    <td>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById
                            ('delete-form-{{$item->id}}').submit();" class="btn btn-outline-danger btn-sm"><i
                                class="fas fa-trash"></i></a>
                        <form action="{{route('admin.order.delete',$item->id)}}" syle="display: none;" method="post"
                            id="delete-form-{{$item->id}}">
                            @csrf
                            @method('DELETE')
                        </form><!-- form end  -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- datatable end -->
    </div><!-- Card-body end  -->
</div><!-- col-12 end  -->

@stop
<!-- content end  -->

<!-- js here including datatable js file  -->
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush