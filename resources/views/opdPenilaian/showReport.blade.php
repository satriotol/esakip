@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaian.index') }}">Desk Timbal Balik Penilaian OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Desk Timbal Balik Penilaian OPD</li>
        </ol>
        <a href="{{ route('opdPenilaian.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div class="row">
        @include('partials.errors')
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Desk Timbal Balik Penilaian OPD</h4>
                    <div class="mb-3">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td>{{ $opdPenilaian->year }} {{ $opdPenilaian->name }}</td>
                                </tr>
                                <tr>
                                    <td>OPD</td>
                                    <td>:</td>
                                    <td>{{ $opdPenilaian->opd->nama_opd }}</td>
                                </tr>
                                <tr>
                                    <td>Perjanjian Kinerja</td>
                                    <td>:</td>
                                    <td>
                                        <a href="{{ route('opdPerjanjianKinerja.show', $opdPenilaian->opd_perjanjian_kinerja_id) }}"
                                            target="_blank">
                                            {{ $opdPenilaian->opd_perjanjian_kinerja->type }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td>{{ $opdPenilaian->opd_category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Inovasi Prestasi Daerah</td>
                                    <td>:</td>
                                    <td>{{ $opdPenilaian->inovasi_prestasi_daerah }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Penilaian Kinerja OPD</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Aspek</th>
                                    <th>Nilai Akhir</th>
                                    <th>Catatan</th>
                                    <th>Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPenilaian->opd_category->opd_category_variables as $opd_category_variable)
                                    <tr>
                                        <td>
                                            {{ $opd_category_variable->opd_variable->name }}
                                            @if ($opd_category_variable->opd_variable->is_iku)
                                                <a type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $opd_category_variable->id }}">
                                                    Detail
                                                </a>
                                            @endif
                                            <br>
                                            <small>{{ $opdPenilaian->getDate($opd_category_variable->id) }}</small>
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->nilai_akhir($opd_category_variable->id) }}
                                        </td>
                                        <td>
                                            <textarea name="catatan" class="form-control" id="" cols="30" rows="5"></textarea>
                                        </td>
                                        <td>
                                            <textarea name="rekomendasi" class="form-control" id="" cols="30" rows="5"></textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" colspan="3">Total</td>
                                    <td>{{ $opdPenilaian->totalNilaiAkhir() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        Inovasi dan Prestasi Daerah
                                    </td>
                                    <td>{{ $opdPenilaian->inovasi_prestasi_daerah }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="3">Total Akhir</th>
                                    <th>{{ $opdPenilaian->totalAkhir() }}
                                    </th>
                                </tr>

                            </tfoot>
                        </table>
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
@endpush
