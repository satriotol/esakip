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
                                <button :class="[routeName == 'RENSTRA' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('RENSTRA')">RENSTRA</button>
                                <button :class="[routeName == 'RKT' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('RKT')">RKT</button>
                                <button :class="[routeName == 'RENJA' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('RENJA')">RENJA</button>
                                <button :class="[routeName == 'POHON KINERJA' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('POHON KINERJA')">POHON KINERJA</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="routeName == 'RENSTRA'">
                    @include('frontend.perencanaan_kinerja_opd.renstra')
                </div>
                <div v-if="routeName == 'RKT'">
                    @include('frontend.perencanaan_kinerja_opd.rkt')
                </div>
                <div v-if="routeName == 'RENJA'">
                    @include('frontend.perencanaan_kinerja_opd.renja')
                </div>
                <div v-if="routeName == 'POHON KINERJA'">
                    @include('frontend.perencanaan_kinerja_opd.cascading_kinerja')
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
                    routeName: "RENSTRA",
                    opds: "",
                    dataRenstraPeriod: "",
                    dataRenstra: "",
                    dataRkt: "",
                    dataRenja: "",
                    dataCascadingKinerja: "",

                    paginationRenstra: "",
                    paginationRkt: "",
                    paginationRenja: "",
                    paginationCascadingKinerja: "",

                    urlPeriodRenstra: API_URL + 'perencanaankinerjaopd/renstra_period',
                    urlRenstra: API_URL + 'perencanaankinerjaopd/renstra',
                    urlRkt: API_URL + 'perencanaankinerjaopd/rkt',
                    urlRenja: API_URL + 'perencanaankinerjaopd/renja',
                    urlCascadingKinerja: API_URL + 'perencanaankinerjaopd/cascading_kinerja',

                    year_search: "",
                    name_search: "",
                    renstra_period_search: "",
                    type_search: "",
                    opd_search: "",
                    loading: true,

                    errorMessage: "",
                }
            },
            mounted() {
                const urlParams = new URLSearchParams(window.location.search);
                const nameParam = urlParams.get('name');
                if (nameParam) {
                    this.routeName = nameParam.toUpperCase();
                }

                this.getOpdPeriodRenstra();
                this.getOpdRenstra();
                this.getOpd();
                this.getOpdRkt();
                this.getOpdCascadingKinerja();
                this.getOpdRenja();

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
                getOpdPeriodRenstra() {
                    axios.get(this.urlPeriodRenstra)
                        .then(response => (
                            this.dataRenstraPeriod = response.data.renstra_period_datas
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                },
                getOpdRenstra(pageUrl) {
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    this.errorMessage = "";
                    axios.get(this.urlRenstra, {
                            params: {
                                page: pageUrl,
                                renstra_period_search: this.renstra_period_search,
                                opd_search: this.opd_search,
                            }
                        })
                        .then(response => (
                            this.dataRenstra = response.data.renstra_datas.data,
                            this.paginationRenstra = response.data.renstra_datas
                        ))
                        .catch(function(error) {
                            this.errorMessage = error.response.data[0].message;
                        })
                },
                getOpdRkt(pageUrl) {
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    this.errorMessage = "";
                    axios.get(this.urlRkt, {
                            params: {
                                page: pageUrl,
                                name_search: this.name_search,
                                opd_search: this.opd_search,
                                year_search: this.year_search,
                            }
                        })
                        .then(response => (
                            this.dataRkt = response.data.rkt_datas.data,
                            this.paginationRkt = response.data.rkt_datas
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                },
                getOpdRenja(pageUrl) {
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    this.errorMessage = "";
                    axios.get(this.urlRenja, {
                            params: {
                                page: pageUrl,
                                opd_search: this.opd_search,
                                year_search: this.year_search,
                                type_search: this.type_search,
                            }
                        })
                        .then(response => (
                            this.dataRenja = response.data.renja_datas.data,
                            this.paginationRenja = response.data.renja_datas
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                },
                getOpdCascadingKinerja(pageUrl) {
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    this.errorMessage = "";
                    axios.get(this.urlCascadingKinerja, {
                            params: {
                                page: pageUrl,
                                opd_search: this.opd_search,
                                year_search: this.year_search,
                                type_search: this.type_search,
                            }
                        })
                        .then(response => (
                            this.dataCascadingKinerja = response.data.cascading_kinerja_datas.data,
                            this.paginationCascadingKinerja = response.data.cascading_kinerja_datas
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                },
                setRouteName(routeName) {
                    this.routeName = routeName;
                    const url = new URL(window.location);
                    url.searchParams.set('name', routeName.toLowerCase());
                    window.history.pushState({}, '', url);
                }

            },
        }).mount('#app')
    </script>
@endpush
