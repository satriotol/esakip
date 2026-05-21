@extends('frontend.layouts.main')

@push('css')
<style>
    .eval-hero {
        background: linear-gradient(135deg, #e65100 0%, #b73333 100%);
        margin-top: -76px;
        padding: 140px 0 88px;
        position: relative; overflow: hidden;
    }
    @media (max-width: 991px) {
        .eval-hero { margin-top: -68px; padding-top: 120px; }
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
    .eval-card {
        background: #fff; border-radius: 18px;
        box-shadow: 0 10px 50px rgba(0,0,0,.10); overflow: hidden;
    }
    .eval-card-header {
        padding: 20px 28px;
        background: #fafafa; border-bottom: 1px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
    }
    .eval-card-title {
        font-size: 1rem; font-weight: 700; color: #222;
        display: flex; align-items: center; gap: 10px; margin: 0;
    }
    .eval-card-title i { color: #e65100; }
    .eval-info-badge {
        font-size: .76rem; font-weight: 600;
        background: #fff3e0; color: #e65100;
        padding: 4px 14px; border-radius: 50px;
    }

    .eval-table-wrap { padding: 0; overflow-x: auto; }
    .eval-table {
        width: 100%; border-collapse: collapse; font-size: .82rem;
        min-width: 600px;
    }
    .eval-table thead tr:first-child th {
        background: #37474f; color: #fff;
        padding: 12px 14px; font-weight: 700;
        font-size: .76rem; text-transform: uppercase; letter-spacing: .4px;
        border: 1px solid rgba(255,255,255,.1);
    }
    .eval-table thead tr:nth-child(2) th {
        background: #e65100; color: #fff;
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
        text-align: center;
    }
    .eval-table tbody tr:hover { background: #fafafa; }
    .eval-table tbody td:first-child {
        font-weight: 600; color: #333; background: #fafafa;
        font-size: .8rem; text-align: left; min-width: 180px;
    }

    .loading-wrap {
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        padding: 80px 20px; gap: 16px;
    }
    .spinner-ring {
        width: 48px; height: 48px;
        border: 4px solid #f0f0f0;
        border-top-color: #e65100;
        border-radius: 50%;
        animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush

@section('content')

    <div class="eval-hero text-center text-white">
        <div class="container">
            <h1><i class="fa fa-history" style="margin-right:10px;"></i>Evaluasi Internal 2019&ndash;2023</h1>
            <p>Rekap historis hasil evaluasi AKIP seluruh OPD &mdash; Pemerintah Kota Semarang</p>
        </div>
    </div>

    <div class="eval-main">
        <div class="container">
            <div id="app">
                <div class="eval-card">
                    <div class="eval-card-header">
                        <h5 class="eval-card-title">
                            <i class="fa fa-table"></i> Rekap Nilai AKIP per OPD (2019&ndash;2023)
                        </h5>
                        <span class="eval-info-badge">Periode 2019 &ndash; 2023</span>
                    </div>

                    <div v-if="!dataEvaluasiKinerjaAkip" class="loading-wrap">
                        <div class="spinner-ring"></div>
                        <span style="color:#999;font-size:.88rem;">Memuat data evaluasi&hellip;</span>
                    </div>

                    <div v-else class="eval-table-wrap">
                        <table class="eval-table">
                            <thead>
                                <tr>
                                    <th rowspan="3" style="text-align:left;">OPD</th>
                                    <th v-for="data in dataYears" colspan="2" class="text-center">@{{ data.year }}</th>
                                </tr>
                                <tr>
                                    <template v-for="data in dataYears">
                                        <th colspan="2" class="text-center">Hasil</th>
                                    </template>
                                </tr>
                                <tr>
                                    <template v-for="data in dataYears">
                                        <th>Nilai</th>
                                        <th>Kategori</th>
                                    </template>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="data in dataEvaluasiKinerjaAkip" :key="data.name">
                                    <td>@{{ data.name }}</td>
                                    <template v-for="(hasil, i) in data.hasil">
                                        <td :style="{
                                                background: hasil.category_color,
                                                color: hasil.category_font,
                                                fontWeight: '700'
                                            }">
                                            @{{ hasil.value }}
                                        </td>
                                        <td :style="{
                                                background: hasil.category_color,
                                                color: hasil.category_font,
                                                fontWeight: '700'
                                            }">
                                            @{{ hasil.category_name }}
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

@endsection

@push('script')
<script>
    const { createApp } = Vue;
    const API_URL = "{{ env('API_URL') }}";

    createApp({
        data() {
            return {
                dataEvaluasiKinerjaAkip: null,
                dataYears: [],
            };
        },
        mounted() {
            axios.get(API_URL + 'evaluasi_kinerja_akip')
                .then(res => {
                    this.dataEvaluasiKinerjaAkip = res.data.EvaluasiKinerjaAkip;
                    this.dataYears = res.data.years;
                })
                .catch(err => console.error(err));
        }
    }).mount('#app');
</script>
@endpush
