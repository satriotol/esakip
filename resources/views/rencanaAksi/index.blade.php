@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('rencanaAksi.index') }}">{{ $name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel {{ $name }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{ $name }}</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('rencanaAksi.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>OPD</label>
                                            <select name="opd_id" class="js-example-basic-single form-select"
                                                id="">
                                                <option value="">Pilih OPD</option>
                                                @foreach ($opds as $opd)
                                                    <option {{ old('opd_id') == $opd->id ? 'selected' : '' }}
                                                        value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tahun</label>
                                        <input type="number" class="form-control" name="year"
                                            value="{{ old('year') }}" id="">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-sm btn-success">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <h6 class="card-title">Indikator</h6>
                            <div class="badge bg-warning">Belum Terisi</div>
                            <div class="badge bg-info">Diajukan</div>
                            <div class="badge bg-success">Disetujui</div>
                            <div class="badge bg-danger">Ditolak</div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>OPD</th>
                                    <th>Type</th>
                                    <th>Rencana Aksi | Penilaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPerjanjianKinerjas as $opdPerjanjianKinerja)
                                    <tr>
                                        <td>{{ $opdPerjanjianKinerja->year }}</td>
                                        <td>{{ $opdPerjanjianKinerja->opd->nama_opd }}</td>
                                        <td><a href="{{ route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja->id) }}"
                                                target="_blank">{{ $opdPerjanjianKinerja->type }}</a>
                                        </td>
                                        <td>
                                            @foreach ($opdPerjanjianKinerja->rencana_aksis as $rencana_aksi)
                                                @if ($rencana_aksi->status == $statuses[0])
                                                    <a href="{{ route('rencanaAksiTarget.create', $rencana_aksi->id) }}"
                                                        class="badge bg-info">{{ $rencana_aksi->name }}</a>
                                                @elseif($rencana_aksi->status == $statuses[1])
                                                    <a href="{{ route('rencanaAksiTarget.create', $rencana_aksi->id) }}"
                                                        class="badge bg-success">{{ $rencana_aksi->name }}</a>
                                                @elseif($rencana_aksi->status == $statuses[2])
                                                    <a href="{{ route('rencanaAksiTarget.create', $rencana_aksi->id) }}"
                                                        class="badge bg-danger">{{ $rencana_aksi->name }}</a>
                                                @else
                                                    <a href="{{ route('rencanaAksiTarget.create', $rencana_aksi->id) }}"
                                                        class="badge bg-warning">{{ $rencana_aksi->name }}</a>
                                                @endif
                                                <div class="badge bg-primary">{{ $rencana_aksi->status_penilaian }}</div>
                                                <div class="badge bg-info">{{ $rencana_aksi->nilai }}</div>
                                                <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $opdPerjanjianKinerjas->links() }}
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
