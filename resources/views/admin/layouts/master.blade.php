<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
    <title>Courier Admin | @yield('title')</title>

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

    <link rel="stylesheet" href="{{ adminAsset('todo/css/style.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        @include('admin.layouts.inc.navbar')

        @include('admin.layouts.inc.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Hello, {{Auth::user()->name}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

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

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{adminAsset('dist/js/pages/dashboard.js')}}"></script>

    <script src="{{adminAsset('todo/js/main.js')}}"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>