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
                        <div class="col-md-12">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('opd_id', 'OPD', ['class' => 'form-label']) !!}
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
                                        <div class="mb-3">
                                            {!! Form::label('year', 'Tahun', ['class' => 'form-label']) !!}
                                            {!! Form::number('year', @old('year'), ['class' => 'form-control', 'placeholder' => 'Cari Tahun']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">

                                            {!! Form::label('triwulan', 'Triwulan', ['class' => 'form-label']) !!}
                                            {!! Form::select(
                                                'triwulan',
                                                [
                                                    'TRIWULAN 1' => 'TRIWULAN 1',
                                                    'TRIWULAN 2' => 'TRIWULAN 2',
                                                    'TRIWULAN 3' => 'TRIWULAN 3',
                                                    'TRIWULAN 4' => 'TRIWULAN 4',
                                                ],
                                                @old('triwulan'),
                                                [
                                                    'class' => 'form-select js-example-basic-single form-select',
                                                    'placeholder' => 'Pilih Triwulan',
                                                ],
                                            ) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('status_penilaian', 'Status Penilaian', ['class' => 'form-label']) !!}
                                            {!! Form::select(
                                                'status_penilaian',
                                                [
                                                    'Selesai' => 'SELESAI',
                                                ],
                                                @old('status_penilaian'),
                                                ['class' => 'form-select js-example-basic-single form-select', 'placeholder' => 'Pilih Status'],
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-sm btn-success">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>OPD</th>
                                    <th>Triwulan</th>
                                    <th>Perjanjian kinerja</th>
                                    <th>Status Pengajuan<br>
                                        Status Penilaian
                                    </th>
                                    <th>Capaian</th>
                                    <th>Rencana Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rencanaAksis as $rencanaAksi)
                                    <tr>
                                        <td>{{ $rencanaAksi->opd_perjanjian_kinerja->year ?? '-' }}</td>
                                        <td>{{ $rencanaAksi->opd_perjanjian_kinerja->opd->nama_opd ?? '-' }}</td>
                                        <td>{{ $rencanaAksi->name }}</td>
                                        <td>
                                            <a href="{{ route('opdPerjanjianKinerja.show', $rencanaAksi->opd_perjanjian_kinerja_id) }}"
                                                target="_blank">
                                                {{ $rencanaAksi->opd_perjanjian_kinerja->type ?? '-' }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="badge bg-success">{{ $rencanaAksi->getStatus() }}</div><br>
                                            <div class="badge bg-success">{{ $rencanaAksi->getStatusPenilaian() }}</div>
                                        </td>
                                        <td>{{ $rencanaAksi->getTotalCapaian($rencanaAksi->id) }}</td>
                                        <td>
                                            <a class="badge bg-primary"
                                                href="{{ route('rencanaAksi.show', $rencanaAksi->id) }}">Detail</a>
                                            <form action="{{ route('rencanaAksi.destroy', $rencanaAksi->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge bg-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $rencanaAksis->appends($_GET)->links() }}
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
