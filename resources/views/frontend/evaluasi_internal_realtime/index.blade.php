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
                                                <td v-if="getScore(opd.id, year)"
                                                    :style="{
                                                        backgroundColor: getScore(opd.id, year).warnaScore.color,
                                                        color: getScore(opd.id, year).warnaScore.font_color,
                                                        fontWeight: 'bold'
                                                    }">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a target="_blank"
                                                            :href="getScore(opd.id, year) && getScore(opd.id, year).lhe_file !=
                                                                null ? getScore(opd.id, year).lhe_file_url : '#'"
                                                            :class="getScore(opd.id, year) && getScore(opd.id, year).lhe_file !=
                                                                null ? 'btn btn-success' : 'btn btn-danger'">LHE</a>
                                                        <a target="_blank"
                                                            :href="getScore(opd.id, year) && getScore(opd.id, year)
                                                                .tlhe_file !=
                                                                null ? getScore(opd.id, year).tlhe_file_url : '#'"
                                                            :class="getScore(opd.id, year) && getScore(opd.id, year)
                                                                .tlhe_file !=
                                                                null ? 'btn btn-success' : 'btn btn-danger'">TLHE</a>
                                                    </div>
                                                </td>
                                                <td v-else>-</td>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    loading: true
                }
            },
            mounted() {
                this.getKotaEvaluasiKinerjaAkip();
            },
            methods: {
                getKotaEvaluasiKinerjaAkip() {
                    Swal.fire({
                        title: 'Memuat data...',
                        text: 'Harap tunggu sebentar',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    this.loading = true
                    axios.get("https://penilaian.e-sakip.semarangkota.go.id/api/v1/score")
                        .then(response => (
                            this.opds = response.data.data.opds,
                            this.dataYears = response.data.data.years,
                            this.scores = response.data.data.scores
                        ))
                        .catch(function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Memuat Data',
                                text: 'Terjadi kesalahan saat mengambil data.',
                            });

                        })
                        .finally(() => {
                            Swal.close();
                        });
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
