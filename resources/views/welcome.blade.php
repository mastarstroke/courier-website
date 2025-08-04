<!-- =========================  This is the HomePage for all users including the vistors
     All basic Informaton are been fixed on this page both static and from the batabase.
========================= -->

<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{$company_details->company_name ?? 'N/A'}} - Home Delivery Online made easy</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"
        integrity="sha512-egJ/Y+22P9NQ9aIyVCh0VCOsfydyn8eNmqBy+y2CnJG+fpRIxXMS6jbWP8tVKp0jp+NO5n8WtMUAnNnGoJKi4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Place favicon.ico in the root directory -->

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{adminAsset('plugins/fontawesome-free/css/all.min.css')}}">


    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
    <section>
        <div class="content">

            <!-- ========================= preloader start ========================= -->
            <div class="preloader">
                <div class="loader">
                    <div class="ytp-spinner">
                        <div class="ytp-spinner-container">
                            <div class="ytp-spinner-rotator">
                                <div class="ytp-spinner-left">
                                    <div class="ytp-spinner-circle"></div>
                                </div>
                                <div class="ytp-spinner-right">
                                    <div class="ytp-spinner-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- preloader end -->


            <!-- ========================= header start ========================= -->
            <header class="header">
                <div class="navbar-area">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <nav class="navbar navbar-expand-lg">
                                    <a class="navbar-brand" href="/">
                                        <img src="/storage/company/{{$company_details->company_logo ?? 'N/A'}}"
                                            alt="Logo" /><span>{{$company_details->company_name ?? 'N/A'}}</span>
                                    </a>
                                    <!-- ========================= The Mobile Nav Toggler ========================= -->
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="toggler-icon text-white"></span>
                                        <span class="toggler-icon"></span>
                                        <span class="toggler-icon"></span>
                                    </button>

                                    <!-- ========================= The Menus for both Mobile and desktop Devices ========================= -->
                                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                        <ul id="nav" class="navbar-nav ml-auto">
                                            <li class="nav-item mx-3">
                                                <a class="page-scroll" href="#home">Home</a>
                                            </li>
                                            <li class="nav-item mx-3">
                                                <a class="page-scroll" href="#services">Services</a>
                                            </li>
                                            <li class="nav-item mx-3">
                                                <a class="page-scroll" href="#about">About</a>
                                            </li>
                                            <li class="nav-item mx-3">
                                                <a class="page-scroll" href="#how">How It Works</a>
                                            </li>
                                            <!-- Authentication Links -->

                                            @if (Route::has('login'))

                                            <li>
                                                @auth
                                            <li>

                                                @if(Auth::check() && Auth::user()->role_id == 1)
                                            <li class="nav-item ml-3"><a class="nav-link"
                                                    href="{{url('admin/dashboard')}}">Admin
                                                    Dashboard</a></li>
                                            @endif

                                            @if(Auth::check() && Auth::user()->role_id == 2)
                                            <li class="nav-item ml-3"><a class="nav-link"
                                                    href="{{url('courier/dashboard')}}">Courier
                                                    Dashboard</a></li>
                                            @endif

                                            @if(Auth::check() && Auth::user()->role_id == 3)
                                            <li class="nav-item ml-3">
                                                <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-power-off">Logout</i>
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                            @endif

                                            @if(Auth::check() && Auth::user()->role_id == 0)
                                            <li class="nav-item ml-3">
                                                <a class="nav-link text-uppercase" href="#">
                                                    {{ Auth::user()->name }}
                                                </a>
                                            </li>

                                            <li class="nav-item ml-3">
                                                <a class="nav-link" href="{{url('myorders')}}">
                                                    My Order(s)
                                                </a>
                                            </li>

                                            <li class="nav-item ml-3">
                                                <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-power-off">Logout</i>
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                            @endif

                                            @else

                                            <li class="nav-item ml-3">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>

                                            @if (Route::has('register'))
                                            <li class="nav-item ml-3">
                                                <a class="nav-link"
                                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                            @endif


                                            @endauth
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <!-- navbar collapse -->
                                </nav>
                                <!-- navbar -->
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- container -->
                </div>
                <!-- navbar area -->
            </header>
            <!-- ========================= header end ========================= -->

            <!-- ========================= hero-section start ========================= -->
            <section id="home" class="hero-section">
                <div class="hero-shape">
                    <img src="assets/img/hero/hero-shape.svg" alt="" class="shape">
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="hero-content">
                                <h1 class="wow fadeInUp" data-wow-delay=".2s">{{$setting_one->hero_title ?? 'N/A'}}
                                </h1>
                                <p class="wow fadeInUp" data-wow-delay=".4s">{{$setting_one->hero_paragraph ?? 'N/A'}}
                                </p>
                                <a href="{{route('order-index')}}" rel="nofollow"
                                    class="main-btn btn-hover wow fadeInUp" data-wow-delay=".6s">Order Courier now!</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                                <img src="/settingsimage/{{$setting_one->hero_image ?? 'N/A'}}" height="400" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ========================= hero-section end ========================= -->

            <!-- ========================= service-section start ========================= -->
            <section id="services" class="service-section pt-150">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span class="wow fadeInUp" data-wow-delay=".2s">Delivery Services</span>
                                <h1 class="wow fadeInUp" data-wow-delay=".4s">All Essentials You Need</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($service as $serv)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-service wow fadeInUp" data-wow-delay=".2s">
                                <div class="icon">
                                    <img src="{{ Storage::url($serv->image) ?? 'N/A'}}" alt="">
                                </div>
                                <div class="content">
                                    <h3>{{$serv->name ?? 'N/A'}}</h3>
                                    <p>{{$serv->description ?? 'N/A'}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- ========================= service-section end ========================= -->

            <!-- ========================= about-section start ========================= -->
            <section id="about" class="about-section pt-150">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-img wow fadeInUp" data-wow-delay=".5s">
                                <img src="/settingsimage/{{$setting_one->about_image ?? 'N/A'}}" height="500" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-content">
                                <div class="section-title">
                                    <span class="wow fadeInUp" data-wow-delay=".2s">About Us</span>
                                    <h1 class="wow fadeInUp" data-wow-delay=".4s">{{$setting_one->about_title ?? 'N/A'}}
                                    </h1>
                                    <p class="wow fadeInUp my-2" data-wow-delay=".6s">{{$setting_one->about_paragraph ?? 'N/A'}}</p>
                                </div>

                                <div class="counter-up wow fadeInUp" data-wow-delay=".8s">
                                    <div class="single-counter">
                                        <h3 id="secondo1" class="countup" cup-end="100" cup-append="K+">100 </h3>
                                        <h5>Download</h5>
                                    </div>
                                    <div class="single-counter position-relative">
                                        <h3 id="secondo2" class="countup" cup-end="54" cup-append="K+">54 </h3>
                                        <h5>Happy User</h5>
                                    </div>
                                    <div class="single-counter">
                                        <h3 id="secondo3" class="countup" cup-end="34" cup-append="K+">34 </h3>
                                        <h5>Reviews</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ========================= about-section end ========================= -->

            <!-- ========================= delivery-section start ========================= -->
            <section id="how" class="delivery-section pt-150">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="delivery-content">
                                <div class="section-title">
                                    <span class="wow fadeInUp" data-wow-delay=".2s">How We Work</span>
                                    <h1 class="mb-35 wow fadeInUp" data-wow-delay=".4s">{{$setting_two->how_title ?? 'N/A'}}</h1>
                                    <p class="mb-35 wow fadeInUp" data-wow-delay=".6s">{{$setting_two->how_paragraph ?? 'N/A'}}</p>
                                    <a href="{{route('order-index')}}" class="main-btn btn-hover wow fadeInUp"
                                        data-wow-delay=".8s">Order Courier now!</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 order-first order-lg-last">
                            <div class="delivery-img wow fadeInUp" data-wow-delay=".5s">
                                <img src="/settingsimage/{{$setting_two->how_image ?? 'N/A'}}" height="500" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ========================= delivery-section end ========================= -->

            <!-- ========================= Contactless-section start ========================= -->
            <section id="received" class="about-section received-section pt-150">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="about-img received-img wow fadeInUp" data-wow-delay=".5s">
                                <img src="/settingsimage/{{$setting_two->contact_image ?? 'N/A'}}" height="400" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-content received-content">
                                <div class="section-title">
                                    <span class="wow fadeInUp" data-wow-delay=".2s">Contactless Delivery</span>
                                    <h1 class="mb-25 wow fadeInUp" data-wow-delay=".4s">{{$setting_two->contact_title ?? 'N/A'}}</h1>
                                    <p class="wow fadeInUp" data-wow-delay=".6s">{{$setting_two->contact_paragraph ?? 'N/A'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ========================= Contactless-section end ========================= -->


            <!-- ========================= testimonial-section start ========================= -->
            <section id="testimonial" class="testimonial-section img-bg pt-150 pb-40">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title mb-60 text-center">
                                <span class="wow fadeInUp" data-wow-delay=".2s">Testimonials</span>
                                <h1 class="wow fadeInUp" data-wow-delay=".4s">What Our Users Says</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row testimonial-wrapper">
                        @foreach($reviews as $review)
                        @if($review->review)
                        <div class="col-lg-4 col-md-6 -mt-30">
                            <div class="single-testimonial wow fadeInUp" data-wow-delay=".2s">
                                <div class="rating">
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                </div>
                                <div class="content">
                                    <p>{{$review->review}}
                                    </p>
                                </div>
                                <div class="info">
                                    <div class="text">
                                        <h5>{{$review->name ?? 'N/A'}}</h5>
                                        <p>From <span>{{$review->city ?? 'N/A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- ========================= testimonial-section end ========================= -->



            <!-- ========================= Contact-section start ========================= -->
            <section id="about" class="about-section pt-150">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="contact-us wow fadeInUp" data-wow-delay=".5s">
                                <img src="/settingsimage/{{$setting_two->contact_us ?? 'N/A'}}" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="about-content">
                                <div class="section-title">
                                    <span class="wow fadeInUp" data-wow-delay=".2s">Contact Us</span>
                                    <h4 class="wow fadeInUp" data-wow-delay=".4s">Our Different channels where you can
                                        reach us are available below
                                    </h4>
                                    <div class="wow fadeInUp" data-wow-delay=".6s">
                                        <hr>
                                        <p class="my-2"><img src="assets/img/contact/address-icon.png"
                                                class="contact-icon" alt=""> {{$company_details->address ?? 'N/A'}}</p>
                                        <hr>
                                        <p class="my-2"><img src="assets/img/contact/email-icon.png"
                                                class="contact-icon" alt=""> {{$company_details->company_email ?? 'N/A'}}</p>
                                        <hr>
                                        <p class="my-2"><img src="assets/img/contact/phone-icon.png"
                                                class="contact-icon" alt=""> {{$company_details->company_phone ?? 'N/A'}}</p>
                                        <hr>
                                    </div>
                                </div>

                                <!-- ========================= Enquiry-section start ========================= -->
                                <div id="contact" class="wow fadeInUp" data-wow-delay=".8s">Make an Enquiry!</div>

                                <div id="contactForm">

                                    <h1>Keep in touch!</h1>
                                    <small>We'll get back to you as quickly as possible</small>

                                    <form action="{{route('contact-form')}}" method="post" class="px-3">
                                        @csrf
                                        <input placeholder="Name" name="name" type="text" required />
                                        <input placeholder="Email" name="email" type="email" required />
                                        <input placeholder="Subject" name="subject" type="text" required />
                                        <textarea type="text" placeholder="Comment" name="comment"></textarea>
                                        <input class="formBtn" type="submit" />
                                        <input class="formBtn" type="reset" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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

            <!-- ========================= scroll-top ========================= -->
            <a href="#" class="scroll-top btn-hover">
                <i class="lni lni-chevron-up"></i>
            </a>

            <!-- ========================= courier-form popUp ========================= -->
            <button class="open-button" onclick="openForm()">
                Become a courier
            </button>

            <!-- ========================= courier-form Hidden by default ========================= -->
            <div class="form-popup" id="myForm">
                <form action="{{route('courier-form')}}" method="post" class="form-container" required>
                    @csrf
                    <h2>Fill This Basic Form!</h2>

                    <input type="text" id="name" placeholder="Enter Full Name" name="name" class="form-control"
                        required>
                    @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <input type="text" id="email" placeholder="Enter Email" name="email" class="form-control" required>
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <input type="text" id="phone" placeholder="Enter Phone" name="phone" class="form-control" required>
                    @error('phone')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <select class="form-select form-control" id="branch_id" name="gender" required>
                        <option>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <select class="form-select form-control my-4" id="branch_id" name="vehicle" required>
                        <option>Type of Vehicle</option>
                        <option value="motor-cycle">Motor-cycle</option>
                        <option value="tri-cycle">Tri-cycle</option>
                        <option value="car">Car</option>
                        <option value="truck">Truck</option>
                    </select>
                    @error('vehicle')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <label for="address">Address</label>
                    <textarea name="address" id="address" rows="2" class="form-control" required></textarea>
                    @error('address')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>


    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.5.0.0.alpha-2-min.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/contact-us.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('success'))
    <script>
    swal("{{session('success')}}");
    </script>
    @endif
</body>

</html>