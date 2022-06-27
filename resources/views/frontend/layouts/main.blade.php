<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Coroni - Coronavirus Medical Prevention Template">

    <!-- ========== Page Title ========== -->
    <title>E-SAKIP PEMKOT SEMARANG</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="frontend/img/favicon.png" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/flaticon-set.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/bootsnav.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" />
    @stack('css')
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800" rel="stylesheet">

</head>

<body>

    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->
    @include('frontend.layouts.header')

    <!-- Start Banner
    ============================================= -->
    <div class="banner-area text-center single-banner bg-cover text-light"
        style="background-image: url(frontend/img/2440x1578.png);">
        <div class="item">
            <div class="box-table shadow theme-hard">
                <div class="box-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="content">
                                    <h2 data-animation="animated fadeInLeft">Coronavirus</h2>
                                    <p data-animation="animated slideInUp">
                                        Continual delighted as elsewhere am convinced unfeeling. Introduced stimulated
                                        attachment no by projection. To loud lady whom my mile sold four.
                                    </p>
                                    <h4>Basic Symptroms</h4>
                                    <ul>
                                        <li>
                                            <span>Headache</span>
                                        </li>
                                        <li>
                                            <span>Fatigue</span>
                                        </li>
                                        <li>
                                            <span>Shaking Chills</span>
                                        </li>
                                        <li>
                                            <span>Dhiarrea</span>
                                        </li>
                                        <li>
                                            <span>Fever</span>
                                        </li>
                                        <li>
                                            <span>Cough</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wavesshape">
                        <img src="frontend/img/waves-shape.svg" alt="Shape">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Banner -->

    <!-- Start Footer
    ============================================= -->
    <footer class="bg-dark text-light">
        @include('frontend.layouts.footer')
    </footer>
    <!-- End Footer -->

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{ asset('frontend/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/equal-height.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/modernizr.custom.13711.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/progress-bar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/count-to.js') }}"></script>
    <script src="{{ asset('frontend/js/YTPlayer.min.js') }}"></script>
    <script src="{{ asset('frontend/js/circle-progress.js') }}"></script>
    <script src="{{ asset('frontend/js/bootsnav.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @stack('script')

</body>

</html>
