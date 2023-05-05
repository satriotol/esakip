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
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>
    <div class="row">
        <div class="col-md-6">
            @if ($rencanaAksi->status != 'DISETUJUI')
                @include('rencanaAksi.components.formRencanaAksiTarget')
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
                            <label class="form-label">Status Pengajuan</label>
                            <select name="status" required class="form-control" @disabled(Auth::user()->opd_id)>
                                <option value="">Pilih Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @selected($status == $rencanaAksi->status)>
                                        {{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($rencanaAksi->status == 'DISETUJUI')
                            <div class="mb-3">
                                <label class="form-label">Status Penilaian</label>
                                <select name="status_penilaian" class="form-control" @disabled(Auth::user()->opd_id)>
                                    <option value="">Pilih Status Penilaian</option>
                                    @foreach ($penilaians as $penilaian)
                                        <option value="{{ $penilaian }}" @selected($penilaian == $rencanaAksi->status_penilaian)>
                                            {{ $penilaian }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
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
                            @if ($rencanaAksi->status != 'DISETUJUI')
                                @include('rencanaAksi.components.tableDiajukan')
                            @elseif($rencanaAksi->status_penilaian == 'SELESAI' && Auth::user()->opd_id == null)
                                @include('rencanaAksi.components.tableDisetujui')
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
