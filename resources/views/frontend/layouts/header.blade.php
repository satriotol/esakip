<style>
    .navbar-custom {
        position: fixed;
        top: 0; left: 0; right: 0;
        z-index: 9999;
        padding: 0 0;
        transition: all .35s ease;
        background: transparent;
    }
    .navbar-custom.scrolled {
        background: #fff;
        box-shadow: 0 2px 20px rgba(0,0,0,.10);
    }
    .navbar-custom .container-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 72px;
    }
    /* Brand */
    .nav-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }
    .nav-brand img { height: 48px; width: 48px; object-fit: contain; }
    .nav-brand-text { display: flex; flex-direction: column; line-height: 1.25; }
    .nav-brand-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: .3px;
        transition: color .35s;
    }
    .nav-brand-sub {
        font-size: .78rem;
        color: rgba(255,255,255,.78);
        font-weight: 500;
        transition: color .35s;
    }
    .navbar-custom.scrolled .nav-brand-title { color: #b73333; }
    .navbar-custom.scrolled .nav-brand-sub  { color: #888; }

    /* Menu */
    .nav-menu {
        display: flex;
        align-items: center;
        gap: 2px;
        list-style: none;
        margin: 0; padding: 0;
    }
    .nav-menu > li > a {
        display: block;
        padding: 9px 16px;
        font-size: .97rem;
        font-weight: 600;
        color: rgba(255,255,255,.9);
        text-decoration: none;
        border-radius: 8px;
        transition: all .2s;
        white-space: nowrap;
    }
    .navbar-custom.scrolled .nav-menu > li > a { color: #444; }
    .nav-menu > li > a:hover,
    .nav-menu > li.active > a {
        background: rgba(255,255,255,.15);
        color: #fff;
    }
    .navbar-custom.scrolled .nav-menu > li > a:hover,
    .navbar-custom.scrolled .nav-menu > li.active > a {
        background: #fdecea;
        color: #b73333;
    }

    /* Dropdown */
    .nav-menu > li.has-dropdown { position: relative; }
    .nav-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,.12);
        min-width: 220px;
        padding: 8px;
        list-style: none;
        margin: 0;
    }
    .nav-menu > li.has-dropdown:hover .nav-dropdown { display: block; }
    .nav-dropdown li a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 16px;
        border-radius: 8px;
        font-size: .93rem;
        font-weight: 600;
        color: #444;
        text-decoration: none;
        transition: all .2s;
    }
    .nav-dropdown li a:hover { background: #fdecea; color: #b73333; }
    .nav-dropdown li a i { width: 16px; text-align: center; color: #b73333; }

    /* Login button */
    .nav-login {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 24px;
        border-radius: 50px;
        background: #b73333;
        color: #fff !important;
        font-size: .95rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .25s;
        border: 2px solid #b73333;
    }
    .nav-login:hover {
        background: transparent;
        color: #b73333 !important;
    }
    .navbar-custom.scrolled .nav-login { border-color: #b73333; }
    .navbar-custom:not(.scrolled) .nav-login:hover {
        background: rgba(255,255,255,.15);
        border-color: rgba(255,255,255,.5);
        color: #fff !important;
    }

    /* Hamburger */
    .nav-hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        padding: 4px;
        background: none;
        border: none;
    }
    .nav-hamburger span {
        display: block;
        width: 24px;
        height: 2px;
        background: #fff;
        border-radius: 2px;
        transition: all .3s;
    }
    .navbar-custom.scrolled .nav-hamburger span { background: #333; }

    /* Mobile */
    @media (max-width: 991px) {
        .nav-hamburger { display: flex; }
        .nav-menu {
            display: none;
            position: absolute;
            top: 68px; left: 0; right: 0;
            background: #fff;
            flex-direction: column;
            align-items: stretch;
            gap: 0;
            padding: 12px 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,.12);
        }
        .nav-menu.open { display: flex; }
        .nav-menu > li > a { color: #333; }
        .nav-menu > li > a:hover,
        .nav-menu > li.active > a { background: #fdecea; color: #b73333; }
        .nav-dropdown {
            display: none !important;
            position: static;
            box-shadow: none;
            border-radius: 0;
            padding: 0 0 0 16px;
        }
        .nav-menu > li.has-dropdown.open .nav-dropdown { display: block !important; }
        .nav-login { justify-content: center; margin: 8px 0; }
    }
    /* Push content below fixed nav */
    body { padding-top: 72px; }
</style>

<nav class="navbar-custom" id="mainNav">
    <div class="container-inner">

        <a href="{{ route('home') }}" class="nav-brand">
            <img src="{{ asset('frontend/img/pemkot.png') }}" alt="Logo Pemkot Semarang">
            <div class="nav-brand-text">
                <span class="nav-brand-title">E-SAKIP</span>
                <span class="nav-brand-sub">Kota Semarang</span>
            </div>
        </a>

        <button class="nav-hamburger" id="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-menu" id="navMenu">
            <li class="{{ active_class(['home']) }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-home" style="margin-right:4px;"></i> Beranda
                </a>
            </li>
            <li class="{{ active_class(['v2.perencanaan.index']) }}">
                <a href="{{ route('v2.perencanaan.index') }}">Perencanaan</a>
            </li>
            <li class="{{ active_class(['v2.pengukuran.index']) }}">
                <a href="{{ route('v2.pengukuran.index') }}">Pengukuran</a>
            </li>
            <li class="{{ active_class(['v2.pelaporan.index']) }}">
                <a href="{{ route('v2.pelaporan.index') }}">Pelaporan</a>
            </li>
            <li class="has-dropdown {{ active_class(['evaluasi_kinerja_realtime','evaluasi_kinerja']) }}">
                <a href="#">Evaluasi <i class="fa fa-chevron-down" style="font-size:.65rem;margin-left:3px;"></i></a>
                <ul class="nav-dropdown">
                    <li>
                        <a href="{{ route('evaluasi_kinerja_realtime') }}">
                            <i class="fa fa-chart-line"></i> Evaluasi Internal Realtime
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('evaluasi_kinerja') }}">
                            <i class="fa fa-history"></i> Evaluasi Internal 2019&ndash;2023
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('portal') }}" target="_blank" class="nav-login">
                    <i class="fa fa-sign-in-alt"></i> Login
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    (function () {
        const nav  = document.getElementById('mainNav');
        const menu = document.getElementById('navMenu');
        const btn  = document.getElementById('hamburger');

        window.addEventListener('scroll', function () {
            nav.classList.toggle('scrolled', window.scrollY > 20);
        });
        if (window.scrollY > 20) nav.classList.add('scrolled');

        btn.addEventListener('click', function () {
            menu.classList.toggle('open');
        });

        // mobile dropdown toggle
        document.querySelectorAll('.has-dropdown > a').forEach(function (a) {
            a.addEventListener('click', function (e) {
                if (window.innerWidth <= 991) {
                    e.preventDefault();
                    a.closest('li').classList.toggle('open');
                }
            });
        });
    })();
</script>
