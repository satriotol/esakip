@extends('frontend.layouts.main')
@section('content')
    <div class="breadcrumb-area shadow theme-hard bg-fixed text-center text-light"
        style="background-image: url({{ asset('kotasemarangvector.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Pelaporan Kinerja</h1>
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
                            <h2>Pelaporan Kinerja @{{ routeName }}</h2>
                            <div class="text-left">
                                <button :class="[routeName == 'KOTA' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('KOTA')">KOTA</button>
                                <button :class="[routeName == 'OPD' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('OPD')">LKJIP OPD</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="country-lists" style="margin-top: 10px" v-if="routeName == 'KOTA'">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" v-model="year_search" placeholder="Cari Berdasarkan Tahun"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" v-model="name_search" placeholder="Cari Berdasarkan Nama"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" @click="getKotaLkjips()">Cari</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Dokumen</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(data, index) in datas">
                                            <td>
                                                @{{ data.year }} | @{{ data.name }}
                                            </td>
                                            <td>
                                                <a :href="data.file_url" target="_blank" class="btn btn-success"><i
                                        class="fa-solid fa-eye"></i> View</a>
                                                <a download :href="data.file_url" target="_blank"
                                                    class="btn btn-danger"><i class="fa-solid fa-download"></i> Download</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div v-if="datas.length == 0" class="text-center">
                                    <img src="{{ asset('no-results.png') }}" style="height: 200px;">
                                    <h2>Data Tidak Ditemukan</h2>
                                </div>
                                <nav aria-label="Page navigation example" class="text-right">
                                    <ul class="pagination" style="cursor:pointer;">
                                        <li class="page-item" :class="{ active: link.active }"
                                            v-for="link in pagination.links" @click="getKotaLkjips(link.url)">
                                            <a class="page-link" v-if="link.label">
                                                @{{ (link.label).split('.')[1] ?? (link.label).split('.')[0] }}
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="country-lists" style="margin-top: 10px" v-else>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" v-model="year_search" placeholder="Cari Berdasarkan Tahun"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" v-model="opd_search" style="min-height: 50px;">
                                            <option value="">Cari Berdasarkan OPD</option>
                                            <option :value="opd.id" v-for="(opd, index) in opds">
                                                @{{ opd.nama_opd }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" @click="getOpdLkjips()">Cari</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>OPD</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(data, index) in datas_opd">
                                            <td>
                                                @{{ data.year }}
                                            </td>
                                            <td>
                                                @{{ data.opd_name }}
                                            </td>
                                            <td>
                                                <a :href="data.file_url" target="_blank" class="btn btn-success"><i
                                        class="fa-solid fa-eye"></i> View</a>
                                                <a download :href="data.file_url" target="_blank"
                                                    class="btn btn-danger"><i class="fa-solid fa-download"></i> Download</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div v-if="datas_opd.length == 0" class="text-center">
                                    <img src="{{ asset('no-results.png') }}" style="height: 200px;">
                                    <h2>Data Tidak Ditemukan</h2>
                                </div>
                                <nav aria-label="Page navigation example" class="text-right">
                                    <ul class="pagination" style="cursor:pointer;">
                                        <li class="page-item" :class="{ active: link.active }"
                                            v-for="link in pagination_opd.links" @click="getOpdLkjips(link.url)">
                                            <a class="page-link" v-if="link.label">
                                                @{{ (link.label).split('.')[1] ?? (link.label).split('.')[0] }}
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        const {
            createApp
        } = Vue;
        const API_URL = "{{ env('API_URL') }}";

        createApp({
            data() {
                return {
                    message: 'Hello Vue!',
                    datas: "",
                    datas_opd: "",
                    url: API_URL + 'kotaLkjip',
                    url_opd: API_URL + 'opdLkjip',
                    pagination: "",
                    pagination_opd: "",
                    loading: true,
                    name_search: "",
                    year_search: "",
                    opd_search: "",
                    routeName: "KOTA",
                    opds: [],
                }
            },
            mounted() {
                this.getKotaLkjips();
                this.getOpdLkjips();
                this.getOpd();
            },
            methods: {
                getOpd() {
                    axios.get(API_URL + 'opd')
                        .then(response => (
                            this.opds = response.data.opds
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                },
                getKotaLkjips(pageUrl) {
                    this.loading = true;
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    axios.get(this.url, {
                            params: {
                                page: pageUrl,
                                name_search: this.name_search,
                                year_search: this.year_search
                            }
                        })
                        .then(response => (
                            this.datas = response.data.lkjips_kota_data.data,
                            this.pagination = response.data.lkjips_kota_data
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                        .finally(() => this.loading = false)
                },
                getOpdLkjips(pageUrl) {
                    this.loading = true;
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    axios.get(this.url_opd, {
                            params: {
                                page: pageUrl,
                                opd_search: this.opd_search,
                                year_search: this.year_search
                            }
                        })
                        .then(response => (
                            this.datas_opd = response.data.lkjips_opd_data.data,
                            this.pagination_opd = response.data.lkjips_opd_data
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                        .finally(() => this.loading = false)
                },
                setRouteName(routeName) {
                    this.routeName = routeName;
                }
            },
        }).mount('#app')
    </script>
@endpush
