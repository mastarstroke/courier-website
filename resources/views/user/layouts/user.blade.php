
<!-- ========================= The layout extension page for users ========================= -->

<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Courier Admin | @yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
    <!-- Place favicon.ico in the root directory -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ========================= Jquery Cdn here ========================= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"
        integrity="sha512-egJ/Y+22P9NQ9aIyVCh0VCOsfydyn8eNmqBy+y2CnJG+fpRIxXMS6jbWP8tVKp0jp+NO5n8WtMUAnNnGoJKi4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <livewire:styles />
    @stack('css')
</head>

<body>
    <section><!-- Section start -->
        <div class="content"><!-- content start -->
            @yield('content')<!-- content -->

            <!-- ========================= footer start ========================= -->
            <footer id="footer" class="footer pt-100 pb-70">
                <div class="footer-shape">
                    <img src="assets/img/footer/footer-left.svg" alt="" class="shape shape-1">
                    <img src="assets/img/footer/footer-right.svg" alt="" class="shape shape-2">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget wow fadeInUp" data-wow-delay=".2s">
                                
                                <div class="download-btns">
                                    <a href="javascript:void(0)">
                                        <span class="icon"><i class="lni lni-apple"></i></span>
                                        <span class="text">Download on the <b>App Store</b> </span>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <span class="icon"><i class="lni lni-play-store"></i></span>
                                        <span class="text">GET IT ON <b>Play Store</b> </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget wow fadeInUp" data-wow-delay=".4s">
                                <h3>About Us</h3>
                                <ul class="links">
                                    <li>
                                        <a href="javascript:void(0)">Home</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Services</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">About Us</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget wow fadeInUp" data-wow-delay=".6s">
                                <h3>About</h3>
                                <ul class="links">
                                    <li>
                                        <a href="javascript:void(0)">Partners</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Terms of Service</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Refund Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget wow fadeInUp" data-wow-delay=".8s">
                                <h3>Support</h3>
                                <ul class="links">
                                    <li>
                                        <a href="javascript:void(0)">Open Ticket</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Community</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Return Policy</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Accessibility</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p>Designed and Developed by <a href="https://jamesadeyemo.netlify.app" style="color: #fff;"
                                rel="nofollow">Mastarstroke</a></p>
                    </div>
                </div>
            </footer>
            <!-- ========================= footer end ========================= -->

        </div><!-- content end -->
    </section><!-- section end -->


    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.5.0.0.alpha-2-min.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/contact-us.js"></script>
    <livewire:scripts />

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- ========================= JS & Resource for Sweet Alert ========================= -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('success'))
    <script>
    swal("{{session('success')}}");
    </script>
    @endif
    @stack('js')
</body>

</html>