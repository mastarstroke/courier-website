
<!-- ========================= Dashboard index Page for couriers ========================= -->

@extends('courier.layouts.courier')<!-- include courier file from layout folder  -->
@section('title', 'Courier Dashboard')

<!-- Js here  -->
@push('css')
@endpush

@section('content')<!-- Content start  -->

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$countOrder}}</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('courier.orders')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$countOrderHistory}}</h3>

                    <p>Completed Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('courier.order-completed')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><small>{{$currency->currency}}</small> {{$totalSales}}</h3>

                    <p>Total Sales</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('courier.order-completed')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{$reviews}}</h3>

                    <p>Customer Reviews</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

    </div>
    <!-- /.row -->
    <!-- Main row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Sales Area Chart
                </div>

                <!-- Chart js here  -->
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>

        <div class="col-xl-5">
            <!-- PRODUCT LIST -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recently Added Services</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->

                <!-- Added services from the services table in DB  -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card px-2">

                        @foreach($services as $service)<!-- Foreach loop here with info from services columns  -->
                        <li class="item">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{$service->service_name}}
                                    <span class="badge badge-warning float-right"><small>{{$currency->currency}}</small> {{$service->price}}</span></a>
                                <span class="product-description">
                                    {{$service->per_kg_rate}}.
                                </span>
                            </div>
                        </li>
                        @endforeach<!-- foreach loop end  -->

                        <!-- /.item -->
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="" class="uppercase">View All Services</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->

</div><!-- /.container-fluid -->

<!-- Js here including chartJs  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
var _ydata = JSON.parse('{!! json_encode($months) !!}');
var _xdata = JSON.parse('{!! json_encode($monthCount) !!}');
</script>




@stop

@push('js')
@endpush