@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPerjanjianKinerja.index') }}">{{ $name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card" id="app">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <div class="mb-3">
                    <label class="form-label">Sasaran</label>
                    <select name="" class="form-control" v-model="form.opd_perjanjian_kinerja_sasaran_id" required>
                        <option value="">Pilih Sasaran</option>
                        @foreach ($rencanaAksi->opd_perjanjian_kinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                            <option value="{{ $opd_perjanjian_kinerja_sasaran->id }}">
                                {{ $opd_perjanjian_kinerja_sasaran->sasaran }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Realisasi</label>
                    <select name="" class="form-control" v-model="form.realisasi" required>
                        <option value="">Pilih Realisasi</option>
                        @foreach ($realisasis as $realisasi)
                            <option value="{{ $realisasi }}">
                                {{ $realisasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Target</label>
                    <textarea name="" class="form-control" v-model="form.target" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Rencana Aksi</label>
                    <textarea name="" class="form-control" v-model="form.rencana_aksi" required></textarea>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" @click="postData()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    message: 'Hello Vue!',
                    form: {
                        opd_perjanjian_kinerja_sasaran_id: "",
                        rencana_aksi_id: {{ $rencanaAksi->id }},
                        target: "",
                        realisasi: "",
                        rencana_aksi: "",
                    }
                }
            },
            methods: {
                postData() {
                    axios.post('/administrator/rencanaAksiTarget', this.form)
                        .then((response) => {
                            this.form.opd_perjanjian_kinerja_sasaran_id = "";
                            this.form.target = "";
                            this.form.realisasi = "";
                            this.form.rencana_aksi = "";
                            iziToast.success({
                                title: 'OK',
                                message: 'Successfully',
                            });
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                getData(){
                    
                }
            },
        }).mount('#app')
    </script>
@endpush
