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
                            <h2>{{ $name }}</h2>
                        </div>
                    </div>
                </div>
                <div class="country-lists" style="margin-top: 10px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center">OPD</th>
                                            <th colspan="10" class="text-center">TAHUN</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" v-for="data in dataEvaluasiKinerjaAkip"
                                                style="background: #f25c6b" class="text-center">
                                                @{{ data.year }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="1" style="background: #ff7c89" class="text-center">
                                                Nilai
                                            </th>
                                            <th colspan="1" style="background: #ff7c89" class="text-center">
                                                Kategori
                                            </th>
                                            <th colspan="1" style="background: #ff7c89" class="text-center">
                                                Nilai
                                            </th>
                                            <th colspan="1" style="background: #ff7c89" class="text-center">
                                                Kategori
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="data in dataOpd[0]">
                                            <td>
                                                @{{ data.opd_name }}
                                            </td>
                                            <td>
                                                @{{ data.value }}
                                            </td>
                                            <td>
                                                @{{ data.category_name.name }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                    dataEvaluasiKinerjaAkip: "",
                    dataOpd: "",
                    urlEvaluasiKinerjaAkip: API_URL + 'evaluasi_kinerja_akip',
                }
            },
            mounted() {
                this.getKotaEvaluasiKinerjaAkip();
            },
            methods: {
                getKotaEvaluasiKinerjaAkip(pagUrl) {
                    axios.get(this.urlEvaluasiKinerjaAkip)
                        .then(response => (
                            this.dataEvaluasiKinerjaAkip = response.data.EvaluasiKinerjaAkip,
                            this.dataOpd0 = response.data.EvaluasiKinerjaAkip.evaluasi_kinerja
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
