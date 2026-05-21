@extends('frontend.layouts.main')

@push('css')
<style>
    /* ══════════════════════════════════════════
       HERO
    ══════════════════════════════════════════ */
    .doc-hero {
        background: linear-gradient(140deg, #4a0072 0%, #b71c1c 55%, #e65100 100%);
        margin-top: -76px;
        padding: 136px 0 104px;
        position: relative;
        overflow: hidden;
    }
    @media (max-width: 991px) {
        .doc-hero { margin-top: -68px; padding-top: 116px; }
    }
    .doc-hero::before,
    .doc-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        pointer-events: none;
    }
    .doc-hero::before { width: 500px; height: 500px; top: -160px; right: -90px; }
    .doc-hero::after  { width: 300px; height: 300px; bottom: -100px; left: -60px; }

    .doc-hero-inner { position: relative; z-index: 1; }

    .doc-breadcrumb {
        display: flex; align-items: center; gap: 8px;
        font-size: .82rem; font-weight: 500;
        color: rgba(255,255,255,.6);
        margin-bottom: 20px; flex-wrap: wrap;
    }
    .doc-breadcrumb a { color: rgba(255,255,255,.6); text-decoration: none; transition: color .2s; }
    .doc-breadcrumb a:hover { color: #fff; }
    .doc-breadcrumb .sep { font-size: .6rem; }

    .doc-hero h1 {
        font-size: clamp(1.9rem, 4vw, 2.8rem);
        font-weight: 800; color: #fff;
        margin-bottom: 10px; letter-spacing: -.5px; line-height: 1.15;
    }
    .doc-hero p {
        font-size: 1.05rem; color: rgba(255,255,255,.78);
        margin: 0 0 28px; line-height: 1.7;
    }
    .doc-hero-chips { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .hero-chip {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(255,255,255,.13);
        border: 1px solid rgba(255,255,255,.22);
        border-radius: 50px; padding: 6px 16px;
        font-size: .82rem; font-weight: 600; color: #fff;
    }

    /* ══════════════════════════════════════════
       MAIN AREA
    ══════════════════════════════════════════ */
    .doc-main {
        margin-top: -56px;
        padding-bottom: 72px;
        position: relative; z-index: 2;
    }

    /* ── Toolbar ─────────────────────────────── */
    .doc-toolbar {
        display: flex; align-items: center;
        justify-content: space-between;
        flex-wrap: wrap; gap: 14px;
        margin-bottom: 24px;
    }
    .type-toggle {
        display: inline-flex;
        background: #fff; border-radius: 50px;
        padding: 5px; gap: 4px;
        box-shadow: 0 2px 12px rgba(0,0,0,.1);
    }
    .type-toggle button {
        border: none; background: transparent;
        border-radius: 50px; padding: 10px 32px;
        font-weight: 700; font-size: .92rem;
        color: #666; cursor: pointer; transition: all .25s;
        display: flex; align-items: center; gap: 8px;
        font-family: 'Poppins', sans-serif;
    }
    .type-toggle button.active {
        background: #b71c1c; color: #fff;
        box-shadow: 0 4px 16px rgba(183,28,28,.35);
    }
    .type-toggle button:not(.active):hover { background: #f5f5f5; color: #333; }

    /* ── Filter selects ─────────────────────── */
    .doc-filters { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
    .doc-filter-wrap { position: relative; display: flex; align-items: center; }
    .doc-filter-wrap .f-icon {
        position: absolute; left: 14px;
        color: #bbb; font-size: .82rem;
        pointer-events: none; z-index: 1;
    }
    .doc-select {
        border: 1.5px solid #e8e8e8; border-radius: 50px;
        padding: 10px 42px 10px 40px;
        font-size: .88rem; font-family: 'Poppins', sans-serif;
        outline: none; min-width: 200px;
        color: #333; background: #fff;
        box-shadow: 0 2px 12px rgba(0,0,0,.07);
        transition: border-color .2s, box-shadow .2s;
        cursor: pointer; -webkit-appearance: none; appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M5 6L0 0h10z' fill='%23aaa'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 14px center;
    }
    .doc-select:focus { border-color: #b71c1c; box-shadow: 0 0 0 3px rgba(183,28,28,.1); }
    .doc-select:disabled { opacity: .55; cursor: not-allowed; }
    @media (max-width: 600px) { .doc-select { min-width: 100%; } }

    /* ══════════════════════════════════════════
       CARD
    ══════════════════════════════════════════ */
    .doc-card {
        background: #fff; border-radius: 20px;
        box-shadow: 0 8px 48px rgba(0,0,0,.09); overflow: hidden;
    }

    /* ── Tabs ────────────────────────────────── */
    .doc-tabs {
        display: flex; flex-wrap: wrap; gap: 10px;
        padding: 22px 28px; border-bottom: 1px solid #f0f0f0;
        background: #fafafa; align-items: center;
    }
    .doc-tab-btn {
        border: 2px solid #e8e8e8; background: #fff;
        border-radius: 50px; padding: 9px 24px;
        font-weight: 600; font-size: .88rem; color: #555;
        cursor: pointer; transition: all .2s;
        display: flex; align-items: center; gap: 9px;
        font-family: 'Poppins', sans-serif;
    }
    .tab-badge {
        background: #eee; color: #999; border-radius: 50px;
        padding: 1px 9px; font-size: .72rem; font-weight: 700; transition: all .2s;
    }
    .doc-tab-btn.active { background: #b71c1c; border-color: #b71c1c; color: #fff; box-shadow: 0 4px 16px rgba(183,28,28,.28); }
    .doc-tab-btn.active .tab-badge { background: rgba(255,255,255,.22); color: #fff; }
    .doc-tab-btn:not(.active):hover { border-color: #b71c1c; color: #b71c1c; }

    /* ── Table area ──────────────────────────── */
    .doc-table-area { padding: 28px 32px; }
    @media (max-width: 767px) { .doc-table-area { padding: 20px 16px; } }

    .doc-table-header {
        display: flex; align-items: center;
        justify-content: space-between;
        margin-bottom: 20px; flex-wrap: wrap; gap: 12px;
    }
    .doc-table-title {
        font-size: 1.05rem; font-weight: 700; color: #1a1a1a;
        margin: 0; display: flex; align-items: center; gap: 10px;
    }
    .doc-table-title i { color: #b71c1c; }
    .badge-scope {
        font-size: .72rem; font-weight: 700; padding: 4px 14px;
        border-radius: 50px; background: #fdecea; color: #b71c1c;
    }
    .doc-total { font-size: .88rem; color: #aaa; }

    /* ── Table ───────────────────────────────── */
    .doc-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .doc-table thead th {
        background: #f8f8f8; font-size: .78rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .6px;
        color: #aaa; padding: 13px 18px; border-bottom: 2px solid #efefef;
    }
    .doc-table thead th:first-child { border-radius: 8px 0 0 0; }
    .doc-table thead th:last-child  { border-radius: 0 8px 0 0; }
    .doc-table tbody tr { transition: background .15s; }
    .doc-table tbody tr:hover { background: #fffafa; }
    .doc-table tbody td {
        padding: 15px 18px; border-bottom: 1px solid #f5f5f5;
        font-size: .92rem; color: #444; vertical-align: middle;
    }
    .doc-table tbody tr:last-child td { border-bottom: none; }

    .year-pill {
        display: inline-block; background: #eef2ff; color: #3b5bdb;
        font-weight: 700; font-size: .82rem; padding: 4px 14px; border-radius: 50px;
    }
    .row-num { color: #ccc; font-size: .82rem; }

    .btn-act {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 16px; border-radius: 9px;
        font-size: .82rem; font-weight: 600; text-decoration: none;
        transition: all .2s; border: none; cursor: pointer;
        white-space: nowrap; font-family: 'Poppins', sans-serif;
    }
    .btn-act.view     { background: #e8f5e9; color: #2e7d32; }
    .btn-act.view:hover     { background: #2e7d32; color: #fff; }
    .btn-act.download { background: #fdecea; color: #b71c1c; }
    .btn-act.download:hover { background: #b71c1c; color: #fff; }

    /* ── Skeleton ────────────────────────────── */
    .skel {
        height: 14px; border-radius: 7px;
        background: linear-gradient(90deg,#f2f2f2 25%,#e8e8e8 50%,#f2f2f2 75%);
        background-size: 200% 100%; animation: shimmer 1.4s infinite;
    }
    @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

    /* ── Pagination ──────────────────────────── */
    .doc-pagination {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 20px; border-top: 1px solid #f0f0f0;
        margin-top: 8px; flex-wrap: wrap; gap: 12px;
    }
    .pag-info { font-size: .88rem; color: #aaa; }
    .pag-btns { display: flex; gap: 6px; }
    .pag-btn {
        min-width: 36px; height: 36px; padding: 0 10px;
        border-radius: 9px; border: 1.5px solid #e8e8e8;
        background: #fff; color: #555; font-size: .88rem; font-weight: 600;
        cursor: pointer; display: flex; align-items: center; justify-content: center;
        transition: all .2s; font-family: 'Poppins', sans-serif;
    }
    .pag-btn:hover:not([disabled]):not(.active) { border-color: #b71c1c; color: #b71c1c; }
    .pag-btn.active { background: #b71c1c; border-color: #b71c1c; color: #fff; box-shadow: 0 3px 10px rgba(183,28,28,.3); }
    .pag-btn[disabled] { opacity: .35; cursor: not-allowed; }

    /* ── Empty state ─────────────────────────── */
    .empty-state { text-align: center; padding: 60px 24px; }
    .empty-icon {
        width: 80px; height: 80px; border-radius: 50%;
        background: #fdecea; display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; font-size: 2rem; color: #b71c1c;
    }
    .empty-state h5 { font-size: 1.05rem; font-weight: 700; color: #333; margin-bottom: 8px; }
    .empty-state p  { color: #bbb; font-size: .92rem; margin: 0; }

    /* ── Loading dots ────────────────────────── */
    .ldots span {
        display: inline-block; width: 8px; height: 8px; border-radius: 50%;
        background: #b71c1c; margin: 0 3px; animation: ldot 1.2s infinite;
    }
    .ldots span:nth-child(2) { animation-delay: .2s; }
    .ldots span:nth-child(3) { animation-delay: .4s; }
    @keyframes ldot {
        0%,80%,100% { transform: scale(.5); opacity: .3; }
        40%          { transform: scale(1);  opacity: 1; }
    }
</style>
@endpush

@section('content')

    {{-- ══ HERO ══ --}}
    <div class="doc-hero text-white">
        <div class="container">
            <div class="doc-hero-inner">
                <div class="doc-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Beranda</a>
                    <span class="sep"><i class="fa fa-chevron-right"></i></span>
                    <span>{{ $pageTitle }}</span>
                </div>
                <h1><i class="fa fa-folder-open" style="margin-right:12px;opacity:.85;"></i>{{ $pageTitle }}</h1>
                <p>Dokumen resmi Pemerintah Kota Semarang &mdash; Sistem Akuntabilitas Kinerja Instansi Pemerintah</p>
                <div class="doc-hero-chips">
                    <div class="hero-chip"><i class="fa fa-city"></i> Kota &amp; OPD</div>
                    <div class="hero-chip"><i class="fa fa-download"></i> Dapat Diunduh</div>
                    <div class="hero-chip"><i class="fa fa-lock-open"></i> Data Terbuka</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ KONTEN ══ --}}
    <div class="doc-main">
        <div class="container">
            <div id="doc-app">

                {{-- Toolbar --}}
                <div class="doc-toolbar">
                    <div class="type-toggle">
                        <button v-bind:class="{ active: isOpd === 0 }" v-on:click="switchType(0)">
                            <i class="fa fa-city"></i> Kota
                        </button>
                        <button v-bind:class="{ active: isOpd === 1 }" v-on:click="switchType(1)">
                            <i class="fa fa-sitemap"></i> OPD
                        </button>
                    </div>

                    <div class="doc-filters">
                        {{-- OPD dropdown: hanya saat mode OPD --}}
                        <div class="doc-filter-wrap" v-if="isOpd === 1">
                            <i class="fa fa-sitemap f-icon"></i>
                            <select class="doc-select"
                                v-model="selectedOpdId"
                                v-on:change="onOpdChange"
                                v-bind:disabled="loadingOpd">
                                <option value="">@{{ loadingOpd ? 'Memuat OPD...' : 'Semua OPD' }}</option>
                                <option v-for="opd in opdList" v-bind:key="opd.id" v-bind:value="opd.id">@{{ opd.name }}</option>
                            </select>
                        </div>

                        {{-- Filter tahun: saat tab dokumen aktif --}}
                        <div class="doc-filter-wrap" v-if="selectedDoc">
                            <i class="fa fa-calendar f-icon"></i>
                            <select class="doc-select" v-model="selectedYear" v-on:change="fetchFiles(1)">
                                <option value="">Semua Tahun</option>
                                <option v-for="y in yearRange" v-bind:key="y" v-bind:value="y">@{{ y }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="doc-card">

                    {{-- Tab jenis dokumen --}}
                    <div class="doc-tabs">
                        <div v-if="loadingDocs" style="display:flex;align-items:center;gap:10px;color:#bbb;font-size:.9rem;">
                            <div class="ldots"><span></span><span></span><span></span></div>
                            Memuat jenis dokumen&hellip;
                        </div>
                        <div v-else-if="masterDocuments.length === 0" style="color:#ccc;font-size:.9rem;padding:4px 0;">
                            Tidak ada jenis dokumen tersedia.
                        </div>
                        <button
                            v-else
                            v-for="(doc, i) in masterDocuments"
                            v-bind:key="doc.id"
                            class="doc-tab-btn"
                            v-bind:class="{ active: selectedDoc && selectedDoc.id === doc.id }"
                            v-on:click="selectDocument(doc)">
                            @{{ cleanLabel(doc.label_formatted) }}
                            <span class="tab-badge">@{{ i + 1 }}</span>
                        </button>
                    </div>

                    {{-- Area tabel (tampil saat tab terpilih) --}}
                    <div v-if="selectedDoc" class="doc-table-area">

                        <div class="doc-table-header">
                            <h5 class="doc-table-title">
                                <i class="fa fa-file-alt"></i>
                                @{{ cleanLabel(selectedDoc.label_formatted) }}
                                <span class="badge-scope">@{{ isOpd === 0 ? 'Kota' : 'OPD' }}</span>
                            </h5>
                            <span v-if="!loadingFiles && pagination.total" class="doc-total">
                                Total @{{ pagination.total }} dokumen
                            </span>
                        </div>

                        <div class="table-responsive">
                            <table class="doc-table">
                                <thead>
                                    <tr>
                                        <th style="width:52px;">No</th>
                                        <th style="width:110px;">Tahun</th>
                                        <th>Nama Dokumen</th>
                                        <th style="width:160px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Skeleton --}}
                                    <tr v-if="loadingFiles" v-for="n in 5" v-bind:key="'sk'+n">
                                        <td><div class="skel" style="width:30px;"></div></td>
                                        <td><div class="skel" style="width:65px;"></div></td>
                                        <td><div class="skel" style="width:70%;"></div></td>
                                        <td><div class="skel" style="width:130px;"></div></td>
                                    </tr>

                                    {{-- Data --}}
                                    <tr v-if="!loadingFiles" v-for="(item, idx) in documentFiles" v-bind:key="item.id">
                                        <td><span class="row-num">@{{ (pagination.current_page - 1) * pagination.per_page + idx + 1 }}</span></td>
                                        <td><span class="year-pill">@{{ item.year }}</span></td>
                                        <td style="font-weight:500;">@{{ item.name }}</td>
                                        <td>
                                            <div style="display:flex;gap:6px;">
                                                <a v-bind:href="item.file_url" target="_blank" class="btn-act view">
                                                    <i class="fa fa-eye"></i> Lihat
                                                </a>
                                                <a v-bind:href="item.file_url" download target="_blank" class="btn-act download">
                                                    <i class="fa fa-download"></i> Unduh
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Kosong --}}
                                    <tr v-if="!loadingFiles && documentFiles.length === 0">
                                        <td colspan="4">
                                            <div class="empty-state">
                                                <div class="empty-icon"><i class="fa fa-folder-open"></i></div>
                                                <h5>Belum Ada Dokumen</h5>
                                                <p>Dokumen untuk kategori ini belum tersedia.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div v-if="!loadingFiles && pagination.last_page > 1" class="doc-pagination">
                            <span class="pag-info">
                                Menampilkan <strong>@{{ pagination.from }}&ndash;@{{ pagination.to }}</strong>
                                dari <strong>@{{ pagination.total }}</strong> dokumen
                            </span>
                            <div class="pag-btns">
                                <button class="pag-btn"
                                    v-bind:disabled="pagination.current_page === 1"
                                    v-on:click="fetchFiles(pagination.current_page - 1)">
                                    <i class="fa fa-chevron-left" style="font-size:.7rem;"></i>
                                </button>
                                <button
                                    v-for="p in pageRange"
                                    v-bind:key="p"
                                    class="pag-btn"
                                    v-bind:class="{ active: p === pagination.current_page }"
                                    v-on:click="fetchFiles(p)">
                                    @{{ p }}
                                </button>
                                <button class="pag-btn"
                                    v-bind:disabled="pagination.current_page === pagination.last_page"
                                    v-on:click="fetchFiles(pagination.current_page + 1)">
                                    <i class="fa fa-chevron-right" style="font-size:.7rem;"></i>
                                </button>
                            </div>
                        </div>

                    </div>{{-- /.doc-table-area --}}

                    {{-- Belum pilih tab --}}
                    <div v-else-if="!loadingDocs" class="empty-state">
                        <div class="empty-icon"><i class="fa fa-hand-pointer"></i></div>
                        <h5>Pilih Jenis Dokumen</h5>
                        <p>Klik salah satu tab di atas untuk menampilkan daftar dokumen.</p>
                    </div>

                </div>{{-- /.doc-card --}}
            </div>{{-- /#doc-app --}}
        </div>
    </div>

@endsection

@push('script')
<script>
(function () {
    const { createApp } = Vue;

    const rawUrl       = "{{ rtrim($apiUrl, '/') }}/";
    const ESAKIPV2_URL = rawUrl.startsWith('http') ? rawUrl : 'http://' + rawUrl;
    const CATEGORY_ID  = {{ $categoryId }};
    const ESAKIPV2_KEY = "{{ $apiKey }}";

    const axiosV2 = axios.create({ headers: { 'X-API-KEY': ESAKIPV2_KEY } });

    createApp({
        data() {
            return {
                isOpd: 0,
                masterDocuments: [],
                selectedDoc: null,
                documentFiles: [],
                pagination: { current_page: 1, last_page: 1, from: 0, to: 0, total: 0, per_page: 10 },
                loadingDocs: false,
                loadingFiles: false,
                opdList: [],
                loadingOpd: false,
                selectedOpdId: '',
                selectedYear: '',
            };
        },

        computed: {
            yearRange() {
                const years = [];
                const now = new Date().getFullYear();
                for (let y = now; y >= 2016; y--) years.push(y);
                return years;
            },
            pageRange() {
                const total = this.pagination.last_page;
                const cur   = this.pagination.current_page;
                const start = Math.max(1, cur - 2);
                const end   = Math.min(total, cur + 2);
                const pages = [];
                for (let i = start; i <= end; i++) pages.push(i);
                return pages;
            },
        },

        mounted() {
            this.fetchMasterDocuments();
        },

        methods: {
            cleanLabel(label) {
                return (label || '').replace(/^\[.*?\]\s*/i, '').trim();
            },

            fetchMasterDocuments() {
                this.loadingDocs     = true;
                this.masterDocuments = [];
                this.selectedDoc     = null;
                this.documentFiles   = [];
                axiosV2.get(ESAKIPV2_URL + 'v1/master_document', {
                    params: { master_document_category_id: CATEGORY_ID, is_opd: this.isOpd }
                })
                .then(res => {
                    this.masterDocuments = res.data.data || [];
                    if (this.masterDocuments.length) {
                        this.selectDocument(this.masterDocuments[0]);
                    }
                })
                .catch(err => console.error('master_document error:', err))
                .finally(() => { this.loadingDocs = false; });
            },

            selectDocument(doc) {
                this.selectedDoc  = doc;
                this.selectedYear = '';
                this.fetchFiles(1);
            },

            fetchFiles(page) {
                if (!this.selectedDoc) return;
                this.loadingFiles  = true;
                this.documentFiles = [];

                const params = {
                    master_document_id: this.selectedDoc.id,
                    page: page,
                };
                if (this.isOpd === 1 && this.selectedOpdId) {
                    params.opd_id = this.selectedOpdId;
                }
                if (this.selectedYear) {
                    params.year = this.selectedYear;
                }

                axiosV2.get(ESAKIPV2_URL + 'v1/document_year_file', { params })
                .then(res => {
                    const d = res.data.data || {};
                    this.documentFiles = d.data       || [];
                    this.pagination    = d.pagination || { current_page: 1, last_page: 1, from: 0, to: 0, total: 0, per_page: 10 };
                })
                .catch(err => console.error('document_year_file error:', err))
                .finally(() => { this.loadingFiles = false; });
            },

            onOpdChange() {
                this.selectedYear = '';
                if (this.selectedDoc) this.fetchFiles(1);
            },

            fetchOpd() {
                if (this.opdList.length) return;
                this.loadingOpd = true;
                axiosV2.get(ESAKIPV2_URL + 'v1/opd')
                    .then(res => { this.opdList = res.data.data || []; })
                    .catch(err => console.error('opd error:', err))
                    .finally(() => { this.loadingOpd = false; });
            },

            switchType(val) {
                if (this.isOpd === val) return;
                this.isOpd       = val;
                this.selectedOpdId = '';
                this.selectedYear  = '';
                if (val === 1) this.fetchOpd();
                this.fetchMasterDocuments();
            },
        },
    }).mount('#doc-app');
})();
</script>
@endpush
