@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@push('css')

@endpush

@section('content')

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
                <a href="{{route('admin.orders.view')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$countCourier}}</h3>

                    <p>Our Couriers</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-hiking"></i>
                </div>
                <a href="{{route('admin.courier.view')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{$countUser}}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('admin.company.users')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$countTotalSales}}</h3>

                    <p>Completed Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('admin.order-history')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
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
                    Sales Area Chart(Monthly)
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Sales Bar Chart(Monthly)
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->

    <div class="row">
        <div class="col-xl-7">
            <!-- TO DO List -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        To Do List
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">

                        @foreach($todoLists as $todoList)
                        <li>
                            <span class="handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <div class="icheck-primary d-inline ml-2">
                                <input type="checkbox" value="" name="todo4" id="todoCheck4">
                                <label for="todoCheck4"></label>
                            </div>
                            <span class="text">{{$todoList->activity}}</span>
                            <small class="badge badge-primary">
                                {{date('d-m-y', strtotime($todoList->created_at))}}</small>
                            <div class="tools">
                                <a class="text-danger" onclick="event.preventDefault(); document.getElementById
                            ('delete-form-{{$todoList->id}}').submit();"><i class="fas fa-trash"></i></a>
                                <form action="{{route('admin.delete-todo-list', $todoList->id)}}" syle="display: none;"
                                    method="post" id="delete-form-{{$todoList->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>


                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>

                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div id="todoForm">

                        <h5>What are you doing next?</h5>
                        <form action="{{route('admin.add-todo-list')}}" method="post">
                            @csrf
                            <input placeholder="Enter Activity" name="activity" type="text" required />
                            <input class="formBtn" type="submit" />
                        </form>
                    </div>
                    <button id="todo" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add
                        item</button>
                </div>
            </div>
            <!-- /.card -->
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
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">

                        @foreach($services as $service)
                        <li class="item">
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{$service->service_name}}
                                    <span class="badge badge-warning float-right"><small>{{$currency->currency}}</small> {{$service->price}}</span>{{$service->price}}</span></a>
                                <span class="product-description">
                                    {{$service->per_kg_rate}}.
                                </span>
                            </div>
                        </li>
                        @endforeach
                        <!-- /.item -->
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="{{route('admin.service.view')}}" class="uppercase">View All Services</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>

        <!-- /.card -->
    </div>
</div><!-- /.container-fluid -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
var _ydata = JSON.parse('{!! json_encode($months) !!}');
var _xdata = JSON.parse('{!! json_encode($monthCount) !!}');
</script>




@stop

@push('js')
@endpush