@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@push('style')
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
        <div class="col-md-12">
            @include('partials.errors')
        </div>
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
                                        @isset($opdPenilaian->opd_perjanjian_kinerja_id)
                                            <a href="{{ route('opdPerjanjianKinerja.show', $opdPenilaian->opd_perjanjian_kinerja_id) }}"
                                                target="_blank">
                                                {{ $opdPenilaian->opd_perjanjian_kinerja->type }}
                                            </a>
                                        @endisset
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
                                    <td>{{ $opdPenilaian->inovasi_prestasi_daerah }} @isset($opdPenilaian->inovasi_prestasi_opd)
                                            / <a href="{{ asset('uploads/' . $opdPenilaian->inovasi_prestasi_opd->file) }}"
                                                target="_blank">Buka File</a>
                                        @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nilai Akhir</td>
                                    <td>:</td>
                                    <td>{{ $opdPenilaian->totalNilaiAkhir() }}</td>
                                </tr>
                                <tr>
                                    <th>Total Nilai Akhir</th>
                                    <th>:</th>
                                    <th>{{ $opdPenilaian->totalAkhir() }}</th>
                                </tr>
                                <div class="text-end">
                                    <small>Total Nilai Akhir</small>
                                    <h4>{{ $opdPenilaian->totalAkhir() }}</h4>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-body">
                    <h4 class="card-title">Status Penilaian OPD</h4>
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Catatan Kepala OPD</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        Kepala OPD wajib memberikan feedback pada penilaian kinerja OPD, sebagai syarat penarikan data ke
                        E-TPP OPD
                    </div>
                    @can('opdPenilaianFeedback-store')
                        <form action="{{ route('opd_penilaian_feedback.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="opd_penilaian_id" value="{{ $opdPenilaian->id }}">
                            <div class="form-group">
                                <label for="feedback">Feedback</label>
                                <textarea rows="5" name="feedback" id="feedback" class="form-control" required>{{ isset($opdPenilaian->opd_penilaian_feedback) ? $opdPenilaian->opd_penilaian_feedback->feedback : '' }}</textarea>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    @endcan
                    @cannot('opdPenilaianFeedback-store')
                        @if (isset($opdPenilaian->opd_penilaian_feedback))
                            <div class="alert alert-success" role="alert">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Tanggal</th>
                                            <td>{{ $opdPenilaian->opd_penilaian_feedback->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Feedback</th>
                                            <td class="text-wrap">{{ $opdPenilaian->opd_penilaian_feedback->feedback }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                Belum Ada Feedback
                            </div>
                        @endif
                    @endcannot

                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Penilaian Kinerja OPD</h6>
                    <div class="table-responsive">
                        <form action="{{ route('opdPenilaian.storeReport') }}" method="post">
                            @csrf
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Aspek</th>
                                        <th>Target</th>
                                        <th>Realisasi</th>
                                        <th>Nilai Akhir</th>
                                        <th>Capaian</th>
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
                                                    @include('opdPenilaian.modal')
                                                @endif
                                                <br>
                                                <small>{{ $opdPenilaian->getDate($opd_category_variable->id) }}</small>
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
                                            <td>
                                                <textarea @disabled(Auth::user()->opd_id || $opdPenilaian->status == 'SELESAI') placeholder="Masukan Catatan..." name="data[{{ $loop->index }}][catatan]"
                                                    class="form-control" id="" cols="30" rows="5">{{ $opdPenilaian->getOpdPenilaianReportValue($opd_category_variable->id)->catatan ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <textarea @disabled(Auth::user()->opd_id || $opdPenilaian->status == 'SELESAI') placeholder="Masukan Rekomendasi..."
                                                    name="data[{{ $loop->index }}][rekomendasi]" class="form-control" id="" cols="30" rows="5">{{ $opdPenilaian->getOpdPenilaianReportValue($opd_category_variable->id)->rekomendasi ?? '' }}</textarea>
                                                <input type="text" hidden
                                                    value="{{ $opd_category_variable->getOpdPenilaian($opdPenilaian->id)->id ?? '' }}"
                                                    name="data[{{ $loop->index }}][opd_penilaian_kinerja]" id="">
                                                <input type="text" hidden value="{{ $opdPenilaian->id }}"
                                                    name="opdPenilaian" id="">
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center" colspan="4">Total</td>
                                        <td>{{ $opdPenilaian->totalNilaiAkhir() }}</td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            @if (Auth::user()->opd_id == null && $opdPenilaian->status != 'SELESAI')
                                <div class="text-end">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            @endif
                        </form>

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
