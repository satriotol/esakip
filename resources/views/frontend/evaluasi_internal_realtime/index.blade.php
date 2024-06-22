@extends('frontend.layouts.main')
@section('content')
    <div class="breadcrumb-area shadow theme-hard bg-fixed text-center text-light"
        style="background-image: url({{ asset('kotasemarangvector.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Evaluasi Internal</h1>
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
                            <h2>Evaluasi Internal</h2>
                        </div>
                    </div>
                </div>
                <div class="country-lists" style="margin-top: 10px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive ">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center">OPD</th>
                                            <th colspan="10" class="text-center">TAHUN</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" v-for="(data, index) in dataYears"
                                                style="background: #f25c6b" class="text-center">
                                                @{{ data }}
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
                                                Dokumen
                                            </th>
                                            <th colspan="1" style="background: #ff7c89" class="text-center">
                                                Nilai
                                            </th>
                                            <th colspan="1" style="background: #ff7c89" class="text-center">
                                                Kategori
                                            </th>
                                            <th colspan="1" style="background: #ff7c89" class="text-center">
                                                Dokumen
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="opd in opds">
                                            <td>
                                                @{{ opd.nama_opd }}
                                            </td>
                                            <template v-for="year in dataYears">
                                                <td v-if="getScore(opd.id, year)"
                                                    :style="{
                                                        backgroundColor: getScore(opd.id, year).warnaScore.color,
                                                        color: getScore(opd.id, year).warnaScore.font_color,
                                                        fontWeight: 'bold'
                                                    }">
                                                    @{{ getScore(opd.id, year).totalScore }}
                                                </td>
                                                <td v-else>-</td>
                                                <td v-if="getScore(opd.id, year)"
                                                    :style="{
                                                        backgroundColor: getScore(opd.id, year).warnaScore.color,
                                                        color: getScore(opd.id, year).warnaScore.font_color,
                                                        fontWeight: 'bold'
                                                    }">
                                                    @{{ getScore(opd.id, year).nilaiKarakter }}
                                                </td>
                                                <td v-else>-</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="" class="btn btn-success">LHE</a>
                                                        <a href="" class="btn btn-danger">TLHE</a>
                                                    </div>
                                                </td>
                                            </template>
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
                    opds: "",
                    dataYears: "",
                    scores: "",
                    urlEvaluasiKinerjaAkip: API_URL + 'evaluasi_kinerja_akip',
                }
            },
            mounted() {
                this.getKotaEvaluasiKinerjaAkip();
            },
            methods: {
                getKotaEvaluasiKinerjaAkip() {
                    axios.get("https://penilaian.e-sakip.semarangkota.go.id/api/v1/score")
                        .then(response => (
                            console.log(response),
                            this.opds = response.data.data.opds,
                            this.dataYears = response.data.data.years,
                            this.scores = response.data.data.scores
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                        .finally(() => this.loading = false)
                },
                getScore(opdId, year) {
                    if (this.scores[year]) {
                        let score = this.scores[year].find(s => s.opd_id === opdId);
                        if (score) {
                            return {
                                ...score,
                                totalScore: Math.round(score.totalScore * 100) / 100 // Membulatkan nilai totalScore
                            };
                        }
                    }
                    return null;
                },
                setRouteName(routeName) {
                    this.routeName = routeName;
                }
            },
        }).mount('#app')
    </script>
@endpush
