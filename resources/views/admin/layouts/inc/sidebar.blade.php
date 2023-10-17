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
                <div class="user-panel m-2 pb-3 d-flex text-uppercase">
                    <div class="info">
                    <img src="" class="img-circle elevation-2"
                            >
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{route('admin.dashboard')}}" class="nav-link {{ isActive('admin/dashboard') }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>

                        </li>

                        <li class="nav-header pt-4">Company Master</li>

                        <li class="nav-item menu-open has-treeview">
                            <a href="" class="nav-link {{ isActive('admin/company-master*') }}" class="nav-link">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Company Mgt
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.company.view')}}"
                                        class="nav-link {{ isActive('admin/company-master') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Company Details</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.orders.view')}}"
                                        class="nav-link {{ isActive('admin/company-master/orders') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Orders</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.company.users')}}"
                                        class="nav-link {{ isActive('admin/company-master/users') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Users</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.service.view')}}"
                                        class="nav-link {{ isActive('admin/company-service') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Product Services</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.service.add')}}"
                                        class="nav-link {{ isActive('admin/company-service/add') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Service</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li class="nav-header pt-4">Courier Master</li>
                        <li class="nav-item has-treeview {{isMenuOpen('admin/courier-master*')}}">
                            <a href="" class="nav-link {{ isActive('admin/courier-master*') }}">
                                <i class="nav-icon fas fa-hiking"></i>
                                <p>
                                    Courier Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.courier.view')}}"
                                        class="nav-link {{ isActive('admin/courier-master') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Our Couriers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.courier.add')}}"
                                        class="nav-link {{ isActive('admin/courier-master/add') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add new Courier</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-header pt-4">Settings Master</li>
                        <li class="nav-item has-treeview {{isMenuOpen('admin/settings-master*')}}">
                            <a href="" class="nav-link {{ isActive('admin/settings-master*') }}">
                                <ion-icon name="settings-sharp"></ion-icon>
                                <p class="mx-2">
                                    Settings
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.service.index')}}"
                                        class="nav-link {{ isActive('admin/settings-master/services') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delivery Services</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.payment.settings')}}"
                                        class="nav-link {{ isActive('admin/settings-master/paymentSettings') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Payments</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.appearances.settings')}}"
                                        class="nav-link {{ isActive('admin/settings-master/appearanceSettings') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Appearances</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-header pt-4">Users Master</li>
                        <li class="nav-item has-treeview {{isMenuOpen('admin/action-master*')}}">
                            <a href="" class="nav-link {{ isActive('admin/action-master*') }}">
                                <i class="nav-icon ion ion-person-add"></i>
                                <p>
                                    Users and Visitors
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('admin.messages')}}"
                                        class="nav-link {{ isActive('admin/action-master/message') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Messages</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.applied-courier')}}"
                                        class="nav-link {{ isActive('admin/action-master/applied') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Applied Couriers</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>