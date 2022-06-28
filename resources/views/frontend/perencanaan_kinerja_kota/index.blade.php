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
                                <button :class="[routeName == 'RPJMD' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('RPJMD')">RPJMD</button>
                                <button :class="[routeName == 'RKPD' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('RKPD')">RKPD</button>
                                <button :class="[routeName == 'CASCADING KINERJA' ? 'btn btn-success' : 'btn btn-primary']"
                                    @click="setRouteName('CASCADING KINERJA')">CASCADING KINERJA</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="routeName == 'RPJMD'">
                    @include('frontend.perencanaan_kinerja_kota.rpjmd')
                </div>
                <div v-if="routeName == 'RKPD'">
                    @include('frontend.perencanaan_kinerja_kota.rkpd')
                </div>
                <div v-if="routeName == 'CASCADING KINERJA'">
                    @include('frontend.perencanaan_kinerja_kota.cascading_kinerja')
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
                    dataRkpd: "",
                    dataCascadingKinerja: "",
                    paginationRkpd: [],
                    paginationCascadingKinerja: [],
                    routeName: "RPJMD",
                    urlRkpd: API_URL + 'perencanaankinerjakota/rkpd',
                    urlCascadingKinerja: API_URL + 'perencanaankinerjakota/cascading_kinerja',
                    year_search: "",
                    name_search: "",
                    loading: true,
                }
            },
            mounted() {
                this.getKotaRkpd();
                this.getKotaCascadingKinerja();
            },
            methods: {
                getKotaRkpd(pageUrl) {
                    this.loading = true;
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    axios.get(this.urlRkpd, {
                            params: {
                                page: pageUrl,
                                name_search: this.name_search,
                                year_search: this.year_search
                            }
                        })
                        .then(response => (
                            this.dataRkpd = response.data.rkpd_datas.data,
                            this.paginationRkpd = response.data.rkpd_datas
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                        .finally(() => this.loading = false)
                },
                getKotaCascadingKinerja(pageUrl) {
                    this.loading = true;
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    axios.get(this.urlCascadingKinerja, {
                            params: {
                                page: pageUrl,
                                name_search: this.name_search,
                                year_search: this.year_search
                            }
                        })
                        .then(response => (
                            this.dataCascadingKinerja = response.data.cascading_kinerja_datas.data,
                            this.paginationCascadingKinerja = response.data.cascading_kinerja_datas
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
