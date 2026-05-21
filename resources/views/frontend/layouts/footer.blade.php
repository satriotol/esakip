<style>
    .site-footer {
        background: #1a1a2e;
        color: rgba(255,255,255,.75);
        padding: 56px 0 0;
    }
    .footer-grid {
        display: grid;
        grid-template-columns: 1.8fr 1fr 1fr;
        gap: 40px;
        padding-bottom: 48px;
    }
    .footer-brand { display: flex; flex-direction: column; gap: 14px; }
    .footer-brand-row { display: flex; align-items: center; gap: 12px; }
    .footer-brand-row img { width: 44px; height: 44px; object-fit: contain; }
    .footer-brand-name { font-size: 1.1rem; font-weight: 800; color: #fff; }
    .footer-brand-sub  { font-size: .76rem; color: rgba(255,255,255,.5); }
    .footer-brand p { font-size: .84rem; line-height: 1.75; color: rgba(255,255,255,.6); margin: 0; }

    .footer-col h4 {
        font-size: .8rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .8px;
        color: #fff; margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 2px solid #b73333;
        display: inline-block;
    }
    .footer-links { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 10px; }
    .footer-links li a {
        color: rgba(255,255,255,.6);
        text-decoration: none;
        font-size: .84rem;
        transition: all .2s;
        display: flex; align-items: center; gap: 8px;
    }
    .footer-links li a:hover { color: #fff; padding-left: 4px; }
    .footer-links li a i { color: #b73333; width: 14px; font-size: .75rem; }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,.08);
        padding: 20px 0;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 10px;
    }
    .footer-bottom p { margin: 0; font-size: .8rem; color: rgba(255,255,255,.45); }
    .footer-bottom a { color: #b73333; text-decoration: none; }
    .footer-bottom a:hover { color: #fff; }
    .footer-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 50px;
        padding: 4px 14px;
        font-size: .75rem; color: rgba(255,255,255,.5);
    }
    .footer-badge i { color: #b73333; }

    @media (max-width: 768px) {
        .footer-grid { grid-template-columns: 1fr; gap: 28px; }
        .footer-bottom { flex-direction: column; text-align: center; }
    }
</style>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-brand-row">
                    <img src="{{ asset('frontend/img/pemkot.png') }}" alt="Logo Pemkot">
                    <div>
                        <div class="footer-brand-name">E-SAKIP</div>
                        <div class="footer-brand-sub">Kota Semarang</div>
                    </div>
                </div>
                <p>
                    Sistem Akuntabilitas Kinerja Instansi Pemerintah Secara Elektronik
                    Pemerintah Kota Semarang. Mendukung tata kelola pemerintahan yang
                    transparan, akuntabel, dan berorientasi hasil.
                </p>
            </div>

            <div class="footer-col">
                <h4>Menu Utama</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Beranda</a></li>
                    <li><a href="{{ route('v2.perencanaan.index') }}"><i class="fa fa-file-alt"></i> Perencanaan</a></li>
                    <li><a href="{{ route('v2.pengukuran.index') }}"><i class="fa fa-chart-bar"></i> Pengukuran</a></li>
                    <li><a href="{{ route('v2.pelaporan.index') }}"><i class="fa fa-clipboard-list"></i> Pelaporan</a></li>
                    <li><a href="{{ route('evaluasi_kinerja_realtime') }}"><i class="fa fa-chart-line"></i> Evaluasi Realtime</a></li>
                    <li><a href="{{ route('evaluasi_kinerja') }}"><i class="fa fa-history"></i> Evaluasi 2019&ndash;2023</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Tautan</h4>
                <ul class="footer-links">
                    <li>
                        <a href="https://www.semarangkota.go.id/" target="_blank">
                            <i class="fa fa-external-link-alt"></i> Pemkot Semarang
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('portal') }}" target="_blank">
                            <i class="fa fa-sign-in-alt"></i> Login Portal
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <a href="https://www.semarangkota.go.id/" target="_blank">Pemerintah Kota Semarang</a>. Seluruh hak dilindungi.</p>
            <div class="footer-badge">
                <i class="fa fa-shield-alt"></i> Sistem Terlindungi
            </div>
        </div>
    </div>
</footer>
