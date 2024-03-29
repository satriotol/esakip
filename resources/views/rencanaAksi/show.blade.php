@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('rencanaAksi.index') }}">{{ $name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail {{ $name }}
                {{ $rencanaAksi->opd_perjanjian_kinerja->opd_name }} {{ $rencanaAksi->opd_perjanjian_kinerja->year }}</li>
        </ol>
        <a href="{{ route('rencanaAksi.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </nav>
    <div class="row">
        <div class="col-md-6">
            @if ($rencanaAksi->status != 'DISETUJUI' && $rencanaAksi->status != 'PROSES')
                @include('rencanaAksi.components.formRencanaAksiTarget')
            @else
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td>{{ $rencanaAksi->opd_perjanjian_kinerja->year }} {{ $rencanaAksi->name }}</td>
                                </tr>
                                <tr>
                                    <td>OPD</td>
                                    <td>:</td>
                                    <td class="text-wrap">{{ $rencanaAksi->opd_perjanjian_kinerja->opd->nama_opd }}</td>
                                </tr>
                                <tr>
                                    <td>Perjanjian Kinerja</td>
                                    <td>:</td>
                                    <td class="text-wrap">
                                        <a href="{{ route('opdPerjanjianKinerja.show', $rencanaAksi->opd_perjanjian_kinerja_id) }}"
                                            target="_blank">
                                            {{ $rencanaAksi->opd_perjanjian_kinerja->type }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{{ $rencanaAksi->getStatusNow() }}</td>
                                </tr>
                                <tr>
                                    <td>Total Nilai</td>
                                    <td>:</td>
                                    <td>
                                        <h3>{{ $rencanaAksi->getTotalCapaian($rencanaAksi->id) }}</h3>
                                    </td>
                                </tr>
                                @isset($rencanaAksi->verifikator)
                                    <tr>
                                        <td>Nama Verifikator</td>
                                        <td>:</td>
                                        <td>{{ $rencanaAksi->verifikator->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan Verifikator</td>
                                        <td>:</td>
                                        <td>{{ $rencanaAksi->verifikator->jabatan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor HP Verifikator</td>
                                        <td>:</td>
                                        <td><a target="_blank"
                                                href="https://wa.me/{{ $rencanaAksi->verifikator->phone }}">{{ $rencanaAksi->verifikator->phone }}</a>
                                        </td>
                                    </tr>
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        @can('rencanaAksi-create')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Status</h4>
                        <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" method="post">
                            @csrf
                            @include('partials.errors')
                            <div class="mb-3">
                                {!! Form::label('note', 'Catatan', ['class' => 'form-label']) !!}
                                @if (!Auth::user()->opd_id)
                                    {!! Form::textarea('note', $rencanaAksi->note, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Masukkan Catatan',
                                    ]) !!}
                                @else
                                    : {{ $rencanaAksi->note }}
                                @endif
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
        @endcan
        <div class="col-md-12 grid-margin stretch-card mt-2">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tabel Rencana Aksi</h6>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <a href="{{ route('opdPerjanjianKinerja.show', $rencanaAksi->opd_perjanjian_kinerja_id) }}"
                                target="_blank">PERJANJIAN
                                KINERJA {{ $rencanaAksi->opd_perjanjian_kinerja->type }}
                                {{ $rencanaAksi->opd_perjanjian_kinerja->year }}</a>
                            @if ($rencanaAksi->status == 'PROSES')
                                @include('rencanaAksi.components.tableProsesDiajukan')
                            @elseif($rencanaAksi->status != 'DISETUJUI')
                                @include('rencanaAksi.components.tableDiajukan')
                            @elseif($rencanaAksi->status_penilaian == 'SELESAI')
                                @include('rencanaAksi.components.tableVerifikator')
                            @else
                                @include('rencanaAksi.components.tableDisetujui')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
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
            },
        }).mount('#app')
    </script>
@endpush
