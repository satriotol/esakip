@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@push('style')
    <style>
        /* html {
            zoom: 100%;
        } */
    </style>
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
        @include('partials.errors')
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Penilaian OPD</h4>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Status</h6>
                    <form action="{{ route('opdPenilaian.updateStatus', $opdPenilaian->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="js-example-basic-single form-select" required
                                @disabled(Auth::user()->opd_id)>
                                <option value="">Pilih Status</option>
                                @foreach ($statuses as $status)
                                    <option @selected($status == $opdPenilaian->status) value="{{ $status }}">{{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Catatan</label>
                            <textarea name="note" class="form-control" @disabled(Auth::user()->opd_id)>{{ $opdPenilaian->note }}</textarea>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-sm btn-success" @disabled(Auth::user()->opd_id)
                                type="submit">Submit</button>
                        </div>
                    </form>
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
                                            @if ($opd_category_variable->opd_variable->pic == 'BAPENDA' && $checkStatus != 1)
                                                <a class="badge bg-primary"
                                                    href="{{ route('opdPenilaianKinerja.getRealisasiTargetPendapatan', [$opdPenilaian->opd->nama_opd, $opdPenilaian->id, $opd_category_variable->id]) }}">TARIK
                                                    DATA</a>
                                            @else
                                                @if ($opd_category_variable->opd_variable->pic == 'OPD' && Auth::user()->opd_id && $checkStatus != 1)
                                                    <a type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $opd_category_variable->id }}">
                                                        {{ $opd_category_variable->opd_variable->pic }}
                                                    </a>
                                                @elseif ($opd_category_variable->opd_variable->pic == 'SIPD' && $checkStatus != 1)
                                                    <a type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $opd_category_variable->id }}">
                                                        {{ $opd_category_variable->opd_variable->pic }}
                                                    </a>
                                                @elseif($opd_category_variable->opd_variable->pic == 'INSPEKTORAT' &&
                                                    Auth::user()->hasRole('INSPEKTORAT') &&
                                                    $checkStatus != 1)
                                                    <a type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $opd_category_variable->id }}">
                                                        {{ $opd_category_variable->opd_variable->pic }}
                                                    </a>
                                                @elseif(Auth::user()->hasRole('SUPERADMIN') && $checkStatus != 1)
                                                    <a type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $opd_category_variable->id }}">
                                                        {{ $opd_category_variable->opd_variable->pic }}
                                                    </a>
                                                @endif
                                                @include('opdPenilaian.modal')
                                            @endif
                                            <br>
                                            <small>{{ $opdPenilaian->getDate($opd_category_variable->id) }}</small>
                                        </td>
                                        <td>
                                            {{ $opd_category_variable->opd_variable->bobot }}%
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->target($opd_category_variable->id)[0] }}
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->realisasi($opd_category_variable->id) }}
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
