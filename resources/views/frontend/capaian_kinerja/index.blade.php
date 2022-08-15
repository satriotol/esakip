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
                                <button :class="[routeName == 'ANGGARAN APBD' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('ANGGARAN APBD')">ANGGARAN APBD</button>
                                <button :class="[routeName == 'REALISASI ANGGARAN' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('REALISASI ANGGARAN')">REALISASI ANGGARAN</button>
                                <button
                                    :class="[routeName == 'CAPAIAN IKU' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('CAPAIAN IKU')">CAPAIAN IKU</button>
                                <button
                                    :class="[routeName == 'CAPAIAN IKD' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('CAPAIAN IKD')">CAPAIAN IKD</button>
                                <button
                                    :class="[routeName == 'LINK CAPAIAN KINERJA' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('LINK CAPAIAN KINERJA')">LINK CAPAIAN KINERJA</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="routeName == 'ANGGARAN APBD'">
                    @include('frontend.capaian_kinerja.apbd_anggaran')
                </div>
                <div v-if="routeName == 'REALISASI ANGGARAN'">
                    @include('frontend.capaian_kinerja.realisasi_anggaran')
                </div>
                <div v-if="routeName == 'CAPAIAN IKU'">
                    @include('frontend.capaian_kinerja.link_iku')
                </div>
                <div v-if="routeName == 'CAPAIAN IKD'">
                    @include('frontend.capaian_kinerja.link_ikd')
                </div>
                <div v-if="routeName == 'LINK CAPAIAN KINERJA'">
                    @include('frontend.capaian_kinerja.link')
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
                    dataApbdAnggaran: "",
                    dataRealisasiAnggaran: "",
                    dataSkpds: "",
                    routeName: "ANGGARAN APBD",
                    urlApbdAnggaran: API_URL + 'getApbdAnggaran',
                    urlRealisasiAnggaran: API_URL + 'getRealisasiAnggaran',
                    urlSkpd: API_URL + 'skpd',
                    skpd_search: "",
                    year_search: "",
                }
            },
            mounted() {
                this.getApbdAnggaran();
                this.getRealisasiAnggaran();
                this.getSkpd();
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
                    this.loading = true;
                    axios.get(this.urlApbdAnggaran, {
                            params: {
                                id_skpd: this.skpd_search,
                                year: this.year_search,
                            }
                        })
                        .then(response => (
                            this.dataApbdAnggaran = response.data.ApbdAnggaran,
                            this.loading = false
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                },
                getRealisasiAnggaran(pageUrl) {
                    axios.get(this.urlRealisasiAnggaran, {
                            params: {
                                id_skpd: this.skpd_search,
                                year: this.year_search,
                            }
                        })
                        .then(response => (
                            this.dataRealisasiAnggaran = response.data.RealisasiAnggaran
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
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
