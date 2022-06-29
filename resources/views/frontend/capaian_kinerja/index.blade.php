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
                                <button :class="[routeName == 'CAPAIAN APBD' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('CAPAIAN APBD')">CAPAIAN APBD</button>
                                {{-- <button :class="[routeName == 'REALISASI ANGGARAN' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('REALISASI ANGGARAN')">REALISASI ANGGARAN</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="routeName == 'CAPAIAN APBD'">
                    @include('frontend.capaian_kinerja.apbd_anggaran')
                </div>
                {{-- <div v-if="routeName == 'REALISASI ANGGARAN'">
                    @include('frontend.pengukuran_kinerja_opd.perjanjian_kinerja')
                </div> --}}
                {{-- <div v-if="routeName == 'CASCADING KINERJA'">
                    @include('frontend.pengukuran_kinerja_kota.cascading_kinerja')
                </div> --}}
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
                    dataApbdAnggaran: "",
                    dataPerjanjianKinerja: "",
                    dataSkpds: "",
                    paginationApbdAnggaran: [],
                    paginationPerjanjianKinerja: [],
                    routeName: "CAPAIAN APBD",
                    urlApbdAnggaran: API_URL + 'getApbdAnggaran',
                    urlSkpd: API_URL + 'skpd',
                    urlPerjanjianKinerja: API_URL + 'pengukurankinerjaopd/perjanjian_kinerja',
                    skpd_search: "",
                    loading: true,
                }
            },
            mounted() {
                this.getApbdAnggaran();
                this.getSkpd();
                this.getOpdPerjanjianKinerja();
            },
            methods: {
                getSkpd() {
                    axios.get(this.urlSkpd)
                        .then(response => (
                            this.dataSkpds = response.data.skpds
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                        .finally(() => this.loading = false)
                },
                getApbdAnggaran(pageUrl) {
                    axios.get(this.urlApbdAnggaran, {
                            params: {
                                page: pageUrl,
                                id_skpd: this.skpd_search
                            }
                        })
                        .then(response => (
                            this.dataApbdAnggaran = response.data.ApbdAnggaran
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
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
                },
                formatPrice(value) {
                    let val = (value / 1).toFixed(2).replace(".", ",");
                    return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }
            },
        }).mount('#app')
    </script>
@endpush
