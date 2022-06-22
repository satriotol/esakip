<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Noble<span>UI</span>
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
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
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
                <div class="collapse {{ show_class(['perencanaan_kinerja_rpjmd.*', 'perencanaan_kinerja_rkpd.*']) }}"
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
            {{-- <li
                class="nav-item {{ active_class(['perencanaan_kinerja.index', 'perencanaan_kinerja.create', 'perencanaan_kinerja.edit']) }}">
                <a href="{{ route('perencanaan_kinerja.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Perencanaan Kinerja</span>
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
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
</nav>
