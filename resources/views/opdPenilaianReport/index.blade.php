@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaianReport.index') }}">Desk Penilaian OPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Desk Penilaian OPD</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Desk Penilaian OPD</h6>
                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>OPD</label>
                                    <select name="opd_id" class="js-example-basic-single form-select" id="">
                                        <option value="">Pilih OPD</option>
                                        @foreach ($opds as $opd)
                                            <option @selected(old('opd_id') == $opd->id) value="{{ $opd->id }}">
                                                {{ $opd->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Kategori OPD</label>
                                    <select name="opd_category_id" class="js-example-basic-single form-select"
                                        id="">
                                        <option value="">Pilih Kategori OPD</option>
                                        @foreach ($opdCategories as $opdCategory)
                                            <option @selected(old('opd_category_id') == $opdCategory->id) value="{{ $opdCategory->id }}">
                                                {{ $opdCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="year" value="{{ old('year') }}"
                                    id="">
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="js-example-basic-single form-select" id="">
                                        <option value="">Pilih Status</option>
                                        @foreach ($statuses as $status)
                                            <option @selected(old('status') == $status) value="{{ $status }}">
                                                {{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-sm btn-success">Cari</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Perjanjian Kinerja</th>
                                    <th>Kategori</th>
                                    <th>OPD</th>
                                    <th>Inovasi Prestasi Daerah</th>
                                    <th>Total Akhir</th>
                                    <th>Status Verifikasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPenilaianReports as $opdPenilaianReport)
                                    <tr>
                                        <td>{{ $opdPenilaianReport->year }} {{ $opdPenilaianReport->name }}</td>
                                        <td>
                                            <a href="{{ route('opdPerjanjianKinerja.show', $opdPenilaianReport->opd_perjanjian_kinerja_id) }}"
                                                target="_blank">
                                                {{ $opdPenilaianReport->opd_perjanjian_kinerja->type }}
                                            </a>
                                        </td>
                                        <td>{{ $opdPenilaianReport->opd_category->name }}</td>
                                        <td>{{ $opdPenilaianReport->opd->nama_opd }}</td>
                                        <td>{{ $opdPenilaianReport->inovasi_prestasi_daerah ?? 'TRIWULAN' }}</td>
                                        <td>{{ $opdPenilaianReport->totalAkhir() }}</td>
                                        <td>
                                            <div class="badge bg-success">{{ $opdPenilaianReport->status }}</div>
                                        </td>
                                        <td>

                                            <a href="{{ route('opdPenilaianReport.show', $opdPenilaianReport->id) }}"
                                                class="btn btn-sm btn-primary ml-1">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $opdPenilaianReports->links() }}
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
