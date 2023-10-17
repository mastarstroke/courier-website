<!-- ========================= Register Page ========================= -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courier Admin | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{adminAsset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{adminAsset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{adminAsset('dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box mb-5">
        <div class="login-logo">
            <a href="/"><b>Courier</b>Global</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">

            <div class="card-header">{{ __('Sign Up to stat your session') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Your First Name" name="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required
                            autocomplete="email">
                        <div class=" input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                    <small class="text-danger">{{$message}}</small>
                    @enderror


                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required
                            autocomplete="new-password">
                        <div class=" input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                    <small class="text-danger">{{$message}}</small>
                    @enderror

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            name="password_confirmation">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    @error('password')
                    <small class="text-danger">{{$message}}</small>
                    @enderror


                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{adminAsset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{adminAsset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{adminAsset('dist/js/adminlte.min.js')}}"></script>
</body>

</html>