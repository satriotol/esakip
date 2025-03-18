@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPerjanjianKinerja.index') }}">{{ $name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail {{ $name }}
                {{ $opdPerjanjianKinerja->opd_name }} {{ $opdPerjanjianKinerja->year }}</li>
        </ol>
        <a href="{{ route('opdPerjanjianKinerja.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div class="row">
        <div class="col-xl-12 main-content ps-xl-4 pe-xl-5">
            <marquee scrolldelay="1"behavior="alternate" onmouseover="this.stop()" onmouseout="this.start()"
                direction="right">Apabila Sasaran Dan Indikator Tidak Sesuai Dengan Tarikan Data, Bisa Melakukan Inputan
                Manual
            </marquee>
            <ul class="nav nav-tabs" id="myTab app" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" role="tab"
                        aria-controls="detail" aria-selected="true">Detail</a>
                </li>
                @can('opdPerjanjianKinerjaSasaran-list')
                    <li class="nav-item">
                        <a class="nav-link" id="sasaran-tab" data-bs-toggle="tab" data-bs-target="#sasaran" role="tab"
                            aria-controls="sasaran" aria-selected="false">1. Sasaran</a>
                    </li>
                @endcan
                @if ($opdPerjanjianKinerja->opd_perjanjian_kinerja_sasarans->count() > 0)
                    @can('opdPerjanjianKinerjaIndikator-list')
                        <li class="nav-item">
                            <a class="nav-link" id="indikator-tab"data-bs-toggle="tab" data-bs-target="#indikator"
                                role="tab" aria-controls="indikator" aria-selected="false">2. Indikator</a>
                        </li>
                    @endcan
                    {{-- @can('opdPerjanjianKinerjaProgramAnggaran-list')
                        <li class="nav-item">
                            <a class="nav-link" id="program_anggaran-tab" data-bs-toggle="tab"
                                data-bs-target="#program_anggaran" role="tab" aria-controls="program_anggaran"
                                aria-selected="false">3. Program Anggaran</a>
                        </li>
                    @endcan --}}
                @endif
            </ul>
            <div class="tab-content border border-top-0 p-3" id="myTabContent" style="background-color: white">
                <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Tahun</td>
                                        <td>:</td>
                                        <td>{{ $opdPerjanjianKinerja->year }}</td>
                                    </tr>
                                    <tr>
                                        <td>OPD</td>
                                        <td>:</td>
                                        <td>{{ $opdPerjanjianKinerja->opd_name }}
                                            ({{ $opdPerjanjianKinerja->id }} |
                                            {{ $opdPerjanjianKinerja->opd->data_unit->id_skpd ?? '-' }} )</td>
                                    </tr>
                                    <tr>
                                        <td>Tipe</td>
                                        <td>:</td>
                                        <td>{{ $opdPerjanjianKinerja->type }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <object data="{{ asset('uploads/' . $opdPerjanjianKinerja->file) }}" class="w-100 mt-1"
                                style="height: 550px" type="application/pdf">
                                <div>No online PDF viewer installed</div>
                            </object>
                        </div>
                        <div class="col-md-4">
                            @can('opdPerjanjianKinerja-edit')
                                <form action="{{ route('opdPerjanjianKinerja.updateStatus', $opdPerjanjianKinerja->id) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="status" id="" required class="form-control"
                                            {{ Auth::user()->opd_id ? 'disabled' : '' }}>
                                            <option value="">Pilih Status</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}"
                                                    {{ $status == $opdPerjanjianKinerja->status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Catatan</label>
                                        <textarea name="note" class="form-control" id="" cols="30" rows="10"
                                            {{ Auth::user()->opd_id ? 'disabled' : '' }}>{{ $opdPerjanjianKinerja->note }}</textarea>
                                    </div>
                                    <small class="text-danger">Pastikan Sasaran, Indikator dan Program Anggaran Sudah
                                        Terisi</small>
                                    @if (!Auth::user()->opd_id)
                                        <div class="text-end">
                                            <button class="btn btn-sm btn-success" type="submit">Update</button>
                                        </div>
                                    @endif
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="sasaran" role="tabpanel" aria-labelledby="sasaran-tab">
                    @include('pengukuran_kinerja.opd.opd_perjanjian_kinerja.sasaran.index')
                </div>
                <div class="tab-pane fade" id="indikator" role="tabpanel" aria-labelledby="indikator-tab">
                    @include('pengukuran_kinerja.opd.opd_perjanjian_kinerja.indikator.index')
                </div>
                {{-- <div class="tab-pane fade" id="program_anggaran" role="tabpanel" aria-labelledby="program_anggaran-tab">
                    @include('pengukuran_kinerja.opd.opd_perjanjian_kinerja.program_anggaran.index')
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.7/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"
        integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    message: 'Hello Vue!',
                }
            },
            mounted() {},
            methods: {
                opdPerjanjianKinerjaProgramAnggaran() {
                    Swal.fire({
                        title: 'Apakah Anda Yakin ?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Sedang Menarik Data',
                                icon: 'info',
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                allowOutsideClick: false
                            });
                            axios.get(
                                    '{{ route('opdPerjanjianKinerjaProgramAnggaran.store', $opdPerjanjianKinerja) }}'
                                )
                                .then((res) => {
                                    console.log(res);
                                    Swal.fire({
                                        title: 'Sukses',
                                        icon: 'success',
                                        confirmButtonText: 'Lanjut',
                                    }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                }).catch((err) => {
                                    Swal.fire({
                                        title: 'Error',
                                        icon: 'error',
                                        text: err.response.data.message,
                                        confirmButtonText: 'Ok',
                                    })
                                });
                        }
                    })

                },

                opdPerjanjianKinerjaSasaran() {
                    Swal.fire({
                        title: 'Apakah Anda Yakin ?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Sedang Menarik Data',
                                icon: 'info',
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                allowOutsideClick: false
                            });
                            // console.log(this.form);
                            axios.get(
                                    '{{ route('opdPerjanjianKinerjaSasaran.create', [$opdPerjanjianKinerja]) }}'
                                )
                                .then((res) => {
                                    console.log(res);
                                    Swal.fire({
                                        title: 'Sukses',
                                        icon: 'success',
                                        confirmButtonText: 'Lanjut',
                                    }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                }).catch((err) => {
                                    Swal.fire({
                                        title: 'Error',
                                        icon: 'error',
                                        text: err.response.data.message,
                                        confirmButtonText: 'Ok',
                                    })
                                });
                        }
                    })

                },
                opdPerjanjianKinerjaIndikator() {
                    Swal.fire({
                        title: 'Apakah Anda Yakin ?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Sedang Menarik Data',
                                icon: 'info',
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                allowOutsideClick: false
                            });
                            axios.get(
                                    '{{ route('opdPerjanjianKinerjaIndikator.create', [$opdPerjanjianKinerja]) }}'
                                )
                                .then((res) => {
                                    console.log(res);
                                    Swal.fire({
                                        title: 'Sukses',
                                        icon: 'success',
                                        confirmButtonText: 'Lanjut',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                }).catch((err) => {
                                    Swal.fire({
                                        title: 'Error',
                                        icon: 'error',
                                        text: err.response.data.message,
                                        confirmButtonText: 'Ok',
                                    })
                                });
                        }
                    })
                },
            }
        }, ).mount('#app')
    </script>
@endpush
