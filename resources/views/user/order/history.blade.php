<!-- ========================= The Page for order history for users ========================= -->

@extends('user.layouts.user')
<!-- Extension from the user/layouts file -->
@section('title', 'View Orders')

@push('css')
<!-- Css here including datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')
<!-- Content start -->

<div class="container my-5">
    <!-- Container start -->
    <h4 class="text-center mb-3">Your Orders History</h4>
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <a href="/">Home</a>
                    <a href="{{url('myorders')}}" class="btn btn-warning text-white  float-right">Back</a>
                </div>
            </div>
        </div><!-- Card-header end -->

        <div class="card-body">
            <table id="table_id" class="display table-order">
                <!-- Datatable start -->
                <thead>
                    <tr>
                        <th>Tracking Number</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orders->count() > 0)

                    @foreach ($orders as $item)
                    <tr>
                        <td>{{ $item->tracking_no }}</td>
                        <td>{{$currency->currency}} {{ $item->service_price }}</td>
                        <td>{{ $item->status == '0' ? 'pending' : 'completed' }}</td>
                        <td>
                            <a href="{{route('view-order' ,$item->id)}}"><ion-icon size="large" name="eye-outline"></ion-icon></a>
                        </td>
                    </tr>
                    @endforeach

                    @else

                    <div class="card-body text-center">
                        <h4 class="text-danger">Your Order History is empty
                        </h4>
                    </div>

                    @endif
                </tbody>
            </table><!-- Datatable end -->
        </div><!-- Card-body end -->
    </div><!-- col-md-12 end -->

</div><!-- Container end -->

@stop
<!-- Content end -->

@push('js')
<!-- Js here including datatable -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush