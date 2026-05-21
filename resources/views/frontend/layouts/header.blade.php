<style>
    /* ══════════════════════════════════════════
       NAVBAR
    ══════════════════════════════════════════ */
    .navbar-custom {
        position: fixed;
        top: 0; left: 0; right: 0;
        z-index: 9999;
        transition: all .35s ease;
        background: transparent;
    }
    .navbar-custom.scrolled {
        background: rgba(255,255,255,.97);
        backdrop-filter: blur(12px);
        box-shadow: 0 1px 0 rgba(0,0,0,.08), 0 4px 24px rgba(0,0,0,.06);
    }

    .nav-inner {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 76px;
    }

    /* ── Brand ───────────────────────────────── */
    .nav-brand {
        display: flex; align-items: center; gap: 14px;
        text-decoration: none; flex-shrink: 0;
    }
    .nav-brand-logo {
        width: 50px; height: 50px;
        border-radius: 12px;
        overflow: hidden;
        display: flex; align-items: center; justify-content: center;
        background: rgba(255,255,255,.15);
        border: 1.5px solid rgba(255,255,255,.25);
        transition: all .35s;
    }
    .navbar-custom.scrolled .nav-brand-logo {
        background: #fdecea;
        border-color: #fdecea;
    }
    .nav-brand-logo img { width: 36px; height: 36px; object-fit: contain; }
    .nav-brand-text { display: flex; flex-direction: column; line-height: 1.2; }
    .nav-brand-name {
        font-size: 1.25rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: .2px;
        transition: color .35s;
    }
    .nav-brand-sub {
        font-size: .76rem;
        color: rgba(255,255,255,.7);
        font-weight: 500;
        transition: color .35s;
    }
    .navbar-custom.scrolled .nav-brand-name { color: #b71c1c; }
    .navbar-custom.scrolled .nav-brand-sub  { color: #999; }

    /* ── Menu ────────────────────────────────── */
    .nav-menu {
        display: flex; align-items: center;
        gap: 2px; list-style: none;
        margin: 0; padding: 0;
    }
    .nav-menu > li > a {
        display: flex; align-items: center; gap: 5px;
        padding: 10px 16px;
        font-size: 1rem;
        font-weight: 600;
        color: rgba(255,255,255,.9);
        text-decoration: none;
        border-radius: 10px;
        transition: all .22s;
        white-space: nowrap;
    }
    .navbar-custom.scrolled .nav-menu > li > a { color: #333; }

    .nav-menu > li > a:hover,
    .nav-menu > li.active > a {
        background: rgba(255,255,255,.14);
        color: #fff;
    }
    .navbar-custom.scrolled .nav-menu > li > a:hover,
    .navbar-custom.scrolled .nav-menu > li.active > a {
        background: #fdecea;
        color: #b71c1c;
    }

    /* ── Dropdown ────────────────────────────── */
    .nav-menu > li.has-dd { position: relative; }
    .nav-dd {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 12px 40px rgba(0,0,0,.13);
        min-width: 240px;
        padding: 8px;
        list-style: none; margin: 0;
        border: 1px solid rgba(0,0,0,.06);
    }
    .nav-menu > li.has-dd:hover .nav-dd { display: block; }
    .nav-dd li a {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 16px;
        border-radius: 10px;
        font-size: .95rem; font-weight: 600;
        color: #333; text-decoration: none;
        transition: all .18s;
    }
    .nav-dd li a:hover { background: #fdecea; color: #b71c1c; }
    .nav-dd li a i { width: 18px; text-align: center; color: #b71c1c; font-size: .9rem; }
    .nav-dd-divider { height: 1px; background: #f0f0f0; margin: 6px 8px; }

    /* ── Login button ────────────────────────── */
    .nav-login {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 26px;
        border-radius: 50px;
        background: #b71c1c;
        color: #fff !important;
        font-size: .95rem; font-weight: 700;
        text-decoration: none;
        border: 2px solid #b71c1c;
        transition: all .25s;
        white-space: nowrap;
    }
    .nav-login:hover {
        background: #8b0000;
        border-color: #8b0000;
        color: #fff !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(183,28,28,.35);
    }
    .navbar-custom:not(.scrolled) .nav-login {
        background: rgba(255,255,255,.15);
        border-color: rgba(255,255,255,.45);
    }
    .navbar-custom:not(.scrolled) .nav-login:hover {
        background: rgba(255,255,255,.25);
        border-color: rgba(255,255,255,.7);
    }

    /* ── Hamburger ───────────────────────────── */
    .nav-burger {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        padding: 6px;
        background: none; border: none;
    }
    .nav-burger span {
        display: block; width: 26px; height: 2.5px;
        background: #fff; border-radius: 3px;
        transition: all .3s;
    }
    .navbar-custom.scrolled .nav-burger span { background: #333; }

    /* ── Mobile ──────────────────────────────── */
    @media (max-width: 991px) {
        .nav-burger { display: flex; }
        .nav-inner  { height: 68px; padding: 0 20px; }
        .nav-menu {
            display: none;
            position: absolute;
            top: 68px; left: 0; right: 0;
            background: #fff;
            flex-direction: column;
            align-items: stretch;
            gap: 0; padding: 12px 16px 20px;
            box-shadow: 0 12px 36px rgba(0,0,0,.13);
            border-top: 1px solid #f0f0f0;
        }
        .nav-menu.open { display: flex; }
        .nav-menu > li > a {
            color: #333; font-size: 1rem;
            padding: 12px 14px;
        }
        .nav-menu > li > a:hover,
        .nav-menu > li.active > a { background: #fdecea; color: #b71c1c; }
        .nav-dd {
            display: none !important;
            position: static;
            box-shadow: none; border: none;
            border-radius: 0;
            padding: 0 0 0 16px;
            background: transparent;
        }
        .nav-menu > li.has-dd.open .nav-dd { display: block !important; }
        .nav-dd li a { font-size: .95rem; padding: 10px 14px; }
        .nav-login { justify-content: center; margin: 10px 0 2px; }
    }

    body { padding-top: 76px; }
    @media (max-width: 991px) { body { padding-top: 68px; } }
</style>

<nav class="navbar-custom" id="mainNav">
    <div class="nav-inner">

        <a href="{{ route('home') }}" class="nav-brand">
            <div class="nav-brand-logo">
                <img src="{{ asset('frontend/img/pemkot.png') }}" alt="Logo Pemkot Semarang">
            </div>
            <div class="nav-brand-text">
                <span class="nav-brand-name">E-SAKIP</span>
                <span class="nav-brand-sub">Kota Semarang</span>
            </div>
        </a>

        <button class="nav-burger" id="navBurger" aria-label="Buka menu">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-menu" id="navMenu">
            <li class="{{ active_class(['home']) }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-home" style="font-size:.85rem;"></i> Beranda
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
            <li class="has-dd {{ active_class(['evaluasi_kinerja_realtime','evaluasi_kinerja']) }}">
                <a href="#">
                    Evaluasi
                    <i class="fa fa-chevron-down" style="font-size:.62rem;margin-left:2px;"></i>
                </a>
                <ul class="nav-dd">
                    <li>
                        <a href="{{ route('evaluasi_kinerja_realtime') }}">
                            <i class="fa fa-chart-line"></i>
                            Evaluasi Internal Realtime
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('evaluasi_kinerja') }}">
                            <i class="fa fa-history"></i>
                            Evaluasi Internal 2019&ndash;2023
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
    var nav    = document.getElementById('mainNav');
    var menu   = document.getElementById('navMenu');
    var burger = document.getElementById('navBurger');

    function checkScroll() {
        nav.classList.toggle('scrolled', window.scrollY > 20);
    }
    window.addEventListener('scroll', checkScroll);
    checkScroll();

    burger.addEventListener('click', function () {
        menu.classList.toggle('open');
    });

    document.querySelectorAll('.has-dd > a').forEach(function (a) {
        a.addEventListener('click', function (e) {
            if (window.innerWidth <= 991) {
                e.preventDefault();
                a.closest('li').classList.toggle('open');
            }
        });
    });
})();
</script>
