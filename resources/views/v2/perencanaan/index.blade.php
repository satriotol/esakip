@extends('frontend.layouts.main')

@push('css')
<style>
    /* ── Hero ─────────────────────────────────────────── */
    .doc-hero {
        background: linear-gradient(135deg, #b73333 0%, #7b1fa2 100%);
        padding: 64px 0 88px;
        position: relative;
        overflow: hidden;
    }
    .doc-hero::before,
    .doc-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
    }
    .doc-hero::before { width: 420px; height: 420px; top: -120px; right: -60px; }
    .doc-hero::after  { width: 260px; height: 260px; bottom: -80px; left: -40px; }
    .doc-hero h1 { font-size: 2rem; font-weight: 700; margin-bottom: 6px; position: relative; z-index: 1; }
    .doc-hero p  { opacity: .82; font-size: .95rem; margin: 0; position: relative; z-index: 1; }

    /* ── Wrapper kartu utama ──────────────────────────── */
    .doc-main { margin-top: -48px; padding-bottom: 64px; position: relative; z-index: 2; }

    .doc-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 10px 50px rgba(0,0,0,.10);
        overflow: hidden;
    }

    /* ── Toggle Kota / OPD ───────────────────────────── */
    .type-toggle {
        display: inline-flex;
        background: #f1f3f5;
        border-radius: 50px;
        padding: 4px;
        gap: 4px;
    }
    .type-toggle button {
        border: none;
        background: transparent;
        border-radius: 50px;
        padding: 9px 30px;
        font-weight: 600;
        font-size: .88rem;
        color: #666;
        cursor: pointer;
        transition: all .25s;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .type-toggle button.active {
        background: #b73333;
        color: #fff;
        box-shadow: 0 4px 14px rgba(183,51,51,.35);
    }
    .type-toggle button:not(.active):hover { background: #e2e6ea; color: #333; }

    /* ── Tab jenis dokumen ────────────────────────────── */
    .doc-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 22px 28px;
        border-bottom: 1px solid #f0f0f0;
        background: #fafafa;
        align-items: center;
    }
    .doc-tab-btn {
        border: 2px solid #e0e0e0;
        background: #fff;
        border-radius: 50px;
        padding: 8px 22px;
        font-weight: 600;
        font-size: .84rem;
        color: #555;
        cursor: pointer;
        transition: all .2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .tab-num {
        background: #e9ecef;
        color: #888;
        border-radius: 50px;
        padding: 1px 8px;
        font-size: .72rem;
        font-weight: 700;
        transition: all .2s;
    }
    .doc-tab-btn.active {
        background: #b73333;
        border-color: #b73333;
        color: #fff;
        box-shadow: 0 4px 14px rgba(183,51,51,.30);
    }
    .doc-tab-btn.active .tab-num { background: rgba(255,255,255,.25); color: #fff; }
    .doc-tab-btn:not(.active):hover { border-color: #b73333; color: #b73333; }

    /* ── Area tabel ───────────────────────────────────── */
    .doc-table-wrap { padding: 24px 28px; }

    .doc-table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .doc-table-title {
        font-size: 1rem;
        font-weight: 700;
        color: #222;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .badge-type {
        font-size: .72rem;
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 50px;
        background: #fdecea;
        color: #b73333;
        letter-spacing: .3px;
    }
    .doc-count { font-size: .82rem; color: #999; }

    /* ── Tabel ────────────────────────────────────────── */
    .doc-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .doc-table thead th {
        background: #f8f9fa;
        font-size: .76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #999;
        padding: 12px 16px;
        border-bottom: 2px solid #eee;
    }
    .doc-table tbody tr { transition: background .15s; }
    .doc-table tbody tr:hover { background: #fff8f8; }
    .doc-table tbody td {
        padding: 14px 16px;
        border-bottom: 1px solid #f4f4f4;
        font-size: .9rem;
        color: #444;
        vertical-align: middle;
    }
    .doc-table tbody tr:last-child td { border-bottom: none; }

    .year-badge {
        display: inline-block;
        background: #eef2ff;
        color: #3b5bdb;
        font-weight: 700;
        font-size: .8rem;
        padding: 3px 12px;
        border-radius: 50px;
    }

    .btn-act {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 15px;
        border-radius: 8px;
        font-size: .8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }
    .btn-act.view     { background: #e8f5e9; color: #2e7d32; }
    .btn-act.view:hover     { background: #2e7d32; color: #fff; }
    .btn-act.download { background: #fdecea; color: #b73333; }
    .btn-act.download:hover { background: #b73333; color: #fff; }

    /* ── Skeleton ─────────────────────────────────────── */
    .skeleton-bar {
        height: 13px;
        border-radius: 6px;
        background: linear-gradient(90deg,#f0f0f0 25%,#e4e4e4 50%,#f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.3s infinite;
    }
    @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

    /* ── Pagination ───────────────────────────────────── */
    .doc-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 18px;
        border-top: 1px solid #f0f0f0;
        margin-top: 6px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .pag-info { font-size: .82rem; color: #999; }
    .pag-btns { display: flex; gap: 5px; }
    .pag-btn {
        min-width: 34px;
        height: 34px;
        padding: 0 8px;
        border-radius: 8px;
        border: 1px solid #e4e4e4;
        background: #fff;
        color: #555;
        font-size: .84rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .2s;
    }
    .pag-btn:hover:not([disabled]):not(.active) { border-color: #b73333; color: #b73333; }
    .pag-btn.active { background: #b73333; border-color: #b73333; color: #fff; }
    .pag-btn[disabled] { opacity: .38; cursor: not-allowed; }

    /* ── Empty state ──────────────────────────────────── */
    .empty-state { text-align: center; padding: 64px 20px; }
    .empty-icon {
        width: 80px; height: 80px; border-radius: 50%;
        background: #fdecea;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem; color: #b73333;
    }
    .empty-state h5 { font-weight: 700; color: #333; margin-bottom: 6px; }
    .empty-state p  { color: #aaa; font-size: .9rem; margin: 0; }

    /* ── Loading dots ─────────────────────────────────── */
    .loading-dots span {
        display: inline-block;
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #b73333;
        margin: 0 2px;
        animation: ldot 1.2s infinite;
    }
    .loading-dots span:nth-child(2) { animation-delay: .2s; }
    .loading-dots span:nth-child(3) { animation-delay: .4s; }
    @keyframes ldot {
        0%,80%,100% { transform: scale(.55); opacity: .35; }
        40%          { transform: scale(1);   opacity: 1; }
    }
</style>
@endpush

@section('content')

    {{-- Hero --}}
    <div class="doc-hero text-center text-white">
        <div class="container">
            <h1><i class="fa fa-folder-open" style="margin-right:10px;"></i>{{ $pageTitle }}</h1>
            <p>Sistem Akuntabilitas Kinerja Instansi Pemerintah &mdash; Kota Semarang</p>
        </div>
    </div>

    <div class="doc-main">
        <div class="container">
            <div id="app">

                {{-- Toggle Kota / OPD --}}
                <div class="text-center" style="margin-bottom:28px;">
                    <div class="type-toggle">
                        <button :class="{ active: isOpd === 0 }" @click="switchType(0)">
                            <i class="fa fa-city"></i> Kota
                        </button>
                        <button :class="{ active: isOpd === 1 }" @click="switchType(1)">
                            <i class="fa fa-sitemap"></i> OPD
                        </button>
                    </div>
                </div>

                <div class="doc-card">

                    {{-- Tab jenis dokumen --}}
                    <div class="doc-tabs">
                        <div v-if="loadingDocs" style="display:flex;align-items:center;gap:10px;color:#bbb;font-size:.88rem;">
                            <div class="loading-dots"><span></span><span></span><span></span></div>
                            Memuat jenis dokumen&hellip;
                        </div>
                        <template v-else>
                            <button
                                v-for="(doc, i) in masterDocuments"
                                :key="doc.id"
                                class="doc-tab-btn"
                                :class="{ active: selectedDoc && selectedDoc.id === doc.id }"
                                @click="selectDocument(doc)">
                                @{{ doc.label_formatted }}
                                <span class="tab-num">@{{ i + 1 }}</span>
                            </button>
                            <span v-if="masterDocuments.length === 0" style="color:#ccc;font-size:.88rem;">
                                Tidak ada jenis dokumen tersedia.
                            </span>
                        </template>
                    </div>

                    {{-- Tabel dokumen --}}
                    <div class="doc-table-wrap" v-if="selectedDoc">

                        <div class="doc-table-header">
                            <h5 class="doc-table-title">
                                <i class="fa fa-file-alt" style="color:#b73333;"></i>
                                @{{ selectedDoc.label_formatted }}
                                <span class="badge-type">@{{ isOpd === 0 ? 'Kota' : 'OPD' }}</span>
                            </h5>
                            <span class="doc-count" v-if="pagination.total">
                                Total <strong>@{{ pagination.total }}</strong> dokumen
                            </span>
                        </div>

                        <div class="table-responsive">
                            <table class="doc-table">
                                <thead>
                                    <tr>
                                        <th width="55">No</th>
                                        <th width="110">Tahun</th>
                                        <th>Nama Dokumen</th>
                                        <th width="155">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Skeleton --}}
                                    <template v-if="loadingFiles">
                                        <tr v-for="n in 6" :key="'sk'+n">
                                            <td><div class="skeleton-bar" style="width:28px;"></div></td>
                                            <td><div class="skeleton-bar" style="width:60px;"></div></td>
                                            <td><div class="skeleton-bar" style="width:75%;"></div></td>
                                            <td><div class="skeleton-bar" style="width:120px;"></div></td>
                                        </tr>
                                    </template>
                                    {{-- Data --}}
                                    <template v-else>
                                        <tr v-for="(item, idx) in documentFiles" :key="item.id">
                                            <td style="color:#bbb;font-size:.8rem;">
                                                @{{ (pagination.current_page - 1) * pagination.per_page + idx + 1 }}
                                            </td>
                                            <td><span class="year-badge">@{{ item.year }}</span></td>
                                            <td style="font-weight:500;">@{{ item.name }}</td>
                                            <td>
                                                <div style="display:flex;gap:6px;">
                                                    <a :href="item.file_url" target="_blank" class="btn-act view">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </a>
                                                    <a :href="item.file_url" download target="_blank" class="btn-act download">
                                                        <i class="fa fa-download"></i> Unduh
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr v-if="documentFiles.length === 0">
                                            <td colspan="4">
                                                <div class="empty-state">
                                                    <div class="empty-icon"><i class="fa fa-folder-open"></i></div>
                                                    <h5>Data Tidak Ditemukan</h5>
                                                    <p>Belum ada dokumen untuk kategori ini.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="doc-pagination" v-if="pagination.total">
                            <span class="pag-info">
                                Menampilkan <strong>@{{ pagination.from }}</strong>&ndash;<strong>@{{ pagination.to }}</strong>
                                dari <strong>@{{ pagination.total }}</strong> dokumen
                            </span>
                            <div class="pag-btns" v-if="pagination.last_page > 1">
                                <button class="pag-btn"
                                    :disabled="pagination.current_page === 1"
                                    @click="fetchFiles(pagination.current_page - 1)">
                                    <i class="fa fa-chevron-left" style="font-size:.68rem;"></i>
                                </button>
                                <button
                                    v-for="p in pageRange" :key="p"
                                    class="pag-btn" :class="{ active: p === pagination.current_page }"
                                    @click="fetchFiles(p)">
                                    @{{ p }}
                                </button>
                                <button class="pag-btn"
                                    :disabled="pagination.current_page === pagination.last_page"
                                    @click="fetchFiles(pagination.current_page + 1)">
                                    <i class="fa fa-chevron-right" style="font-size:.68rem;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Belum pilih dokumen --}}
                    <div v-else-if="!loadingDocs" class="empty-state">
                        <div class="empty-icon"><i class="fa fa-hand-pointer"></i></div>
                        <h5>Pilih Jenis Dokumen</h5>
                        <p>Klik salah satu tab di atas untuk menampilkan daftar dokumen.</p>
                    </div>

                </div>{{-- /.doc-card --}}
            </div>{{-- /#app --}}
        </div>
    </div>

@endsection

@push('script')
<script>
    const { createApp } = Vue;
    const rawUrl = "{{ rtrim($apiUrl, '/') }}/";
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
                pagination: { current_page:1, last_page:1, from:0, to:0, total:0, per_page:10 },
                loadingDocs: false,
                loadingFiles: false,
            };
        },
        computed: {
            pageRange() {
                const { last_page: total, current_page: cur } = this.pagination;
                const start = Math.max(1, cur - 2);
                const end   = Math.min(total, cur + 2);
                const pages = [];
                for (let i = start; i <= end; i++) pages.push(i);
                return pages;
            }
        },
        mounted() { this.fetchMasterDocuments(); },
        methods: {
            fetchMasterDocuments() {
                this.loadingDocs  = true;
                this.masterDocuments = [];
                this.selectedDoc  = null;
                this.documentFiles = [];
                axiosV2.get(ESAKIPV2_URL + 'v1/master_document', {
                    params: { master_document_category_id: CATEGORY_ID, is_opd: this.isOpd }
                })
                .then(res => {
                    this.masterDocuments = res.data.data || [];
                    if (this.masterDocuments.length) this.selectDocument(this.masterDocuments[0]);
                })
                .catch(console.error)
                .finally(() => this.loadingDocs = false);
            },
            selectDocument(doc) {
                this.selectedDoc = doc;
                this.fetchFiles(1);
            },
            fetchFiles(page) {
                if (!this.selectedDoc) return;
                this.loadingFiles  = true;
                this.documentFiles = [];
                axiosV2.get(ESAKIPV2_URL + 'v1/document_year_file', {
                    params: { master_document_id: this.selectedDoc.id, page }
                })
                .then(res => {
                    const d = res.data.data;
                    this.documentFiles = d.data       || [];
                    this.pagination    = d.pagination || {};
                })
                .catch(console.error)
                .finally(() => this.loadingFiles = false);
            },
            switchType(val) {
                if (this.isOpd === val) return;
                this.isOpd = val;
                this.fetchMasterDocuments();
            }
        }
    }).mount('#app');
</script>
@endpush
