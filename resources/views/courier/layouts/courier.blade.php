<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courier Session | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <livewire:styles />
    @stack('css')

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{adminAsset('plugins/fontawesome-free/css/all.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ adminAsset('dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ adminAsset('dist/css/contact.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        @include('courier.layouts.inc.navbar')<!-- include navbar file from layout folder -->

        @include('courier.layouts.inc.sidebar')<!-- include sidebar file from layout folder -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 mb-2">
                            <h1>Welcome, {{Auth::user()->name}}</h1><!-- include title of every page -->
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @if(Auth::check() && Auth::user()->role_id == 2)<!-- Auth check: if role id is 2 = courier session -->
                                <li class="breadcrumb-item"><a href="{{route('courier.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item">@yield('title')</li>
                                @else
                                <li class="breadcrumb-item"><a href="{{route('courier-suspended')}}">Home</a></li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')<!-- include content of each page included -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{date('y')}} <a href="https://jamesadeyemo.netlify.app">Mastarstroke</a>.</strong>
            All rights
            reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ adminAsset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ adminAsset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{adminAsset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    <!-- area/bar chart -->
    <script src="{{adminAsset('charts/chart-area-demo.js')}}"></script>
    <script src="{{adminAsset('charts/chart-bar-demo.js')}}"></script>
    <livewire:scripts />
    @stack('js')

    <!-- AdminLTE App -->
    <script src="{{adminAsset('dist/js/adminlte.min.js')}}"></script>
    <script src="{{adminAsset('dist/js/contact-us.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{adminAsset('dist/js/pages/dashboard.js')}}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('success'))
    <script>
    swal("{{session('success')}}");
    </script>
    @endif
</body>

</html>