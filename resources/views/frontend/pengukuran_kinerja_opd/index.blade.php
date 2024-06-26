@extends('frontend.layouts.main')
@section('content')
    <div class="breadcrumb-area shadow theme-hard bg-fixed text-center text-light"
        style="background-image: url({{ asset('kotasemarangvector.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>{{ $name }}</h1>
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
                            <h2>{{ $name }} @{{ routeName }}</h2>
                            <div class="text-left">
                                <button :class="[routeName == 'IKU' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('IKU')">IKU</button>
                                <button :class="[routeName == 'PERJANJIAN KINERJA' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('PERJANJIAN KINERJA')">PERJANJIAN KINERJA</button>
                                <button :class="[routeName == 'CAPAIAN KINERJA' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('CAPAIAN KINERJA')">CAPAIAN KINERJA</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="routeName == 'IKU'">
                    @include('frontend.pengukuran_kinerja_opd.iku')
                </div>
                <div v-if="routeName == 'PERJANJIAN KINERJA'">
                    @include('frontend.pengukuran_kinerja_opd.perjanjian_kinerja')
                </div>
                <div v-if="routeName == 'CAPAIAN KINERJA'">
                    @include('frontend.pengukuran_kinerja_opd.capaian_kinerja')
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
                    dataIku: "",
                    dataPerjanjianKinerja: "",
                    paginationIku: [],
                    paginationPerjanjianKinerja: [],
                    routeName: "IKU",
                    urlIku: API_URL + 'pengukurankinerjaopd/iku',
                    urlPerjanjianKinerja: API_URL + 'pengukurankinerjaopd/perjanjian_kinerja',
                    year_search: "",
                    opd_search: "",
                    name_search: "",
                    type_search: "",
                    loading: true,
                }
            },
            mounted() {
                this.getOpd();
                this.getOpdIku();
                this.getOpdPerjanjianKinerja();
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
                getOpdIku(pageUrl) {
                    this.loading = true;
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    axios.get(this.urlIku, {
                            params: {
                                page: pageUrl,
                                opd_search: this.opd_search,
                                year_search: this.year_search
                            }
                        })
                        .then(response => (
                            this.dataIku = response.data.iku_datas.data,
                            this.paginationIku = response.data.iku_datas
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                        .finally(() => this.loading = false)
                },
                getOpdPerjanjianKinerja(pageUrl) {
                    this.loading = true;
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    axios.get(this.urlPerjanjianKinerja, {
                            params: {
                                page: pageUrl,
                                opd_search: this.opd_search,
                                type_search: this.type_search,
                                year_search: this.year_search
                            }
                        })
                        .then(response => (
                            this.dataPerjanjianKinerja = response.data.perjanjian_kinerja_datas.data,
                            this.paginationPerjanjianKinerja = response.data.perjanjian_kinerja_datas
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
