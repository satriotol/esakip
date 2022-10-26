@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('rencanaAksi.index') }}">Rencana Aksi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Rencana Aksi</li>
        </ol>
        <a href="{{ route('rencanaAksi.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div id="app">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form {{ $rencanaAksi->opd_perjanjian_kinerja->opd_name }}
                            {{ $rencanaAksi->opd_perjanjian_kinerja->year }} {{ $rencanaAksi->name }}</h4>
                        @include('partials.errors')
                        <div class="mb-3">
                            <label class="form-label">Sasaran</label>
                            <select name="" class="form-control" v-model="form.opd_perjanjian_kinerja_sasaran_id"
                                required>
                                <option value="">Pilih Sasaran</option>
                                @foreach ($rencanaAksi->opd_perjanjian_kinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                                    <option value="{{ $opd_perjanjian_kinerja_sasaran->id }}">
                                        {{ $opd_perjanjian_kinerja_sasaran->sasaran }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Target</label>
                            <textarea name="" class="form-control" v-model="form.target" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rencana Aksi</label>
                            <textarea name="" class="form-control" v-model="form.rencana_aksi_note" required></textarea>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary" @click="postData()" :disabled="loading">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel Rencana Aksi Target</h4>
                        <table class="table table-responsive">
                            <thead>
                                <th>Sasaran</th>
                                <th>Status</th>
                                <th>Rencana Aksi</th>
                                <th>Target</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <tr v-for="(data, index) in datas">
                                    <td>@{{ data.opd_perjanjian_kinerja_sasaran_name }}</td>
                                    <td>@{{ data.status }}</td>
                                    <td>
                                        <input type="text" v-model='data.rencana_aksi_note' class="form-control"
                                            name="" id="">
                                    </td>
                                    <td>
                                        <input type="text" v-model='data.target' class="form-control" name=""
                                            id="">
                                    </td>
                                    <td>
                                        <button class="badge bg-warning"
                                            @click='updateData(data.id, index)'>Update</button><br>
                                        <button class="badge bg-danger" @click='deleteData(data.id)'>Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                    datas: [],
                    loading: true,
                    form: {
                        opd_perjanjian_kinerja_sasaran_id: "",
                        rencana_aksi_id: {{ $rencanaAksi->id }},
                        target: "",
                        realisasi: "",
                        rencana_aksi_note: "",
                    },
                }
            },
            mounted() {
                this.getData();
            },
            methods: {
                postData() {
                    this.loading = true;
                    axios.post('/administrator/rencanaAksiTarget', this.form)
                        .then((response) => {
                            this.form.opd_perjanjian_kinerja_sasaran_id = "";
                            this.form.target = "";
                            this.form.realisasi = "";
                            this.form.rencana_aksi_note = "";
                            iziToast.success({
                                title: 'OK',
                                message: 'Successfully',
                            });
                            this.getData();
                        })
                        .catch(function(error) {
                            console.log(error);
                            iziToast.error({
                                title: 'Error',
                                message: 'Terjadi Kesalahan',
                            });
                        }).finally(() => {
                            this.loading = false;
                        });
                },
                getData() {
                    axios.get('/administrator/getRencanaAksiTarget/' + this.form.rencana_aksi_id)
                        .then((response) => {
                            this.loading = false;
                            this.datas = response.data;
                        })
                },
                deleteData(id) {
                    if (confirm("Apakah Anda Yakin Menghapus Data Ini ?")) {
                        axios.delete('/administrator/rencanaAksiTarget/' + id)
                            .then((response) => {
                                iziToast.success({
                                    title: 'OK',
                                    message: 'Successfully',
                                });
                                this.getData();
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    }
                },
                updateData(id, index) {
                    axios.put('/administrator/rencanaAksiTarget/' + id, this.datas[index])
                        .then((response) => {
                            iziToast.success({
                                title: 'OK',
                                message: 'Successfully',
                            });
                            this.getData();
                        })
                        .catch(function(error) {
                            console.log(error);
                            iziToast.error({
                                title: 'Error',
                                message: 'Terjadi Kesalahan',
                            });
                        });
                }
            },
        }).mount('#app')
    </script>
@endpush
