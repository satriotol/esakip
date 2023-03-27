@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaian.index') }}">Penilaian OPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Penilaian OPD</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Penilaian OPD</h6>
                    <ul>
                        <li> <a href="https://drive.google.com/drive/u/3/folders/1Mb6xWNUhrJHVTF1xM2Uh1nqUeCIEJgNG"
                                target="_blank">Manual Book OPD TIDAK DENGAN TARGET PENDAPATAN</a></li>
                        <li> <a href="https://drive.google.com/drive/u/3/folders/1ZW2OUEF24VqUBGbFiMKiVgCogdKMGh33"
                                target="_blank">Manual Book OPD DENGAN TARGET PENDAPATAN</a></li>
                        <li> <a href="https://drive.google.com/drive/u/3/folders/1Hw8tmaHIbseavXSwZaT0KnR-WdtOS5FY"
                                target="_blank">Manual Book STAFF AHLI</a></li>
                    </ul>

                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('opdPenilaian.create') }}">
                            <i data-feather="plus"></i>
                            Tambah Penilaian
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>OPD</label>
                                            <select name="opd_id" class="js-example-basic-single form-select"
                                                id="">
                                                <option value="">Pilih OPD</option>
                                                @foreach ($opds as $opd)
                                                    <option @selected(old('opd_id') == $opd->id) value="{{ $opd->id }}">
                                                        {{ $opd->nama_opd }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <label>Tahun</label>
                                        <input type="number" class="form-control" name="year"
                                            value="{{ old('year') }}" id="">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select name="status" class="js-example-basic-single form-select"
                                                id="">
                                                <option value="">Pilih Status</option>
                                                @foreach ($statuses as $status)
                                                    <option @selected(old('status') == $status) value="{{ $status }}">
                                                        {{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button name="submit" value="exportExcel" class="btn btn-sm btn-success">Export
                                            Excel</button>
                                        <button name="submit" class="btn btn-sm btn-success">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <table class="table">
                                <tr>
                                    <td>
                                        <div class="badge bg-danger">Sangat Kurang</div>
                                    </td>
                                    <td>
                                        0-59
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="badge bg-warning">Kurang</div>
                                    </td>
                                    <td>
                                        60-69
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="badge bg-info">Butuh Perbaikan</div>
                                    </td>
                                    <td>
                                        70-79
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="badge bg-primary">Baik</div>
                                    </td>
                                    <td>
                                        80-89
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="badge bg-success">Istimewa</div>
                                    </td>
                                    <td>
                                        90-100
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Perjanjian Kinerja</th>
                                    <th>Kategori</th>
                                    <th>OPD</th>
                                    <th class="d-none">Inovasi Prestasi Daerah</th>
                                    <th>Predikat</th>
                                    <th>Status Verifikasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPenilaians as $opdPenilaian)
                                    <tr>
                                        <td>{{ $opdPenilaian->year }} {{ $opdPenilaian->name }}</td>
                                        <td>
                                            @isset($opdPenilaian->opd_perjanjian_kinerja_id)
                                                <a href="{{ route('opdPerjanjianKinerja.show', $opdPenilaian->opd_perjanjian_kinerja_id) }}"
                                                    target="_blank">
                                                    {{ $opdPenilaian->opd_perjanjian_kinerja->type }}
                                                </a>
                                            @endisset
                                        </td>
                                        <td class="text-wrap">{{ $opdPenilaian->opd_category->name }}</td>
                                        <td class="text-wrap">{{ $opdPenilaian->opd->nama_opd }}</td>
                                        <td class="d-none">{{ $opdPenilaian->inovasi_prestasi_daerah ?? 'TRIWULAN' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $opdPenilaian->totalAkhirPredikat()['color'] }}">
                                                {{ $opdPenilaian->totalAkhir() }} <br>
                                                {{ $opdPenilaian->totalAkhirPredikat()['name'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="badge bg-success">{{ $opdPenilaian->status }}</div>
                                        </td>
                                        <td>
                                            @if ($opdPenilaian->status == 'BELUM' || $opdPenilaian->status == 'PENGEMBALIAN')
                                                <a href="{{ route('opdPenilaian.show', $opdPenilaian->id) }}"
                                                    class="btn btn-sm btn-primary ml-1">Detail</a>
                                                @if (!Auth::user()->opd_id)
                                                    <a href="{{ route('opdPenilaian.edit', $opdPenilaian->id) }}"
                                                        class="btn btn-sm btn-primary ml-1">Inovasi Prestasi</a>
                                                @endif
                                                <form action="{{ route('opdPenilaian.destroy', $opdPenilaian->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('opdPenilaian.exportDetailPdf', $opdPenilaian->id) }}"
                                                    target="_blank" class="btn btn-sm btn-danger">Cetak Detail Penilaian</a>
                                                <br>
                                                <a href="{{ route('opdPenilaian.exportPdf', $opdPenilaian->id) }}"
                                                    target="_blank" class="btn btn-sm btn-warning">Cetak Timbal Balik</a>
                                                <br>
                                                <a href="{{ route('opdPenilaian.showReport', $opdPenilaian->id) }}"
                                                    class="btn btn-sm btn-primary ml-1">Detail Timbal Balik</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $opdPenilaians->appends($_GET)->links() }}
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
