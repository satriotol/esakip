<nav class="navbar navbar-default active-border navbar-fixed navbar-transparent white bootsnav">

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('frontend/img/pemkot.png') }}" class="logo logo-display" alt="Logo">
                <img src="{{ asset('frontend/img/pemkot.png') }}" class="logo logo-scrolled" alt="Logo">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                <li>
                    <a href="{{ route('home') }}" class="active">Beranda</a>
                </li>
                <li>
                    <a href="{{ route('pelaporan_kinerja') }}">Pelaporan Kinerja</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
