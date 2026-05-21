@extends('frontend.layouts.main')

@push('css')
<style>
    .eval-hero {
        background: linear-gradient(135deg, #6a1b9a 0%, #b73333 100%);
        padding: 64px 0 88px;
        position: relative; overflow: hidden;
    }
    .eval-hero::before, .eval-hero::after {
        content: ''; position: absolute; border-radius: 50%;
        background: rgba(255,255,255,.06);
    }
    .eval-hero::before { width: 400px; height: 400px; top: -120px; right: -80px; }
    .eval-hero::after  { width: 250px; height: 250px; bottom: -70px; left: -50px; }
    .eval-hero h1 { font-size: 2rem; font-weight: 700; margin-bottom: 6px; position: relative; z-index:1; }
    .eval-hero p  { opacity: .82; font-size: .95rem; margin: 0; position: relative; z-index:1; }

    .eval-main { margin-top: -48px; padding-bottom: 64px; position: relative; z-index: 2; }
    .eval-card  {
        background: #fff; border-radius: 18px;
        box-shadow: 0 10px 50px rgba(0,0,0,.10); overflow: hidden;
    }
    .eval-card-header {
        padding: 20px 28px;
        background: #fafafa;
        border-bottom: 1px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
    }
    .eval-card-title {
        font-size: 1rem; font-weight: 700; color: #222;
        display: flex; align-items: center; gap: 10px; margin: 0;
    }
    .eval-card-title i { color: #6a1b9a; }
    .eval-info-badge {
        font-size: .76rem; font-weight: 600;
        background: #f3e5f5; color: #6a1b9a;
        padding: 4px 14px; border-radius: 50px;
    }

    .eval-table-wrap { padding: 0; overflow-x: auto; }
    .eval-table {
        width: 100%; border-collapse: collapse; font-size: .82rem;
        min-width: 700px;
    }
    .eval-table thead tr:first-child th {
        background: #37474f; color: #fff;
        padding: 12px 14px; font-weight: 700;
        font-size: .76rem; text-transform: uppercase; letter-spacing: .4px;
        border: 1px solid rgba(255,255,255,.1);
    }
    .eval-table thead tr:nth-child(2) th {
        background: #b73333; color: #fff;
        padding: 10px 12px; font-weight: 700;
        font-size: .76rem; text-transform: uppercase;
        border: 1px solid rgba(255,255,255,.15);
    }
    .eval-table thead tr:nth-child(3) th {
        background: #f8f9fa; color: #777;
        padding: 9px 12px; font-weight: 700;
        font-size: .72rem; text-transform: uppercase; letter-spacing: .3px;
        border: 1px solid #eee;
    }
    .eval-table tbody td {
        padding: 11px 14px;
        border: 1px solid #f0f0f0;
        vertical-align: middle;
    }
    .eval-table tbody tr:hover { background: #fafafa; }
    .eval-table tbody td:first-child {
        font-weight: 600; color: #333; background: #fafafa;
        font-size: .8rem; min-width: 180px;
    }
    .doc-btn {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 4px 10px; border-radius: 6px;
        font-size: .72rem; font-weight: 700;
        text-decoration: none; white-space: nowrap;
        transition: all .2s;
    }
    .doc-btn.available { background: #e8f5e9; color: #2e7d32; }
    .doc-btn.available:hover { background: #2e7d32; color: #fff; }
    .doc-btn.missing { background: #fdecea; color: #b73333; }
    .doc-btn.missing:hover { background: #b73333; color: #fff; }

    /* Loading overlay */
    .eval-loading {
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        padding: 80px 20px; gap: 16px;
    }
    .spinner-ring {
        width: 48px; height: 48px;
        border: 4px solid #f0f0f0;
        border-top-color: #6a1b9a;
        border-radius: 50%;
        animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush

@section('content')

    <div class="eval-hero text-center text-white">
        <div class="container">
            <h1><i class="fa fa-chart-line" style="margin-right:10px;"></i>Evaluasi Internal Realtime</h1>
            <p>Hasil evaluasi AKIP seluruh OPD &mdash; Pemerintah Kota Semarang</p>
        </div>
    </div>

    <div class="eval-main">
        <div class="container">
            <div id="app">
                <div class="eval-card">
                    <div class="eval-card-header">
                        <h5 class="eval-card-title">
                            <i class="fa fa-table"></i> Rekap Nilai AKIP per OPD
                        </h5>
                        <span class="eval-info-badge">Data Terkini</span>
                    </div>

                    <div v-if="loading" class="eval-loading">
                        <div class="spinner-ring"></div>
                        <span style="color:#999;font-size:.88rem;">Memuat data evaluasi&hellip;</span>
                    </div>

                    <div v-else class="eval-table-wrap">
                        <table class="eval-table">
                            <thead>
                                <tr>
                                    <th rowspan="3" style="min-width:180px;text-align:left;">OPD</th>
                                    <th v-for="year in dataYears" colspan="3" class="text-center">@{{ year }}</th>
                                </tr>
                                <tr>
                                    <template v-for="year in dataYears">
                                        <th colspan="3" class="text-center">Hasil</th>
                                    </template>
                                </tr>
                                <tr>
                                    <template v-for="year in dataYears">
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Dokumen</th>
                                    </template>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="opd in opds" :key="opd.id">
                                    <td>@{{ opd.nama_opd }}</td>
                                    <template v-for="year in dataYears">
                                        <template v-if="getScore(opd.id, year)">
                                            <td class="text-center"
                                                :style="{
                                                    background: getScore(opd.id, year).warnaScore.color,
                                                    color: getScore(opd.id, year).warnaScore.font_color,
                                                    fontWeight: '700'
                                                }">
                                                @{{ getScore(opd.id, year).totalScore }}
                                            </td>
                                            <td class="text-center"
                                                :style="{
                                                    background: getScore(opd.id, year).warnaScore.color,
                                                    color: getScore(opd.id, year).warnaScore.font_color,
                                                    fontWeight: '700'
                                                }">
                                                @{{ getScore(opd.id, year).nilaiKarakter }}
                                            </td>
                                            <td class="text-center"
                                                :style="{
                                                    background: getScore(opd.id, year).warnaScore.color,
                                                    color: getScore(opd.id, year).warnaScore.font_color,
                                                }">
                                                <div style="display:flex;gap:4px;justify-content:center;flex-wrap:wrap;">
                                                    <a target="_blank"
                                                        :href="getScore(opd.id, year).lhe_file ? getScore(opd.id, year).lhe_file_url : '#'"
                                                        :class="getScore(opd.id, year).lhe_file ? 'doc-btn available' : 'doc-btn missing'">
                                                        <i class="fa fa-file-pdf"></i> LHE
                                                    </a>
                                                    <a target="_blank"
                                                        :href="getScore(opd.id, year).tlhe_file ? getScore(opd.id, year).tlhe_file_url : '#'"
                                                        :class="getScore(opd.id, year).tlhe_file ? 'doc-btn available' : 'doc-btn missing'">
                                                        <i class="fa fa-file-pdf"></i> TLHE
                                                    </a>
                                                </div>
                                            </td>
                                        </template>
                                        <template v-else>
                                            <td class="text-center" style="color:#ccc;">—</td>
                                            <td class="text-center" style="color:#ccc;">—</td>
                                            <td class="text-center" style="color:#ccc;">—</td>
                                        </template>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                opds: [], dataYears: [], scores: {}, loading: true
            };
        },
        mounted() {
            this.loadData();
        },
        methods: {
            loadData() {
                this.loading = true;
                axios.get("https://penilaian.e-sakip.semarangkota.go.id/api/v1/score")
                    .then(res => {
                        this.opds      = res.data.data.opds;
                        this.dataYears = res.data.data.years;
                        this.scores    = res.data.data.scores;
                    })
                    .catch(() => {
                        Swal.fire({ icon: 'error', title: 'Gagal Memuat', text: 'Terjadi kesalahan saat mengambil data.' });
                    })
                    .finally(() => this.loading = false);
            },
            getScore(opdId, year) {
                if (!this.scores[year]) return null;
                return this.scores[year].find(s => s.opd_id === opdId.toString()) || null;
            }
        }
    }).mount('#app');
</script>
@endpush
