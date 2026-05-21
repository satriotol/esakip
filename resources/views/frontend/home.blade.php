@extends('frontend.layouts.main')

@push('css')
<style>
    /* ══════════════════════════════════════════
       HERO
    ══════════════════════════════════════════ */
    .home-hero {
        min-height: 100vh;
        background: linear-gradient(150deg, #4a0072 0%, #b71c1c 50%, #e65100 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        padding: 120px 24px 100px;
        margin-top: -72px;
    }
    .home-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('kotasemarangvector.jpg') }}') center/cover no-repeat;
        opacity: .08;
    }
    /* floating orbs */
    .hero-orb {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,.055);
        animation: floatOrb 10s ease-in-out infinite;
        pointer-events: none;
    }
    @keyframes floatOrb {
        0%,100% { transform: translateY(0) scale(1); }
        50%      { transform: translateY(-28px) scale(1.04); }
    }
    /* inner glow ring */
    .hero-glow {
        position: absolute;
        width: 600px; height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,.07) 0%, transparent 70%);
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 860px;
        margin: 0 auto;
    }
    .hero-logo {
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,.3);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 36px;
        box-shadow: 0 8px 32px rgba(0,0,0,.2);
    }
    .hero-logo img { width: 64px; height: 64px; object-fit: contain; }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 50px;
        padding: 7px 20px;
        font-size: .82rem;
        font-weight: 600;
        color: rgba(255,255,255,.9);
        letter-spacing: .5px;
        text-transform: uppercase;
        margin-bottom: 28px;
    }
    .hero-eyebrow i { color: rgba(255,255,255,.7); }

    .hero-content h1 {
        font-size: clamp(2.4rem, 6vw, 4.2rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        letter-spacing: -1px;
        margin-bottom: 24px;
    }
    .hero-content h1 span {
        background: linear-gradient(90deg, #ffd54f, #ffb300);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-subtitle {
        font-size: clamp(1rem, 2.2vw, 1.2rem);
        color: rgba(255,255,255,.82);
        line-height: 1.75;
        margin-bottom: 48px;
        max-width: 640px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-cta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 56px;
    }
    .btn-hero-primary {
        display: inline-flex; align-items: center; gap: 10px;
        padding: 16px 38px;
        background: #fff; color: #b71c1c;
        border-radius: 50px; font-weight: 700; font-size: 1rem;
        text-decoration: none;
        box-shadow: 0 8px 28px rgba(0,0,0,.22);
        transition: all .25s;
        white-space: nowrap;
    }
    .btn-hero-primary:hover {
        background: #fce4e4; color: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 12px 36px rgba(0,0,0,.28);
    }
    .btn-hero-ghost {
        display: inline-flex; align-items: center; gap: 10px;
        padding: 15px 34px;
        background: transparent; color: #fff;
        border: 2px solid rgba(255,255,255,.45);
        border-radius: 50px; font-weight: 600; font-size: 1rem;
        text-decoration: none;
        transition: all .25s;
        white-space: nowrap;
    }
    .btn-hero-ghost:hover {
        background: rgba(255,255,255,.15);
        border-color: rgba(255,255,255,.7);
        color: #fff;
        transform: translateY(-2px);
    }

    .hero-scroll {
        display: inline-flex; align-items: center; gap: 8px;
        color: rgba(255,255,255,.6);
        font-size: .8rem; font-weight: 600;
        letter-spacing: .8px; text-transform: uppercase;
        animation: bounce 2.4s infinite;
        cursor: pointer; border: none; background: none;
    }
    @keyframes bounce {
        0%,100% { transform: translateY(0); }
        50%      { transform: translateY(8px); }
    }

    /* ══════════════════════════════════════════
       TENTANG
    ══════════════════════════════════════════ */
    .home-section { padding: 88px 0; }

    .section-eyebrow {
        display: inline-block;
        background: #fdecea;
        color: #b71c1c;
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        padding: 5px 16px;
        border-radius: 50px;
        margin-bottom: 16px;
    }
    .section-heading {
        font-size: clamp(1.8rem, 3.5vw, 2.6rem);
        font-weight: 800;
        color: #111;
        line-height: 1.2;
        margin-bottom: 14px;
        letter-spacing: -.5px;
    }
    .section-heading span { color: #b71c1c; }
    .section-lead {
        font-size: 1rem;
        color: #666;
        line-height: 1.85;
    }

    /* feature cards kanan Tentang */
    .feature-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    @media (max-width: 640px) { .feature-grid { grid-template-columns: 1fr; } }

    .feat-card {
        display: flex; align-items: flex-start; gap: 16px;
        padding: 20px 18px;
        border-radius: 16px;
        background: var(--fc-bg, #fdecea);
        border-left: 3px solid var(--fc-color, #b71c1c);
        text-decoration: none;
        transition: transform .22s, box-shadow .22s;
    }
    .feat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,.09); }
    .feat-icon {
        width: 44px; height: 44px; border-radius: 12px;
        background: var(--fc-color, #b71c1c);
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
    }
    .feat-card h4 { font-size: .92rem; font-weight: 700; color: #1a1a1a; margin: 0 0 4px; }
    .feat-card p  { font-size: .78rem; color: #888; margin: 0; line-height: 1.55; }

    /* ══════════════════════════════════════════
       SIKLUS SAKIP
    ══════════════════════════════════════════ */
    .cycle-section { padding: 88px 0; background: #f8f9fb; }
    .cycle-wrap {
        display: flex; align-items: flex-start;
        justify-content: center;
        gap: 0;
        flex-wrap: wrap;
        margin-top: 52px;
    }
    .cycle-step {
        flex: 1; min-width: 140px; max-width: 200px;
        text-align: center;
        padding: 24px 12px;
    }
    .cycle-icon {
        width: 72px; height: 72px;
        border-radius: 22px;
        margin: 0 auto 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.7rem;
        box-shadow: 0 6px 22px rgba(0,0,0,.1);
        position: relative;
    }
    .cycle-num {
        position: absolute; top: -10px; right: -10px;
        width: 26px; height: 26px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid currentColor;
        font-size: .66rem; font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        color: inherit;
    }
    .cycle-step h4 { font-size: 1rem; font-weight: 700; color: #1a1a1a; margin: 0 0 6px; }
    .cycle-step p  { font-size: .78rem; color: #999; margin: 0; line-height: 1.55; }
    .cycle-arrow { color: #d8d8d8; font-size: 1.5rem; flex-shrink: 0; margin-top: 56px; }
    @media (max-width: 767px) { .cycle-arrow { display: none; } }

    /* ══════════════════════════════════════════
       MENU CARDS
    ══════════════════════════════════════════ */
    .menu-section { padding: 88px 0; background: #fff; }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
        margin-top: 52px;
    }
    .menu-card {
        background: #fff;
        border-radius: 20px;
        padding: 36px 28px;
        box-shadow: 0 4px 28px rgba(0,0,0,.07);
        text-decoration: none;
        display: flex; flex-direction: column; gap: 18px;
        border: 2px solid transparent;
        position: relative; overflow: hidden;
        transition: all .3s ease;
    }
    .menu-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 4px;
        background: var(--mc, #b71c1c);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .3s ease;
    }
    .menu-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 20px 56px rgba(0,0,0,.13);
        border-color: var(--mc, #b71c1c);
    }
    .menu-card:hover::after { transform: scaleX(1); }

    .mc-icon {
        width: 60px; height: 60px;
        border-radius: 16px;
        background: var(--mc-bg, #fdecea);
        color: var(--mc, #b71c1c);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; flex-shrink: 0;
    }
    .mc-body h3 { font-size: 1.05rem; font-weight: 700; color: #111; margin: 0 0 8px; }
    .mc-body p  { font-size: .85rem; color: #999; margin: 0; line-height: 1.65; }
    .mc-arrow {
        margin-top: auto;
        display: flex; align-items: center; gap: 7px;
        font-size: .84rem; font-weight: 700;
        color: var(--mc, #b71c1c);
    }
</style>
@endpush

@section('content')

    {{-- ══ HERO ══ --}}
    <div class="home-hero">
        <div class="hero-orb" style="width:560px;height:560px;top:-180px;right:-140px;"></div>
        <div class="hero-orb" style="width:320px;height:320px;bottom:-100px;left:-80px;animation-delay:4s;"></div>
        <div class="hero-orb" style="width:180px;height:180px;top:40%;left:8%;animation-delay:2s;"></div>
        <div class="hero-glow"></div>

        <div class="hero-content">
            <div class="hero-logo">
                <img src="{{ asset('frontend/img/pemkot.png') }}" alt="Logo Pemkot Semarang">
            </div>

            <div class="hero-eyebrow">
                <i class="fa fa-shield-alt"></i>
                Pemerintah Kota Semarang
            </div>

            <h1>Sistem Akuntabilitas<br><span>Kinerja Instansi</span><br>Pemerintah</h1>

            <p class="hero-subtitle">
                Platform digital terintegrasi untuk perencanaan, pengukuran, pelaporan,
                dan evaluasi kinerja seluruh instansi Pemerintah Kota Semarang.
            </p>

            <div class="hero-cta">
                <a href="{{ route('v2.perencanaan.index') }}" class="btn-hero-primary">
                    <i class="fa fa-folder-open"></i> Lihat Dokumen
                </a>
                <a href="{{ route('evaluasi_kinerja_realtime') }}" class="btn-hero-ghost">
                    <i class="fa fa-chart-line"></i> Evaluasi Realtime
                </a>
            </div>

            <button class="hero-scroll" onclick="document.getElementById('tentang').scrollIntoView({behavior:'smooth'})">
                <i class="fa fa-chevron-down"></i> Jelajahi
            </button>
        </div>
    </div>

    {{-- ══ TENTANG ══ --}}
    <div class="home-section bg-white" id="tentang">
        <div class="container">
            <div class="row" style="align-items:center;gap:24px 0;">
                <div class="col-md-5">
                    <span class="section-eyebrow">Tentang Sistem</span>
                    <h2 class="section-heading">Apa itu <span>E-SAKIP</span>?</h2>
                    <p class="section-lead">{!! $website->description !!}</p>
                    <a href="{{ route('portal') }}" target="_blank"
                       style="display:inline-flex;align-items:center;gap:9px;margin-top:24px;padding:13px 30px;background:#b71c1c;color:#fff;border-radius:50px;font-weight:700;font-size:.92rem;text-decoration:none;transition:background .2s;"
                       onmouseover="this.style.background='#8b0000'" onmouseout="this.style.background='#b71c1c'">
                        <i class="fa fa-sign-in-alt"></i> Masuk ke Portal
                    </a>
                </div>
                <div class="col-md-7">
                    <div class="feature-grid">
                        <a href="{{ route('v2.perencanaan.index') }}" class="feat-card" style="--fc-color:#b71c1c;--fc-bg:#fdecea;">
                            <div class="feat-icon"><i class="fa fa-file-alt"></i></div>
                            <div>
                                <h4>Perencanaan Kinerja</h4>
                                <p>RPJMD, RKPD, Renja, Perjanjian Kinerja</p>
                            </div>
                        </a>
                        <a href="{{ route('v2.pengukuran.index') }}" class="feat-card" style="--fc-color:#1565c0;--fc-bg:#e3f2fd;">
                            <div class="feat-icon"><i class="fa fa-chart-bar"></i></div>
                            <div>
                                <h4>Pengukuran Kinerja</h4>
                                <p>IKU, cascading kinerja, capaian target</p>
                            </div>
                        </a>
                        <a href="{{ route('v2.pelaporan.index') }}" class="feat-card" style="--fc-color:#2e7d32;--fc-bg:#e8f5e9;">
                            <div class="feat-icon"><i class="fa fa-clipboard-list"></i></div>
                            <div>
                                <h4>Pelaporan Kinerja</h4>
                                <p>LKjIP dan laporan kinerja tahunan OPD</p>
                            </div>
                        </a>
                        <a href="{{ route('evaluasi_kinerja_realtime') }}" class="feat-card" style="--fc-color:#6a1b9a;--fc-bg:#f3e5f5;">
                            <div class="feat-icon"><i class="fa fa-search-plus"></i></div>
                            <div>
                                <h4>Evaluasi Internal</h4>
                                <p>Nilai dan kategori AKIP seluruh OPD</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ SIKLUS SAKIP ══ --}}
    <div class="cycle-section">
        <div class="container">
            <div class="text-center">
                <span class="section-eyebrow">Siklus SAKIP</span>
                <h2 class="section-heading">Alur <span>Pelaporan Kinerja</span></h2>
                <p style="font-size:1rem;color:#888;margin-top:10px;">
                    Empat komponen yang membentuk sistem akuntabilitas kinerja terintegrasi
                </p>
            </div>
            <div class="cycle-wrap">
                <div class="cycle-step">
                    <div class="cycle-icon" style="background:#fdecea;color:#b71c1c;">
                        <i class="fa fa-file-alt"></i>
                        <span class="cycle-num" style="border-color:#b71c1c;color:#b71c1c;">1</span>
                    </div>
                    <h4>Perencanaan</h4>
                    <p>Penetapan sasaran &amp; strategi kinerja instansi</p>
                </div>
                <div class="cycle-arrow"><i class="fa fa-chevron-right"></i></div>
                <div class="cycle-step">
                    <div class="cycle-icon" style="background:#e3f2fd;color:#1565c0;">
                        <i class="fa fa-chart-bar"></i>
                        <span class="cycle-num" style="border-color:#1565c0;color:#1565c0;">2</span>
                    </div>
                    <h4>Pengukuran</h4>
                    <p>Pemantauan capaian kinerja secara berkala</p>
                </div>
                <div class="cycle-arrow"><i class="fa fa-chevron-right"></i></div>
                <div class="cycle-step">
                    <div class="cycle-icon" style="background:#e8f5e9;color:#2e7d32;">
                        <i class="fa fa-clipboard-list"></i>
                        <span class="cycle-num" style="border-color:#2e7d32;color:#2e7d32;">3</span>
                    </div>
                    <h4>Pelaporan</h4>
                    <p>Penyusunan laporan kinerja tahunan</p>
                </div>
                <div class="cycle-arrow"><i class="fa fa-chevron-right"></i></div>
                <div class="cycle-step">
                    <div class="cycle-icon" style="background:#f3e5f5;color:#6a1b9a;">
                        <i class="fa fa-search-plus"></i>
                        <span class="cycle-num" style="border-color:#6a1b9a;color:#6a1b9a;">4</span>
                    </div>
                    <h4>Evaluasi</h4>
                    <p>Penilaian akuntabilitas &amp; tindak lanjut</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ MENU CARDS ══ --}}
    <div class="menu-section">
        <div class="container">
            <div class="text-center">
                <span class="section-eyebrow">Menu Utama</span>
                <h2 class="section-heading">Layanan <span>Informasi</span></h2>
                <p style="font-size:1rem;color:#888;margin-top:10px;">
                    Akses seluruh data kinerja Pemerintah Kota Semarang secara terbuka
                </p>
            </div>
            <div class="menu-grid">
                <a href="{{ route('v2.perencanaan.index') }}" class="menu-card" style="--mc:#b71c1c;--mc-bg:#fdecea;">
                    <div class="mc-icon"><i class="fa fa-file-alt"></i></div>
                    <div class="mc-body">
                        <h3>Perencanaan Kinerja</h3>
                        <p>RPJMD, RKPD, Pohon Kinerja, Renja, dan dokumen perencanaan lainnya.</p>
                    </div>
                    <div class="mc-arrow">Lihat Dokumen <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('v2.pengukuran.index') }}" class="menu-card" style="--mc:#1565c0;--mc-bg:#e3f2fd;">
                    <div class="mc-icon"><i class="fa fa-chart-bar"></i></div>
                    <div class="mc-body">
                        <h3>Pengukuran Kinerja</h3>
                        <p>Data pengukuran dan capaian kinerja Kota maupun OPD secara berkala.</p>
                    </div>
                    <div class="mc-arrow">Lihat Dokumen <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('v2.pelaporan.index') }}" class="menu-card" style="--mc:#2e7d32;--mc-bg:#e8f5e9;">
                    <div class="mc-icon"><i class="fa fa-clipboard-list"></i></div>
                    <div class="mc-body">
                        <h3>Pelaporan Kinerja</h3>
                        <p>Laporan kinerja tahunan seluruh instansi pemerintah Kota Semarang.</p>
                    </div>
                    <div class="mc-arrow">Lihat Dokumen <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('evaluasi_kinerja_realtime') }}" class="menu-card" style="--mc:#6a1b9a;--mc-bg:#f3e5f5;">
                    <div class="mc-icon"><i class="fa fa-chart-line"></i></div>
                    <div class="mc-body">
                        <h3>Evaluasi Internal Realtime</h3>
                        <p>Hasil evaluasi AKIP terbaru secara real-time dari seluruh OPD.</p>
                    </div>
                    <div class="mc-arrow">Lihat Data <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('evaluasi_kinerja') }}" class="menu-card" style="--mc:#e65100;--mc-bg:#fff3e0;">
                    <div class="mc-icon"><i class="fa fa-history"></i></div>
                    <div class="mc-body">
                        <h3>Evaluasi Internal 2019&ndash;2023</h3>
                        <p>Rekap historis hasil evaluasi AKIP periode tahun 2019 hingga 2023.</p>
                    </div>
                    <div class="mc-arrow">Lihat Data <i class="fa fa-arrow-right"></i></div>
                </a>
                <a href="{{ route('portal') }}" target="_blank" class="menu-card" style="--mc:#37474f;--mc-bg:#eceff1;">
                    <div class="mc-icon"><i class="fa fa-sign-in-alt"></i></div>
                    <div class="mc-body">
                        <h3>Login Sistem</h3>
                        <p>Masuk ke portal E-SAKIP untuk mengelola data kinerja instansi Anda.</p>
                    </div>
                    <div class="mc-arrow">Buka Portal <i class="fa fa-external-link-alt"></i></div>
                </a>
            </div>
        </div>
    </div>

@endsection
