@extends('frontend.layouts.main')

@push('css')
<style>
    /* ══════════════════════════════════════════
       HERO
    ══════════════════════════════════════════ */
    .eval-hero {
        background: linear-gradient(140deg, #bf360c 0%, #b71c1c 55%, #880e4f 100%);
        margin-top: -76px;
        padding: 136px 0 100px;
        position: relative;
        overflow: hidden;
    }
    @media (max-width: 991px) {
        .eval-hero { margin-top: -68px; padding-top: 116px; }
    }
    .eval-hero::before,
    .eval-hero::after {
        content: ''; position: absolute; border-radius: 50%;
        background: rgba(255,255,255,.055); pointer-events: none;
    }
    .eval-hero::before { width: 480px; height: 480px; top: -160px; right: -80px; }
    .eval-hero::after  { width: 260px; height: 260px; bottom: -90px; left: -50px; }

    .eval-hero-inner { position: relative; z-index: 1; }

    .eval-breadcrumb {
        display: flex; align-items: center; gap: 8px;
        font-size: .82rem; font-weight: 500;
        color: rgba(255,255,255,.6);
        margin-bottom: 20px; flex-wrap: wrap;
    }
    .eval-breadcrumb a { color: rgba(255,255,255,.6); text-decoration: none; transition: color .2s; }
    .eval-breadcrumb a:hover { color: #fff; }
    .eval-breadcrumb .sep { font-size: .6rem; }

    .eval-hero h1 {
        font-size: clamp(1.9rem, 4vw, 2.8rem);
        font-weight: 800; color: #fff;
        margin-bottom: 10px;
        letter-spacing: -.5px; line-height: 1.15;
    }
    .eval-hero p {
        font-size: 1.05rem; color: rgba(255,255,255,.78);
        margin: 0 0 28px; line-height: 1.7;
    }
    .eval-hero-chips {
        display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
    }
    .hero-chip {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(255,255,255,.13);
        border: 1px solid rgba(255,255,255,.22);
        border-radius: 50px;
        padding: 6px 16px;
        font-size: .82rem; font-weight: 600; color: #fff;
    }

    /* ══════════════════════════════════════════
       MAIN AREA
    ══════════════════════════════════════════ */
    .eval-main {
        margin-top: -52px;
        padding-bottom: 72px;
        position: relative; z-index: 2;
    }

    /* ── Toolbar ─────────────────────────────── */
    .eval-toolbar {
        display: flex; align-items: center;
        justify-content: flex-end;
        margin-bottom: 20px;
    }
    .eval-search-wrap { position: relative; display: flex; align-items: center; }
    .eval-search-wrap .s-icon {
        position: absolute; left: 14px;
        color: #bbb; font-size: .85rem; pointer-events: none;
    }
    .eval-search {
        border: 1.5px solid #e8e8e8; border-radius: 50px;
        padding: 10px 18px 10px 40px;
        font-size: .9rem; font-family: 'Poppins', sans-serif;
        outline: none; width: 260px; color: #333;
        background: #fff;
        box-shadow: 0 2px 12px rgba(0,0,0,.07);
        transition: border-color .2s, box-shadow .2s;
    }
    .eval-search::placeholder { color: #bbb; }
    .eval-search:focus {
        border-color: #b71c1c;
        box-shadow: 0 0 0 3px rgba(183,28,28,.1);
    }
    @media (max-width: 480px) { .eval-search { width: 100%; } }

    /* ── Card ────────────────────────────────── */
    .eval-card {
        background: #fff; border-radius: 20px;
        box-shadow: 0 8px 48px rgba(0,0,0,.09); overflow: hidden;
    }
    .eval-card-header {
        padding: 22px 28px;
        background: #fafafa; border-bottom: 1px solid #f0f0f0;
        display: flex; align-items: center;
        justify-content: space-between; flex-wrap: wrap; gap: 12px;
    }
    .eval-card-title {
        font-size: 1.05rem; font-weight: 700; color: #1a1a1a;
        display: flex; align-items: center; gap: 10px; margin: 0;
    }
    .eval-card-title i { color: #b71c1c; }
    .eval-period-badge {
        font-size: .78rem; font-weight: 700;
        background: #fff3e0; color: #e65100;
        padding: 5px 16px; border-radius: 50px;
    }

    /* ── Legend ──────────────────────────────── */
    .eval-legend {
        padding: 14px 28px;
        border-bottom: 1px solid #f0f0f0;
        display: flex; align-items: center; gap: 10px;
        flex-wrap: wrap; background: #fff;
    }
    .legend-label { font-size: .8rem; font-weight: 600; color: #999; flex-shrink: 0; }
    .legend-chip {
        display: inline-flex; align-items: center;
        padding: 4px 14px; border-radius: 50px;
        font-size: .75rem; font-weight: 700;
    }

    /* ── Table ───────────────────────────────── */
    .eval-table-wrap { overflow-x: auto; }
    .eval-table {
        width: 100%; border-collapse: collapse;
        font-size: .88rem; min-width: 640px;
    }
    .eval-table thead tr:first-child th {
        background: #37474f; color: #fff;
        padding: 13px 14px; font-weight: 700;
        font-size: .78rem; text-transform: uppercase; letter-spacing: .4px;
        border: 1px solid rgba(255,255,255,.1);
    }
    .eval-table thead tr:nth-child(2) th {
        background: #b71c1c; color: #fff;
        padding: 10px 13px; font-weight: 700;
        font-size: .78rem; text-transform: uppercase;
        border: 1px solid rgba(255,255,255,.15);
    }
    .eval-table thead tr:nth-child(3) th {
        background: #f5f5f5; color: #888;
        padding: 9px 13px; font-weight: 700;
        font-size: .74rem; text-transform: uppercase; letter-spacing: .3px;
        border: 1px solid #eee;
    }
    .eval-table tbody td {
        padding: 12px 14px;
        border: 1px solid #f0f0f0;
        vertical-align: middle; text-align: center;
        font-size: .88rem;
    }
    .eval-table tbody tr:hover td:first-child,
    .eval-table tbody tr:hover td:nth-child(2) { background: #f5f5f5; }
    .eval-table tbody td:first-child {
        color: #aaa; font-size: .8rem;
        background: #fafafa; text-align: center;
        min-width: 42px;
    }
    .eval-table tbody td:nth-child(2) {
        font-weight: 600; color: #222; background: #fafafa;
        text-align: left; min-width: 200px;
    }

    /* ── Loading ─────────────────────────────── */
    .eval-loading {
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        padding: 88px 24px; gap: 18px;
    }
    .spinner-ring {
        width: 52px; height: 52px;
        border: 4px solid #f0f0f0;
        border-top-color: #b71c1c;
        border-radius: 50%;
        animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .spinner-text { font-size: .92rem; color: #bbb; font-weight: 500; }

    /* ── Empty / no-result ───────────────────── */
    .eval-empty {
        text-align: center; padding: 72px 24px;
    }
    .eval-empty-icon {
        width: 80px; height: 80px; border-radius: 50%;
        background: #fdecea;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; font-size: 2rem; color: #b71c1c;
    }
    .eval-empty h5 { font-size: 1rem; font-weight: 700; color: #333; margin-bottom: 8px; }
    .eval-empty p  { font-size: .9rem; color: #bbb; margin: 0; }

    /* ── Footer info ─────────────────────────── */
    .eval-footer-info {
        padding: 14px 28px;
        border-top: 1px solid #f0f0f0;
        font-size: .82rem; color: #bbb;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 8px;
    }
</style>
@endpush

@section('content')

    {{-- ══ HERO ══ --}}
    <div class="eval-hero text-white">
        <div class="container">
            <div class="eval-hero-inner">
                <div class="eval-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Beranda</a>
                    <span class="sep"><i class="fa fa-chevron-right"></i></span>
                    <span>Evaluasi Internal 2019&ndash;2023</span>
                </div>
                <h1><i class="fa fa-history" style="margin-right:12px;opacity:.85;"></i>Evaluasi Internal 2019&ndash;2023</h1>
                <p>Rekap historis hasil evaluasi AKIP seluruh OPD &mdash; Pemerintah Kota Semarang</p>
                <div class="eval-hero-chips">
                    <div class="hero-chip"><i class="fa fa-calendar-alt"></i> Periode 2019 &ndash; 2023</div>
                    <div class="hero-chip"><i class="fa fa-building"></i> Seluruh OPD</div>
                    <div class="hero-chip"><i class="fa fa-star"></i> Penilaian AKIP</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ KONTEN ══ --}}
    <div class="eval-main">
        <div class="container">
            <div id="app">

                {{-- Toolbar search --}}
                <div class="eval-toolbar" v-if="dataEvaluasiKinerjaAkip">
                    <div class="eval-search-wrap">
                        <i class="fa fa-search s-icon"></i>
                        <input
                            type="text"
                            v-model="searchOpd"
                            class="eval-search"
                            placeholder="Cari nama OPD&hellip;">
                    </div>
                </div>

                <div class="eval-card">
                    {{-- Header --}}
                    <div class="eval-card-header">
                        <h5 class="eval-card-title">
                            <i class="fa fa-table"></i>
                            Rekap Nilai AKIP per OPD
                        </h5>
                        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                            <span v-if="dataEvaluasiKinerjaAkip" style="font-size:.85rem;color:#aaa;">
                                @{{ filteredData.length }} OPD ditampilkan
                            </span>
                            <span class="eval-period-badge">Periode 2019 &ndash; 2023</span>
                        </div>
                    </div>

                    {{-- Legend --}}
                    <div class="eval-legend" v-if="categoryLegend.length">
                        <span class="legend-label">Keterangan:</span>
                        <span
                            v-for="cat in categoryLegend" :key="cat.name"
                            class="legend-chip"
                            :style="{ background: cat.color, color: cat.font }">
                            @{{ cat.name }}
                        </span>
                    </div>

                    {{-- Loading --}}
                    <div v-if="!dataEvaluasiKinerjaAkip" class="eval-loading">
                        <div class="spinner-ring"></div>
                        <span class="spinner-text">Memuat data evaluasi&hellip;</span>
                    </div>

                    {{-- Tabel --}}
                    <div v-else-if="filteredData.length > 0" class="eval-table-wrap">
                        <table class="eval-table">
                            <thead>
                                <tr>
                                    <th rowspan="3" style="text-align:center;width:42px;">No</th>
                                    <th rowspan="3" style="text-align:left;">OPD</th>
                                    <th v-for="data in dataYears" :key="data.year" colspan="2" class="text-center">
                                        @{{ data.year }}
                                    </th>
                                </tr>
                                <tr>
                                    <template v-for="data in dataYears">
                                        <th colspan="2" class="text-center">Hasil</th>
                                    </template>
                                </tr>
                                <tr>
                                    <template v-for="data in dataYears">
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Kategori</th>
                                    </template>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data, idx) in filteredData" :key="data.name">
                                    <td>@{{ idx + 1 }}</td>
                                    <td>@{{ data.name }}</td>
                                    <template v-for="(hasil, i) in data.hasil" :key="i">
                                        <td :style="{ background: hasil.category_color, color: hasil.category_font, fontWeight: '700' }">
                                            @{{ hasil.value || '&mdash;' }}
                                        </td>
                                        <td :style="{ background: hasil.category_color, color: hasil.category_font, fontWeight: '700' }">
                                            @{{ hasil.category_name || '&mdash;' }}
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- No result --}}
                    <div v-else class="eval-empty">
                        <div class="eval-empty-icon"><i class="fa fa-search"></i></div>
                        <h5>OPD Tidak Ditemukan</h5>
                        <p>Tidak ada OPD yang cocok dengan "<strong>@{{ searchOpd }}</strong>"</p>
                    </div>

                    {{-- Footer info --}}
                    <div class="eval-footer-info" v-if="dataEvaluasiKinerjaAkip">
                        <span><i class="fa fa-info-circle" style="margin-right:5px;"></i>Data bersumber dari sistem evaluasi internal Pemerintah Kota Semarang</span>
                        <span>Total @{{ dataEvaluasiKinerjaAkip.length }} OPD</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('script')
<script>
    const { createApp } = Vue;
    const API_URL = "{{ env('API_URL') }}";

    createApp({
        data() {
            return {
                dataEvaluasiKinerjaAkip: null,
                dataYears: [],
                searchOpd: '',
            };
        },
        computed: {
            filteredData() {
                if (!this.dataEvaluasiKinerjaAkip) return [];
                if (!this.searchOpd.trim()) return this.dataEvaluasiKinerjaAkip;
                const q = this.searchOpd.toLowerCase();
                return this.dataEvaluasiKinerjaAkip.filter(d => d.name.toLowerCase().includes(q));
            },
            categoryLegend() {
                if (!this.dataEvaluasiKinerjaAkip) return [];
                const seen = new Map();
                this.dataEvaluasiKinerjaAkip.forEach(opd => {
                    opd.hasil.forEach(h => {
                        if (h.category_name && !seen.has(h.category_name)) {
                            seen.set(h.category_name, {
                                name: h.category_name,
                                color: h.category_color,
                                font: h.category_font,
                            });
                        }
                    });
                });
                return Array.from(seen.values());
            },
        },
        mounted() {
            axios.get(API_URL + 'evaluasi_kinerja_akip')
                .then(res => {
                    this.dataEvaluasiKinerjaAkip = res.data.EvaluasiKinerjaAkip;
                    this.dataYears = res.data.years;
                })
                .catch(err => console.error(err));
        }
    }).mount('#app');
</script>
@endpush
