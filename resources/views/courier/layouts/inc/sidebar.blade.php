        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link elevation-4">

                <span class="brand-text font-weight-light"><img width="30" src="/storage/company/{{$company_details->company_logo}}"
                 alt="Logo" /> {{$company_details->company_name}}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/courierimage/{{$courierInfo->image}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        @if(Auth::check() && Auth::user()->role_id == 2)
                        <li class="nav-item">
                            <a href="{{route('courier.dashboard')}}"
                                class="nav-link {{ isActive('courier/dashboard') }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>

                        </li>


                        <li class="nav-item menu-open has-treeview">
                            <a href="{{route('courier.orders')}}" class="nav-link {{ isActive('courier/courier/orders*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    New Orders
                                </p>
                            </a>
                        </li>

                        <li class="nav-item menu-open has-treeview">
                            <a href="{{route('courier.order-completed')}}" class="nav-link {{ isActive('courier/courier/order/history*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Delivered Orders
                                </p>
                            </a>
                        </li>

                        <li class="nav-item menu-open has-treeview">
                            <a href="{{route('courier.courier-info')}}" class="nav-link {{ isActive('courier/courier/myinfo*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    My Info
                                </p>
                            </a>
                        </li>

                        @else
                        <li class="nav-item menu-open has-treeview">
                            <a href="" class="nav-link" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Contact
                                </p>
                            </a>
                        </li>

                        @endif
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>