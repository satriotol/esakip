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
            <li class="breadcrumb-item active" aria-current="page">Form Rencana Aksi Target</li>
        </ol>
        <a href="{{ route('rencanaAksi.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div id="app">
        <div class="row">
            @if (!$rencanaAksi->status_penilaian)
                <div class="col-md-6">
                    @if (($rencanaAksi->status != 'DISETUJUI' && Auth::user()->opd_id) || Auth::user()->hasRole('SUPERADMIN'))
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form {{ $rencanaAksi->opd_perjanjian_kinerja->opd_name }}
                                    {{ $rencanaAksi->opd_perjanjian_kinerja->year }} {{ $rencanaAksi->name }}</h4>
                                @include('partials.errors')
                                <div class="mb-3">
                                    <label class="form-label">Sasaran</label>
                                    <select name="" class="form-control"
                                        v-model="form.opd_perjanjian_kinerja_sasaran_id" required>
                                        <option value="">Pilih Sasaran</option>
                                        @foreach ($rencanaAksi->opd_perjanjian_kinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                                            <option value="{{ $opd_perjanjian_kinerja_sasaran->id }}">
                                                {{ $opd_perjanjian_kinerja_sasaran->sasaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Rencana Aksi</label>
                                    <textarea name="" class="form-control" v-model="form.rencana_aksi_note" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Indikator</label>
                                    <textarea name="" class="form-control" v-model="form.indikator_kinerja_note" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tipe</label>
                                    <select name="" class="form-control" v-model="form.type" required>
                                        <option value="">Pilih tipe</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type }}">
                                                {{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Target</label>
                                            <input type="number" v-model="form.target" required class="form-control"
                                                name="" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Satuan</label>
                                            <input type="text" v-model="form.satuan" required class="form-control"
                                                name="" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary" disabled v-if="loading">Loading</button>
                                    <button class="btn btn-primary" @click="postData()" v-else="loading">Submit</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Status</h4>
                            <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" method="post">
                                @csrf
                                @include('partials.errors')
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" required class="form-control" @disabled(Auth::user()->opd_id)
                                        required>
                                        <option value="">Pilih Status</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}" @selected($status == $rencanaAksi->status)>
                                                {{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="form-lable">Note</label>
                                    <textarea @disabled(Auth::user()->opd_id) name="note" class="form-control">{{ $rencanaAksi->note }}</textarea>
                                    <small>Tambahkan Catatan Jika Ditolak</small>
                                </div>
                                @if (!Auth::user()->opd_id)
                                    <div class="text-end">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                @endif
                            </form>

                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Penilaian</h4>
                            @include('partials.errors')
                            <form action="{{ route('rencanaAksi.updateStatusPenilaian', $rencanaAksi->id) }}"
                                method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Predikat Penilaian</label>
                                    <select name="nilai" id="" class="js-example-basic-single form-select"
                                        @disabled(Auth::user()->opd_id) required>
                                        <option value="">Pilih Predikat Penilaian</option>
                                        @foreach ($predikats as $predikat)
                                            <option value="{{ $predikat }}" @selected($predikat == $rencanaAksi->nilai)>
                                                {{ $predikat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel Rencana Aksi Target</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Sasaran</th>
                                    <th>Rencana Aksi</th>
                                    <th>Indikator</th>
                                    <th>Target</th>
                                    @if ($rencanaAksi->status == 'DISETUJUI')
                                        <th>Realisasi</th>
                                    @endif
                                    <th>Satuan</th>
                                    @if ($rencanaAksi->status == 'DISETUJUI')
                                        <th>Capaian</th>
                                    @endif
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index) in datas">
                                        <td>@{{ data.opd_perjanjian_kinerja_sasaran_name }}
                                            <select name="" class="form-control" v-model="data.type" required>
                                                <option value="">Pilih tipe</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type }}">
                                                        {{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <textarea v-model='data.rencana_aksi_note' class="form-control" name="" id=""
                                                :readonly="data.rencana_aksi.status == 'DISETUJUI'"></textarea>
                                        </td>
                                        <td>
                                            <textarea v-model='data.indikator_kinerja_note' :readonly="data.rencana_aksi.status == 'DISETUJUI'"
                                                class="form-control" name="" id=""></textarea>
                                        </td>
                                        <td>
                                            <input type="number" :readonly="data.rencana_aksi.status == 'DISETUJUI'"
                                                v-model='data.target' class="form-control" name=""
                                                id="">
                                        </td>
                                        @if ($rencanaAksi->status == 'DISETUJUI')
                                            <td>
                                                <input type="text" v-model='data.realisasi' class="form-control"
                                                    name="" id=""
                                                    :readonly="data.rencana_aksi.status_penilaian">
                                            </td>
                                        @endif
                                        <td>
                                            <input type="text" class="form-control" v-model='data.satuan'
                                                :readonly="data.rencana_aksi.status == 'DISETUJUI'" name=""
                                                id="">
                                        </td>
                                        @if ($rencanaAksi->status == 'DISETUJUI')
                                            <td>
                                                @{{ data.capaian }}
                                            </td>
                                        @endif
                                        <td>
                                            @if (Auth::user()->opd_id || Auth::user()->hasRole('SUPERADMIN'))
                                                @if (!$rencanaAksi->status_penilaian)
                                                    <button class="badge bg-warning"
                                                        @click='updateData(data.id, index)'>Update</button><br>
                                                    <button class="badge bg-danger"
                                                        v-if="data.rencana_aksi.status != 'DISETUJUI'"
                                                        @click='deleteData(data.id)'>Delete</button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <th colspan="6">Total Capaian</th>
                                    <th>@{{ total_capaian }}</th>
                                </tfoot>
                            </table>
                        </div>

                        @if ($rencanaAksi->status == 'DISETUJUI' && Auth::user()->opd_id)
                            @if (!$rencanaAksi->status_penilaian)
                                <div class="text-end mt-2">
                                    <a href="{{ route('rencanaAksi.updateStatusSelesai', $rencanaAksi->id) }}"
                                        class="btn btn-success" onclick="return confirm('Apakah Anda Yakin?')">Selesai</a>
                                </div>
                            @endif
                        @endif
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.7/dist/sweetalert2.all.min.js"></script>
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
                        satuan: "",
                        realisasi: "",
                        type: "",
                        rencana_aksi_note: "",
                        indikator_kinerja_note: "",
                    },
                    formStatus: {
                        status: "{{ $rencanaAksi->status }}",
                    },
                    total_capaian: 0,
                }
            },
            mounted() {
                this.getData();
            },
            methods: {
                postData() {
                    this.loading = true;
                    Swal.fire({
                        title: 'Loading',
                        icon: 'info',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    })
                    axios.post('{{ route('rencanaAksiTarget.store') }}', this.form)
                        .then((response) => {
                            this.form.opd_perjanjian_kinerja_sasaran_id = "";
                            this.form.target = "";
                            this.form.realisasi = "";
                            this.form.rencana_aksi_note = "";
                            this.form.satuan = "";
                            this.form.indikator_kinerja_note = "";
                            this.form.type = "";
                            Swal.fire(
                                'Sukses',
                                'Inputan Anda Berhasil Tersimpan',
                                'success'
                            )
                            this.getData();
                        })
                        .catch(function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error.response.data.message,
                            })
                        }).finally(() => {
                            this.loading = false;
                        });
                },
                getData() {
                    axios.get('/administrator/getRencanaAksiTarget/' + this.form.rencana_aksi_id)
                        .then((response) => {
                            this.loading = false;
                            this.datas = response.data.data;
                            this.total_capaian = response.data.total_capaian;
                        })
                },
                deleteData(id) {
                    if (confirm("Apakah Anda Yakin Menghapus Data Ini ?")) {
                        Swal.fire({
                            title: 'Loading',
                            icon: 'info',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            },
                        })
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
                            })
                            .finally(() => {
                                Swal.fire(
                                    'Sukses',
                                    'Data Anda Berhasil Dihapus',
                                    'success'
                                )
                            })
                    }
                },
                updateData(id, index) {
                    this.loading = true;
                    Swal.fire({
                        title: 'Loading',
                        icon: 'info',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    })
                    axios.put('/administrator/rencanaAksiTarget/' + id, this.datas[index])
                        .then((response) => {
                            Swal.fire(
                                'Sukses',
                                'Inputan Anda Berhasil Tersimpan',
                                'success'
                            )
                            this.getData();
                        })
                        .catch(function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error.response.data.message,
                            })
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                }
            },
        }).mount('#app')
    </script>
@endpush
