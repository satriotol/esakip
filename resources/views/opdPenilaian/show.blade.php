@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaian.index') }}">Penilaian OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Penilaian OPD</li>
        </ol>
        <a href="{{ route('opdPenilaian.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Penilaian OPD</h4>
                    @include('partials.errors')
                    <div class="mb-3">
                        <p>Tahun : {{ $opdPenilaian->year }} {{ $opdPenilaian->name }} <br>
                            OPD : {{ $opdPenilaian->opd->nama_opd }} <br>
                            Kategori : {{ $opdPenilaian->opd_category->name }} <br>
                            Inovasi Prestasi Daerah : {{ $opdPenilaian->inovasi_prestasi_daerah }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Penilaian Opd</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Variabel</th>
                                    <th>Bobot</th>
                                    <th>Target</th>
                                    <th>Realisasi</th>
                                    <th>Capaian</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPenilaian->opd_category->opd_category_variables as $opd_category_variable)
                                    <tr>
                                        <td>
                                            {{ $opd_category_variable->opd_variable->name }} |
                                            @if ($opd_category_variable->opd_variable->pic == 'BAPENDA')
                                                <a
                                                    href="{{ route('opdPenilaianKinerja.getRealisasiTargetPendapatan', [$opdPenilaian->opd->nama_opd, $opdPenilaian->id, $opd_category_variable->id]) }}">Tarik
                                                    Data</a>
                                            @else
                                                <button type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $opd_category_variable->id }}">
                                                    {{ $opd_category_variable->opd_variable->pic }}
                                                </button>
                                                <div class="modal fade" id="exampleModal{{ $opd_category_variable->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    {{ $opd_category_variable->opd_variable->name }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('opdPenilaianKinerja.store') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" value="{{ $opdPenilaian->id }}"
                                                                        name="opd_penilaian_id" id="">
                                                                    <input type="hidden"
                                                                        value="{{ $opd_category_variable->id }}"
                                                                        name="opd_category_variable_id" id="">
                                                                    <div class="mb-3">
                                                                        <label>Target</label>
                                                                        <input type="text" class="form-control"
                                                                            name="target" required id="">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Realisasi</label>
                                                                        <input type="text" class="form-control"
                                                                            name="realisasi" required id="">
                                                                    </div>
                                                                    <div class="text-end">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $opd_category_variable->opd_variable->bobot }}
                                        </td>
                                        <td>
                                            {{ number_format((float) $opdPenilaian->target($opd_category_variable->id)) }}
                                        </td>
                                        <td>
                                            {{ number_format((float) $opdPenilaian->realisasi($opd_category_variable->id)) }}
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->capaian($opd_category_variable->id) }} %
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->nilai_akhir($opd_category_variable->id) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center">Total</td>
                                    <td>{{ $opdPenilaian->opd_category->total_bobot }}</td>
                                    <td colspan="3" class="text-center">Total</td>
                                    <td>{{ $opdPenilaian->totalNilaiAkhir() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        Inovasi dan Prestasi Daerah
                                    </td>
                                    <td>{{ $opdPenilaian->inovasi_prestasi_daerah }}</td>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-center">Total Akhir</th>
                                    <th>{{ $opdPenilaian->totalAkhir() }}
                                    </th>
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
@endpush