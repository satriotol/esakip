<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            E-SAKIP
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
            @can('website-list')
                <li class="nav-item {{ active_class(['website.*']) }}">
                    <a href="{{ route('website.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="globe"></i>
                        <span class="link-title">Website</span>
                    </a>
                </li>
            @endcan
            @can('perencanaanKinerja')
                <li class="nav-item nav-category">Perencanaan Kinerja</li>
            @endcan
            @can('kotaPerencanaanKinerja')
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
                            @can('kotaRpjmd-list')
                                <li class="nav-item">
                                    <a href="{{ route('perencanaan_kinerja_rpjmd.index') }}"
                                        class="nav-link {{ active_class(['perencanaan_kinerja_rpjmd.*']) }}">RPJMD</a>
                                </li>
                            @endcan
                            @can('kotaRkpd-list')
                                <li class="nav-item">
                                    <a href="{{ route('perencanaan_kinerja_rkpd.index') }}"
                                        class="nav-link {{ active_class(['perencanaan_kinerja_rkpd.*']) }}">RKPD</a>
                                </li>
                            @endcan
                            @can('kotaCascadingKinerja-list')
                                <li class="nav-item">
                                    <a href="{{ route('cascading_kinerja.index') }}"
                                        class="nav-link {{ active_class(['cascading_kinerja.*']) }}">POHON KINERJA</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('opdPerencanaanKinerja')
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
                            @can('opdPeriodRenstra-list')
                                <li class="nav-item">
                                    <a href="{{ route('periodeRenstraOpd.index') }}"
                                        class="nav-link {{ active_class(['periodeRenstraOpd.*', 'renstraOpd.*']) }}">RENSTRA</a>
                                </li>
                            @endcan
                            @can('opdRkt-list')
                                <li class="nav-item">
                                    <a href="{{ route('rktOpd.index') }}"
                                        class="nav-link {{ active_class(['rktOpd.*']) }}">RKT</a>
                                </li>
                            @endcan
                            @can('opdRenja-list')
                                <li class="nav-item">
                                    <a href="{{ route('renjaOpd.index') }}"
                                        class="nav-link {{ active_class(['renjaOpd.*']) }}">RENJA</a>
                                </li>
                            @endcan
                            @can('opdCascadingKinerja-list')
                                <li class="nav-item">
                                    <a href="{{ route('cascadingKinerjaOpd.index') }}"
                                        class="nav-link {{ active_class(['cascadingKinerjaOpd.*']) }}">POHON KINERJA</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('pengukuranKinerja')
                <li class="nav-item nav-category">Pengukuran Kinerja</li>
            @endcan
            @can('kotaPengukuranKinerja')
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
                            @can('kotaIku-list')
                                <li class="nav-item">
                                    <a href="{{ route('ikuKota.index') }}"
                                        class="nav-link {{ active_class(['ikuKota.*']) }}">IKU</a>
                                </li>
                            @endcan
                            @can('kotaPerjanjianKinerja-list')
                                <li class="nav-item">
                                    <a href="{{ route('kotaPerjanjianKinerja.index') }}"
                                        class="nav-link {{ active_class(['kotaPerjanjianKinerja.*']) }}">PERJANJIAN
                                        KINERJA</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('opdIku-list')
                <li class="nav-item {{ active_class(['ikuOpd.*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#perancangan_kinerja_opd" role="button"
                        aria-expanded="{{ is_active_route(['ikuOpd.*']) }}" aria-controls="perancangan_kinerja_opd">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">OPD</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['ikuOpd.*']) }}" id="perancangan_kinerja_opd">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('ikuOpd.index') }}"
                                    class="nav-link {{ active_class(['ikuOpd.*']) }}">IKU</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('pelaporanKinerja')
                <li class="nav-item nav-category">Pelaporan Kinerja</li>
            @endcan
            @can('kotaLkjip-list')
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
            @endcan
            @can('opdLkjip-list')
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
            @endcan
            @can('link-list')
                <li class="nav-item nav-category">Capaian Kinerja</li>
                <li class="nav-item {{ active_class(['link.*']) }}">
                    <a href="{{ route('link.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Link Terkait</span>
                    </a>
                </li>
            @endcan
            @can('evaluasiKinerjaYear-list')
                <li class="nav-item nav-category">Evaluasi Kinerja</li>
                <li class="nav-item {{ active_class(['evaluasiKinerjaYear.*', 'evaluasiKinerja.*']) }}">
                    <a href="{{ route('evaluasiKinerjaYear.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Evaluasi Kinerja</span>
                    </a>
                </li>
            @endcan
            @can('opdPerjanjianKinerja-list')
                <li class="nav-item nav-category">Perjanjian Kinerja</li>
                <li
                    class="nav-item {{ active_class(['opdPerjanjianKinerja.*', 'opdPerjanjianKinerjaSasaran.*', 'opdPerjanjianKinerjaIndikator.*']) }}">
                    <a href="{{ route('opdPerjanjianKinerja.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="award"></i>
                        <span class="link-title">Perjanjian Kinerja</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ active_class(['rencanaAksi.*', 'rencanaAksiSasaran.*', 'rencanaAksiIndikator.*', 'rencanaAksiTarget.*']) }}">
                    <a href="{{ route('rencanaAksi.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="award"></i>
                        <span class="link-title">Rencana Aksi</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item nav-category">OPD</li>
            @can('opd-list')
                <li class="nav-item {{ active_class(['opds.*']) }}">
                    <a href="{{ route('opds.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Master OPD</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['userOpd.*']) }}">
                    <a href="{{ route('userOpd.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">User OPD</span>
                    </a>
                </li>
            @endcan
            @can('inovasiPrestasiOpd-list')
                <li class="nav-item {{ active_class(['inovasiPrestasiOpd.*']) }}">
                    <a href="{{ route('inovasiPrestasiOpd.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Inovasi Prestasi</span>
                    </a>
                </li>
            @endcan
            @can('opdPenilaian-list')
                <li class="nav-item {{ active_class(['opdPenilaian.*']) }}">
                    <a href="{{ route('opdPenilaian.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="bar-chart"></i>
                        <span class="link-title">Penilaian OPD</span>
                    </a>
                </li>
            @endcan
            @can('opdCategory-list')
                <li class="nav-item {{ active_class(['opdCategory.*']) }}">
                    <a href="{{ route('opdCategory.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="battery"></i>
                        <span class="link-title">Kategori OPD</span>
                    </a>
                </li>
            @endcan
            @can('opdVariable-list')
                <li class="nav-item {{ active_class(['opdVariable.*']) }}">
                    <a href="{{ route('opdVariable.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">Variable OPD</span>
                    </a>
                </li>
            @endcan
            @can('user-list')
                <li class="nav-item nav-category">Setting</li>
                <li class="nav-item {{ active_class(['user.*', 'role']) }}">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">User</span>
                    </a>
                </li>
            @endcan
            @can('role-list')
                <li class="nav-item {{ active_class(['role.*']) }}">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="unlock"></i>
                        <span class="link-title">Role</span>
                    </a>
                </li>
            @endcan
            @can('role-list')
                <li class="nav-item {{ active_class(['master.*']) }}">
                    <a href="{{ route('master.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="unlock"></i>
                        <span class="link-title">Master</span>
                    </a>
                </li>
            @endcan
            @can('permission-list')
                <li class="nav-item {{ active_class(['permission.*']) }}">
                    <a href="{{ route('permission.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="unlock"></i>
                        <span class="link-title">Permission</span>
                    </a>
                </li>
            @endcan
            @can('error-list')
                <li class="nav-item {{ active_class(['error.*']) }}">
                    <a href="{{ route('error.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="unlock"></i>
                        <span class="link-title">Error</span>
                    </a>
                </li>
            @endcan
            @can('audit-list')
                <li class="nav-item {{ active_class(['audit.*']) }}">
                    <a href="{{ route('audit.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="unlock"></i>
                        <span class="link-title">Audit</span>
                    </a>
                </li>
            @endcan
            @can('log-list')
                <li class="nav-item {{ active_class(['log.*']) }}">
                    <a href="{{ route('log.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="unlock"></i>
                        <span class="link-title">Log</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#perencanaan_kinerja" role="button"
                    aria-controls="perencanaan_kinerja">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Manual Book</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="perencanaan_kinerja">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ asset('manual/E-SAKIP KOTA SEMARANG.pdf') }}" target="_blank"
                                class="nav-link">Input
                                Perjanjian Kinerja</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
