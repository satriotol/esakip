<header>

    <!-- Start Navigation -->
    <nav class="navbar navbar-default active-border navbar-fixed navbar-transparent white bootsnav">

        <div class="container">

            <!-- Start Atribute Navigation -->
            {{-- <div class="attr-nav button fixed-nav">
                <ul>
                    <li>
                        <a class="smooth-menu" href="#protect"><i class="fas fa-shield-alt"></i> How to Protect</a>
                    </li>
                </ul>
            </div> --}}
            <!-- End Atribute Navigation -->

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="frontend/img/logo-light.png" class="logo logo-display" alt="Logo">
                    <img src="frontend/img/logo.png" class="logo logo-scrolled" alt="Logo">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                    <li>
                        <a href="{{ route('home') }}" class="active">Beranda</a>
                    </li>
                    <li>
                        <a href="about.html">About Us</a>
                    </li>
                    <li>
                        <a href="prevention.html">Prevention</a>
                    </li>
                    <li>
                        <a href="faq.html">Faq</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
                        <ul class="dropdown-menu">
                            <li><a href="blog-standard.html">Blog Grid</a></li>
                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                            <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                            <li><a href="blog-single.html">Blog Single Standard</a></li>
                            <li><a href="blog-single-left-sidebar.html">Single Left Sidebar</a></li>
                            <li><a href="blog-single-right-sidebar.html">Single Right Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.html">contact</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    <!-- End Navigation -->

</header>
<!-- End Header -->
