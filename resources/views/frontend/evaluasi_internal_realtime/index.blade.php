@extends('frontend.layouts.main')

@push('css')
<style>
    /* ══════════════════════════════════════════
       HERO
    ══════════════════════════════════════════ */
    .eval-hero {
        background: linear-gradient(140deg, #4a0072 0%, #6a1b9a 45%, #b71c1c 100%);
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
    .hero-chip.live {
        background: rgba(76,175,80,.25);
        border-color: rgba(76,175,80,.5);
        animation: pulse-live 2s infinite;
    }
    @keyframes pulse-live {
        0%,100% { box-shadow: 0 0 0 0 rgba(76,175,80,.4); }
        50%      { box-shadow: 0 0 0 6px rgba(76,175,80,0); }
    }
    .live-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: #4caf50; flex-shrink: 0;
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
        border-color: #6a1b9a;
        box-shadow: 0 0 0 3px rgba(106,27,154,.1);
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
    .eval-card-title i { color: #6a1b9a; }
    .eval-live-badge {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: .78rem; font-weight: 700;
        background: #e8f5e9; color: #2e7d32;
        padding: 5px 14px; border-radius: 50px;
    }
    .live-dot-sm {
        width: 7px; height: 7px; border-radius: 50%;
        background: #4caf50; flex-shrink: 0;
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
        font-size: .88rem; min-width: 750px;
    }
    .eval-table thead tr:first-child th {
        background: #37474f; color: #fff;
        padding: 13px 14px; font-weight: 700;
        font-size: .78rem; text-transform: uppercase; letter-spacing: .4px;
        border: 1px solid rgba(255,255,255,.1);
    }
    .eval-table thead tr:nth-child(2) th {
        background: #6a1b9a; color: #fff;
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
        padding: 11px 13px;
        border: 1px solid #f0f0f0;
        vertical-align: middle; text-align: center;
        font-size: .88rem;
    }
    .eval-table tbody td:first-child {
        color: #aaa; font-size: .8rem;
        background: #fafafa; min-width: 42px;
    }
    .eval-table tbody td:nth-child(2) {
        font-weight: 600; color: #222; background: #fafafa;
        text-align: left; min-width: 200px;
    }
    .eval-table tbody tr:hover td:first-child,
    .eval-table tbody tr:hover td:nth-child(2) { background: #f0f0f0; }

    .doc-btn {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 12px; border-radius: 7px;
        font-size: .75rem; font-weight: 700;
        text-decoration: none; white-space: nowrap;
        transition: all .2s; font-family: 'Poppins', sans-serif;
    }
    .doc-btn.available { background: #e8f5e9; color: #2e7d32; }
    .doc-btn.available:hover { background: #2e7d32; color: #fff; }
    .doc-btn.missing { background: #f5f5f5; color: #bbb; cursor: default; pointer-events: none; }

    /* ── Loading ─────────────────────────────── */
    .eval-loading {
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        padding: 88px 24px; gap: 18px;
    }
    .spinner-ring {
        width: 52px; height: 52px;
        border: 4px solid #f0f0f0;
        border-top-color: #6a1b9a;
        border-radius: 50%;
        animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .spinner-text { font-size: .92rem; color: #bbb; font-weight: 500; }

    /* ── Empty ───────────────────────────────── */
    .eval-empty { text-align: center; padding: 72px 24px; }
    .eval-empty-icon {
        width: 80px; height: 80px; border-radius: 50%;
        background: #f3e5f5;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; font-size: 2rem; color: #6a1b9a;
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
                    <span>Evaluasi Internal Realtime</span>
                </div>
                <h1><i class="fa fa-chart-line" style="margin-right:12px;opacity:.85;"></i>Evaluasi Internal Realtime</h1>
                <p>Hasil evaluasi AKIP terkini seluruh OPD &mdash; Pemerintah Kota Semarang</p>
                <div class="eval-hero-chips">
                    <div class="hero-chip live">
                        <span class="live-dot"></span> Data Terkini
                    </div>
                    <div class="hero-chip"><i class="fa fa-building"></i> Seluruh OPD</div>
                    <div class="hero-chip"><i class="fa fa-file-pdf"></i> Dokumen LHE &amp; TLHE</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ KONTEN ══ --}}
    <div class="eval-main">
        <div class="container">
            <div id="app">

                {{-- Toolbar --}}
                <div class="eval-toolbar" v-if="!loading">
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
                            <span v-if="!loading" style="font-size:.85rem;color:#aaa;">
                                @{{ filteredOpds.length }} OPD ditampilkan
                            </span>
                            <span class="eval-live-badge">
                                <span class="live-dot-sm"></span> Data Terkini
                            </span>
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
                    <div v-if="loading" class="eval-loading">
                        <div class="spinner-ring"></div>
                        <span class="spinner-text">Memuat data evaluasi&hellip;</span>
                    </div>

                    {{-- Tabel --}}
                    <div v-else-if="filteredOpds.length > 0" class="eval-table-wrap">
                        <table class="eval-table">
                            <thead>
                                <tr>
                                    <th rowspan="3" style="text-align:center;width:42px;">No</th>
                                    <th rowspan="3" style="text-align:left;min-width:200px;">OPD</th>
                                    <th v-for="year in dataYears" :key="year" colspan="3" class="text-center">
                                        @{{ year }}
                                    </th>
                                </tr>
                                <tr>
                                    <template v-for="year in dataYears">
                                        <th colspan="3" class="text-center">Hasil Evaluasi</th>
                                    </template>
                                </tr>
                                <tr>
                                    <template v-for="year in dataYears">
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Dokumen</th>
                                    </template>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(opd, idx) in filteredOpds" :key="opd.id">
                                    <td>@{{ idx + 1 }}</td>
                                    <td>@{{ opd.nama_opd }}</td>
                                    <template v-for="year in dataYears">
                                        <template v-if="getScore(opd.id, year)">
                                            <td class="text-center" :style="{ background: getScore(opd.id, year).warnaScore.color, color: getScore(opd.id, year).warnaScore.font_color, fontWeight: '700' }">
                                                @{{ getScore(opd.id, year).totalScore }}
                                            </td>
                                            <td class="text-center" :style="{ background: getScore(opd.id, year).warnaScore.color, color: getScore(opd.id, year).warnaScore.font_color, fontWeight: '700' }">
                                                @{{ getScore(opd.id, year).nilaiKarakter }}
                                            </td>
                                            <td class="text-center" :style="{ background: getScore(opd.id, year).warnaScore.color }">
                                                <div style="display:flex;gap:5px;justify-content:center;flex-wrap:wrap;">
                                                    <a target="_blank"
                                                        :href="getScore(opd.id, year).lhe_file ? getScore(opd.id, year).lhe_file_url : '#'"
                                                        :class="getScore(opd.id, year).lhe_file ? 'doc-btn available' : 'doc-btn missing'">
                                                        <i class="fa fa-file-pdf"></i> LHE
                                                    </a>
                                                    <a target="_blank"
                                                        :href="getScore(opd.id, year).tlhe_file ? getScore(opd.id, year).tlhe_file_url : '#'"
                                                        :class="getScore(opd.id, year).tlhe_file ? 'doc-btn available' : 'doc-btn missing'">
                                                        <i class="fa fa-file-pdf"></i> TLHE
                                                    </a>
                                                </div>
                                            </td>
                                        </template>
                                        <template v-else>
                                            <td style="color:#ddd;">—</td>
                                            <td style="color:#ddd;">—</td>
                                            <td style="color:#ddd;">—</td>
                                        </template>
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

                    {{-- Footer --}}
                    <div class="eval-footer-info" v-if="!loading">
                        <span><i class="fa fa-info-circle" style="margin-right:5px;"></i>Data bersumber dari sistem penilaian AKIP Pemerintah Kota Semarang</span>
                        <span>Total @{{ opds.length }} OPD</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                opds: [], dataYears: [], scores: {},
                loading: true,
                searchOpd: '',
            };
        },
        computed: {
            filteredOpds() {
                if (!this.searchOpd.trim()) return this.opds;
                const q = this.searchOpd.toLowerCase();
                return this.opds.filter(o => o.nama_opd.toLowerCase().includes(q));
            },
            categoryLegend() {
                const seen = new Map();
                Object.values(this.scores).forEach(yearScores => {
                    yearScores.forEach(s => {
                        if (s.nilaiKarakter && !seen.has(s.nilaiKarakter) && s.warnaScore) {
                            seen.set(s.nilaiKarakter, {
                                name: s.nilaiKarakter,
                                color: s.warnaScore.color,
                                font: s.warnaScore.font_color,
                            });
                        }
                    });
                });
                return Array.from(seen.values());
            },
        },
        mounted() {
            this.loadData();
        },
        methods: {
            loadData() {
                this.loading = true;
                axios.get("https://penilaian.e-sakip.semarangkota.go.id/api/v1/score")
                    .then(res => {
                        this.opds      = res.data.data.opds;
                        this.dataYears = res.data.data.years;
                        this.scores    = res.data.data.scores;
                    })
                    .catch(() => {
                        Swal.fire({ icon: 'error', title: 'Gagal Memuat', text: 'Terjadi kesalahan saat mengambil data evaluasi.' });
                    })
                    .finally(() => this.loading = false);
            },
            getScore(opdId, year) {
                if (!this.scores[year]) return null;
                return this.scores[year].find(s => s.opd_id === opdId.toString()) || null;
            }
        }
    }).mount('#app');
</script>
@endpush
