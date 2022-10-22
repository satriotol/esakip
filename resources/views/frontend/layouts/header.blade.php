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
                    <a href="{{ route('home') }}" class="{{ active_class(['home']) }}">Beranda</a>
                </li>
                <li
                    class="dropdown {{ active_class(['perencanaan_kinerja_kota', 'perencanaan_kinerja_opd']) }} dropdown-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Perencanaan Kinerja</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('perencanaan_kinerja_kota') }}">Kota</a></li>
                        <li><a href="{{ route('perencanaan_kinerja_opd') }}">OPD</a></li>
                    </ul>
                </li>
                <li
                    class="dropdown {{ active_class(['pengukuran_kinerja_kota', 'pengukuran_kinerja_opd']) }} dropdown-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pengukuran Kinerja</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('pengukuran_kinerja_kota') }}">Kota</a></li>
                        <li><a href="{{ route('pengukuran_kinerja_opd') }}">OPD</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('pelaporan_kinerja') }}"
                        class="{{ active_class(['pelaporan_kinerja']) }}">Pelaporan Kinerja</a>
                </li>
                <li>
                    <a href="{{ route('capaian_kinerja') }}"
                        class="{{ active_class(['capaian_kinerja']) }}">Capaian Kinerja</a>
                </li>
                <li>
                    <a href="{{ route('evaluasi_kinerja') }}"
                        class="{{ active_class(['evaluasi_kinerja']) }}">Evaluasi Kinerja</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ active_class(['dashboard']) }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
