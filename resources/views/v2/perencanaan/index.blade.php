@extends('frontend.layouts.main')
@section('content')
    <div class="breadcrumb-area shadow theme-hard bg-fixed text-center text-light"
        style="background-image: url({{ asset('kotasemarangvector.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>{{ $pageTitle }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="affected-countries-area bg-gray shape default-padding">
        <div class="container">
            <div id="app">
                <div class="row">
                    <div class="col-md-12">
                        <div class="site-heading text-center">
                            <h2>{{ $pageTitle }}</h2>
                        </div>
                    </div>
                </div>

                {{-- Toggle Kota / OPD --}}
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <div class="btn-group" role="group">
                            <button
                                :class="isOpd === 0 ? 'btn btn-success' : 'btn btn-outline-secondary'"
                                @click="switchType(0)">
                                <i class="fa fa-building"></i> Kota
                            </button>
                            <button
                                :class="isOpd === 1 ? 'btn btn-success' : 'btn btn-outline-secondary'"
                                @click="switchType(1)">
                                <i class="fa fa-sitemap"></i> OPD
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Document Type Tabs --}}
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div v-if="loadingDocs" class="text-center py-3">
                            <span class="text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat jenis dokumen...</span>
                        </div>
                        <div v-else class="text-center">
                            <button
                                v-for="doc in masterDocuments"
                                :key="doc.id"
                                :class="selectedDoc && selectedDoc.id === doc.id ? 'btn btn-primary mr-2 mb-2' : 'btn btn-outline-primary mr-2 mb-2'"
                                @click="selectDocument(doc)">
                                @{{ doc.label_formatted }}
                            </button>
                            <div v-if="masterDocuments.length === 0" class="text-muted">
                                Tidak ada jenis dokumen tersedia.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Document Files Table --}}
                <div class="row" v-if="selectedDoc">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">
                                    Daftar Dokumen: <strong>@{{ selectedDoc.label_formatted }}</strong>
                                    <span class="badge badge-secondary ml-2">
                                        @{{ isOpd === 0 ? 'Kota' : 'OPD' }}
                                    </span>
                                </h5>
                                <div v-if="loadingFiles">
                                    <span class="text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat...</span>
                                </div>
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="60">No</th>
                                        <th width="100">Tahun</th>
                                        <th>Nama Dokumen</th>
                                        <th width="180">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in documentFiles" :key="item.id">
                                        <td>@{{ (pagination.current_page - 1) * pagination.per_page + index + 1 }}</td>
                                        <td>@{{ item.year }}</td>
                                        <td>@{{ item.name }}</td>
                                        <td>
                                            <a :href="item.file_url" target="_blank" class="btn btn-sm btn-success">
                                                <i class="fa-solid fa-eye"></i> Lihat
                                            </a>
                                            <a :href="item.file_url" download target="_blank" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-download"></i> Unduh
                                            </a>
                                        </td>
                                    </tr>
                                    <tr v-if="!loadingFiles && documentFiles.length === 0">
                                        <td colspan="4" class="text-center py-4">
                                            <img src="{{ asset('no-results.png') }}" style="height: 150px;"><br>
                                            <span class="text-muted">Data tidak ditemukan</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                            <nav v-if="pagination.last_page > 1" aria-label="Pagination" class="text-right">
                                <ul class="pagination" style="cursor:pointer; justify-content: flex-end;">
                                    <li class="page-item" :class="{ disabled: pagination.current_page === 1 }">
                                        <a class="page-link" @click="fetchFiles(pagination.current_page - 1)">
                                            &laquo;
                                        </a>
                                    </li>
                                    <li
                                        class="page-item"
                                        v-for="page in pageRange"
                                        :key="page"
                                        :class="{ active: page === pagination.current_page }">
                                        <a class="page-link" @click="fetchFiles(page)">@{{ page }}</a>
                                    </li>
                                    <li class="page-item" :class="{ disabled: pagination.current_page === pagination.last_page }">
                                        <a class="page-link" @click="fetchFiles(pagination.current_page + 1)">
                                            &raquo;
                                        </a>
                                    </li>
                                </ul>
                            </nav>

                            <p v-if="pagination.total" class="text-muted small">
                                Menampilkan @{{ pagination.from }}&ndash;@{{ pagination.to }} dari @{{ pagination.total }} dokumen
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row" v-else-if="!loadingDocs">
                    <div class="col-md-12 text-center py-5">
                        <i class="fa fa-hand-pointer-o fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Pilih jenis dokumen di atas untuk menampilkan daftar file.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    const { createApp } = Vue;
    const rawUrl = "{{ rtrim($apiUrl, '/') }}/";
    const ESAKIPV2_URL = rawUrl.startsWith('http') ? rawUrl : 'http://' + rawUrl;
    const CATEGORY_ID = {{ $categoryId }};
    const ESAKIPV2_KEY = "{{ $apiKey }}";

    const axiosV2 = axios.create({
        headers: {
            'X-API-KEY': ESAKIPV2_KEY,
        }
    });

    createApp({
        data() {
            return {
                isOpd: 0,
                masterDocuments: [],
                selectedDoc: null,
                documentFiles: [],
                pagination: {
                    current_page: 1,
                    last_page: 1,
                    from: 0,
                    to: 0,
                    total: 0,
                    per_page: 10,
                },
                loadingDocs: false,
                loadingFiles: false,
            };
        },
        computed: {
            pageRange() {
                const total = this.pagination.last_page;
                const current = this.pagination.current_page;
                const delta = 2;
                const start = Math.max(1, current - delta);
                const end = Math.min(total, current + delta);
                const pages = [];
                for (let i = start; i <= end; i++) pages.push(i);
                return pages;
            }
        },
        mounted() {
            this.fetchMasterDocuments();
        },
        methods: {
            fetchMasterDocuments() {
                this.loadingDocs = true;
                this.masterDocuments = [];
                this.selectedDoc = null;
                this.documentFiles = [];

                axiosV2.get(ESAKIPV2_URL + 'v1/master_document', {
                    params: {
                        master_document_category_id: CATEGORY_ID,
                        is_opd: this.isOpd,
                    }
                })
                .then(response => {
                    this.masterDocuments = response.data.data || [];
                    if (this.masterDocuments.length > 0) {
                        this.selectDocument(this.masterDocuments[0]);
                    }
                })
                .catch(error => {
                    console.error('Gagal memuat jenis dokumen:', error);
                })
                .finally(() => {
                    this.loadingDocs = false;
                });
            },
            selectDocument(doc) {
                this.selectedDoc = doc;
                this.fetchFiles(1);
            },
            fetchFiles(page) {
                if (!this.selectedDoc) return;
                this.loadingFiles = true;
                this.documentFiles = [];

                axiosV2.get(ESAKIPV2_URL + 'v1/document_year_file', {
                    params: {
                        master_document_id: this.selectedDoc.id,
                        page: page,
                    }
                })
                .then(response => {
                    const data = response.data.data;
                    this.documentFiles = data.data || [];
                    this.pagination = data.pagination || {};
                })
                .catch(error => {
                    console.error('Gagal memuat dokumen:', error);
                })
                .finally(() => {
                    this.loadingFiles = false;
                });
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
