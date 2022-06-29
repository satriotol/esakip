<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            e-SAKIP
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['dashboard']) }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['website.*']) }}">
                <a href="{{ route('website.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Website</span>
                </a>
            </li>
            <li class="nav-item nav-category">Perencanaan Kinerja</li>
            <li
                class="nav-item {{ active_class(['perencanaan_kinerja_rpjmd.*', 'perencanaan_kinerja_rkpd.*', 'cascading_kinerja.*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#perencanaan_kinerja" role="button"
                    aria-expanded="{{ is_active_route(['perencanaan_kinerja_rpjmd.*', 'perencanaan_kinerja_rkpd.*', 'cascading_kinerja.*']) }}"
                    aria-controls="perencanaan_kinerja">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Kota</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['perencanaan_kinerja_rpjmd.*', 'perencanaan_kinerja_rkpd.*', 'cascading_kinerja.*']) }}"
                    id="perencanaan_kinerja">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('perencanaan_kinerja_rpjmd.index') }}"
                                class="nav-link {{ active_class(['perencanaan_kinerja_rpjmd.*']) }}">RPJMD</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('perencanaan_kinerja_rkpd.index') }}"
                                class="nav-link {{ active_class(['perencanaan_kinerja_rkpd.*']) }}">RKPD</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cascading_kinerja.index') }}"
                                class="nav-link {{ active_class(['cascading_kinerja.*']) }}">CASCADING KINERJA</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li
                class="nav-item {{ active_class(['periodeRenstraOpd.*', 'renstraOpd.*', 'rktOpd.*', 'renjaOpd.*', 'cascadingKinerjaOpd.*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#perencanaan_kinerja_opd" role="button"
                    aria-expanded="{{ is_active_route(['periodeRenstraOpd.*', 'renstraOpd.*', 'rktOpd.*', 'renjaOpd.*', 'cascadingKinerjaOpd.*']) }}"
                    aria-controls="perencanaan_kinerja_opd">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">OPD</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['periodeRenstraOpd.*', 'renstraOpd.*', 'rktOpd.*', 'renjaOpd.*', 'cascadingKinerjaOpd.*']) }}"
                    id="perencanaan_kinerja_opd">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('periodeRenstraOpd.index') }}"
                                class="nav-link {{ active_class(['periodeRenstraOpd.*', 'renstraOpd.*']) }}">RENSTRA</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rktOpd.index') }}"
                                class="nav-link {{ active_class(['rktOpd.*']) }}">RKT</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('renjaOpd.index') }}"
                                class="nav-link {{ active_class(['renjaOpd.*']) }}">RENJA</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cascadingKinerjaOpd.index') }}"
                                class="nav-link {{ active_class(['cascadingKinerjaOpd.*']) }}">CASCADING KINERJA</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Pengukuran Kinerja</li>
            <li class="nav-item {{ active_class(['ikuKota.*', 'kotaPerjanjianKinerja.*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#perancangan_kinerja" role="button"
                    aria-expanded="{{ is_active_route(['ikuKota.*', 'kotaPerjanjianKinerja.*']) }}"
                    aria-controls="perancangan_kinerja">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Kota</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['ikuKota.*', 'kotaPerjanjianKinerja.*']) }}"
                    id="perancangan_kinerja">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('ikuKota.index') }}"
                                class="nav-link {{ active_class(['ikuKota.*']) }}">IKU</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kotaPerjanjianKinerja.index') }}"
                                class="nav-link {{ active_class(['kotaPerjanjianKinerja.*']) }}">PERJANJIAN
                                KINERJA</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['ikuOpd.*', 'opdPerjanjianKinerja.*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#perancangan_kinerja_opd" role="button"
                    aria-expanded="{{ is_active_route(['ikuOpd.*', 'opdPerjanjianKinerja.*']) }}"
                    aria-controls="perancangan_kinerja_opd">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">OPD</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['ikuOpd.*', 'opdPerjanjianKinerja.*']) }}"
                    id="perancangan_kinerja_opd">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('ikuOpd.index') }}"
                                class="nav-link {{ active_class(['ikuOpd.*']) }}">IKU</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('opdPerjanjianKinerja.index') }}"
                                class="nav-link {{ active_class(['opdPerjanjianKinerja.*']) }}">PERJANJIAN
                                KINERJA</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Pelaporan Kinerja</li>
            <li class="nav-item {{ active_class(['lkjip_kota.*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#pelaporan_kinerja" role="button"
                    aria-expanded="{{ is_active_route(['lkjip_kota.*']) }}" aria-controls="pelaporan_kinerja">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Kota</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['lkjip_kota.*']) }}" id="pelaporan_kinerja">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('lkjip_kota.index') }}"
                                class="nav-link {{ active_class(['lkjip_kota.*']) }}">LKJIP</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['lkjip_opd.*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#pelaporan_kinerja_opd" role="button"
                    aria-expanded="{{ is_active_route(['lkjip_opd.*']) }}" aria-controls="pelaporan_kinerja_opd">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">OPD</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['lkjip_opd.*']) }}" id="pelaporan_kinerja_opd">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('lkjip_opd.index') }}"
                                class="nav-link {{ active_class(['lkjip_opd.*']) }}">LKJIP</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Capaian Kinerja</li>
            <li class="nav-item {{ active_class(['link.*']) }}">
                <a href="{{ route('link.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Link Terkait</span>
                </a>
            </li>
            <li class="nav-item nav-category">Evaluasi Kinerja</li>
            <li class="nav-item {{ active_class(['evaluasiKinerjaYear.*', 'evaluasiKinerja.*']) }}">
                <a href="{{ route('evaluasiKinerjaYear.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Evaluasi Kinerja</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
{{-- <nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                        value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                        value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Version:</h6>
            <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
                <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
            </a>
            <h6 class="text-muted mb-2">Dark Version:</h6>
            <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
                <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
            </a>
        </div>
    </div>
</nav> --}}
