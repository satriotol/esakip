@extends('frontend.layouts.main')

@push('css')
<style>
    /* ── Hero ─────────────────────────────── */
    .home-hero {
        min-height: 100vh;
        background: linear-gradient(150deg, #7b1fa2 0%, #b73333 55%, #e65100 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        padding: 100px 20px 80px;
        margin-top: -72px;
    }
    .home-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('kotasemarangvector.jpg') }}') center/cover no-repeat;
        opacity: .12;
    }
    .home-hero-orb {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        animation: floatOrb 8s ease-in-out infinite;
    }
    @keyframes floatOrb {
        0%,100% { transform: translateY(0); }
        50%      { transform: translateY(-20px); }
    }
    .hero-content { position: relative; z-index: 1; max-width: 720px; margin: 0 auto; }
    .hero-logo {
        width: 90px; height: 90px;
        border-radius: 50%;
        background: rgba(255,255,255,.15);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(255,255,255,.3);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 28px;
    }
    .hero-logo img { width: 60px; height: 60px; object-fit: contain; }
    .hero-content h1 {
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.5px;
        margin-bottom: 16px;
    }
    .hero-content p {
        font-size: 1.05rem;
        color: rgba(255,255,255,.82);
        line-height: 1.7;
        margin-bottom: 40px;
    }
    .hero-scroll {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,.7);
        font-size: .82rem;
        font-weight: 600;
        letter-spacing: .5px;
        text-transform: uppercase;
        animation: bounce 2s infinite;
        cursor: pointer;
        border: none;
        background: none;
    }
    @keyframes bounce {
        0%,100% { transform: translateY(0); }
        50%      { transform: translateY(6px); }
    }

    /* ── Tentang ──────────────────────────── */
    .home-section { padding: 80px 0; }
    .section-label {
        display: inline-block;
        background: #fdecea;
        color: #b73333;
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 4px 14px;
        border-radius: 50px;
        margin-bottom: 14px;
    }
    .section-title {
        font-size: 1.9rem;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    .section-title span { color: #b73333; }
    .section-desc { color: #777; font-size: .95rem; line-height: 1.8; }

    /* ── Menu Cards ───────────────────────── */
    .menu-section { padding: 0 0 80px; }
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 22px;
        margin-top: 40px;
    }
    .menu-card {
        background: #fff;
        border-radius: 18px;
        padding: 32px 26px;
        box-shadow: 0 4px 24px rgba(0,0,0,.07);
        text-decoration: none;
        transition: all .3s ease;
        display: flex;
        flex-direction: column;
        gap: 16px;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }
    .menu-card::before {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 4px;
        background: var(--card-color, #b73333);
        transform: scaleX(0);
        transition: transform .3s ease;
        transform-origin: left;
    }
    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 48px rgba(0,0,0,.12);
        border-color: var(--card-color, #b73333);
    }
    .menu-card:hover::before { transform: scaleX(1); }
    .card-icon {
        width: 56px; height: 56px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        background: var(--card-bg, #fdecea);
        color: var(--card-color, #b73333);
        flex-shrink: 0;
    }
    .card-body h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #222;
        margin: 0 0 6px;
    }
    .card-body p {
        font-size: .82rem;
        color: #999;
        margin: 0;
        line-height: 1.6;
    }
    .card-arrow {
        margin-top: auto;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .8rem;
        font-weight: 700;
        color: var(--card-color, #b73333);
    }

    /* ── Stats bar ────────────────────────── */
    .stats-bar {
        background: linear-gradient(135deg, #b73333 0%, #7b1fa2 100%);
        padding: 48px 0;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 30px;
        text-align: center;
    }
    .stat-item h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #fff;
        margin: 0 0 4px;
    }
    .stat-item p { color: rgba(255,255,255,.75); font-size: .85rem; margin: 0; font-weight: 500; }
</style>
@endpush

@section('content')

    {{-- Hero --}}
    <div class="home-hero">
        <div class="home-hero-orb" style="width:500px;height:500px;top:-150px;right:-150px;"></div>
        <div class="home-hero-orb" style="width:300px;height:300px;bottom:-80px;left:-80px;animation-delay:3s;"></div>

        <div class="hero-content">
            <div class="hero-logo">
                <img src="{{ asset('frontend/img/pemkot.png') }}" alt="Logo">
            </div>
            <h1>Sistem Akuntabilitas Kinerja Instansi Pemerintah</h1>
            <p>
                Platform digital terintegrasi untuk perencanaan, pengukuran, pelaporan,<br>
                dan evaluasi kinerja Pemerintah Kota Semarang.
            </p>
            <button class="hero-scroll" onclick="document.getElementById('konten').scrollIntoView({behavior:'smooth'})">
                <i class="fa fa-chevron-down"></i> Jelajahi
            </button>
        </div>
    </div>

    {{-- Tentang --}}
    <div class="home-section bg-white" id="konten">
        <div class="container">
            <div class="row" style="align-items:center; gap: 20px 0;">
                <div class="col-md-5">
                    <span class="section-label">Tentang Sistem</span>
                    <h2 class="section-title">Apa itu <span>E-SAKIP</span>?</h2>
                    <p class="section-desc">
                        {!! $website->description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Cards --}}
    <div class="menu-section" style="padding-top:72px;">
        <div class="container">
            <div class="text-center" style="margin-bottom:8px;">
                <span class="section-label">Menu Utama</span>
                <h2 class="section-title">Layanan <span>Informasi</span></h2>
            </div>
            <div class="menu-grid">
                <a href="{{ route('v2.perencanaan.index') }}" class="menu-card" style="--card-color:#b73333;--card-bg:#fdecea;">
                    <div class="card-icon"><i class="fa fa-file-alt"></i></div>
                    <div class="card-body">
                        <h3>Perencanaan Kinerja</h3>
                        <p>RPJMD, RKPD, Pohon Kinerja, Renja, dan dokumen perencanaan lainnya.</p>
                    </div>
                    <div class="card-arrow">Lihat Dokumen <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('v2.pengukuran.index') }}" class="menu-card" style="--card-color:#1565c0;--card-bg:#e3f2fd;">
                    <div class="card-icon"><i class="fa fa-chart-bar"></i></div>
                    <div class="card-body">
                        <h3>Pengukuran Kinerja</h3>
                        <p>Data pengukuran dan capaian kinerja Kota maupun OPD secara berkala.</p>
                    </div>
                    <div class="card-arrow">Lihat Dokumen <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('v2.pelaporan.index') }}" class="menu-card" style="--card-color:#2e7d32;--card-bg:#e8f5e9;">
                    <div class="card-icon"><i class="fa fa-clipboard-list"></i></div>
                    <div class="card-body">
                        <h3>Pelaporan Kinerja</h3>
                        <p>Laporan kinerja tahunan instansi pemerintah Kota Semarang.</p>
                    </div>
                    <div class="card-arrow">Lihat Dokumen <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('evaluasi_kinerja_realtime') }}" class="menu-card" style="--card-color:#6a1b9a;--card-bg:#f3e5f5;">
                    <div class="card-icon"><i class="fa fa-chart-line"></i></div>
                    <div class="card-body">
                        <h3>Evaluasi Internal Realtime</h3>
                        <p>Hasil evaluasi AKIP terbaru secara real-time dari seluruh OPD.</p>
                    </div>
                    <div class="card-arrow">Lihat Data <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('evaluasi_kinerja') }}" class="menu-card" style="--card-color:#e65100;--card-bg:#fff3e0;">
                    <div class="card-icon"><i class="fa fa-history"></i></div>
                    <div class="card-body">
                        <h3>Evaluasi Internal 2019&ndash;2023</h3>
                        <p>Rekap historis hasil evaluasi AKIP periode tahun 2019 hingga 2023.</p>
                    </div>
                    <div class="card-arrow">Lihat Data <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('portal') }}" target="_blank" class="menu-card" style="--card-color:#37474f;--card-bg:#eceff1;">
                    <div class="card-icon"><i class="fa fa-sign-in-alt"></i></div>
                    <div class="card-body">
                        <h3>Login Sistem</h3>
                        <p>Masuk ke portal E-SAKIP untuk mengelola data kinerja instansi Anda.</p>
                    </div>
                    <div class="card-arrow">Buka Portal <i class="fa fa-external-link-alt"></i></div>
                </a>
            </div>
        </div>
    </div>

@endsection
