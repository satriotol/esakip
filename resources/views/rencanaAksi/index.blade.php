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
                    @can('rencanaAksi-create')
                        <div class="text-end mb-2">
                            <a class="btn btn-primary" href="{{ route('rencanaAksi.create') }}">
                                <i data-feather="plus"></i>
                                Tambah
                            </a>
                        </div>
                    @endcan
                    <div class="row">
                        <div class="col-md-8">
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
                                                    'class' => 'form-select js-example-basic-single',
                                                    'placeholder' => 'Pilih Triwulan',
                                                ],
                                            ) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
                                            {!! Form::select(
                                                'status',
                                                [
                                                    'BELUM MENGISI KOMPONEN' => 'BELUM MENGISI KOMPONEN',
                                                    'PROSES PENGISIAN RENCANA AKSI OPD' => 'PROSES PENGISIAN RENCANA AKSI OPD',
                                                    'MENUNGGU VERIFIKASI VERIFIKATOR' => 'MENUNGGU VERIFIKASI VERIFIKATOR',
                                                    'PROSES PENGISIAN REALISASI OPD' => 'PROSES PENGISIAN REALISASI OPD',
                                                    'PROSES VERIFIKASI REALISASI' => 'PROSES VERIFIKASI REALISASI',
                                                    'SELESAI' => 'SELESAI',
                                                ],
                                                @old('status'),
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
                        <div class="col-md-4">
                            <h6>Opd Yang Belum Mengisi Rencana Aksi</h6>
                            <small class="text-danger">Jika Ingin Mencari Data Yang Belum, Wajib Mengisikan Tahun &
                                Triwulan</small>
                            <ul style="height: 100px; overflow: auto">
                                @foreach ($opdWithoutRencanaAksis as $opdWithoutRencanaAksi)
                                    <li>{{ $opdWithoutRencanaAksi->nama_opd }}</li>
                                @endforeach
                            </ul>
                            <small>Jumlah : {{ $opdWithoutRencanaAksis->count() }}</small>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>OPD</th>
                                    <th>Triwulan</th>
                                    <th>Perjanjian kinerja</th>
                                    <th>Status</th>
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
                                            {{ $rencanaAksi->getStatusNow() }}
                                        </td>
                                        <td>{{ $rencanaAksi->getTotalCapaian($rencanaAksi->id) }}</td>
                                        <td>
                                            <a @class([
                                                'btn btn-sm',
                                                'btn-info' => $rencanaAksi->verifikator,
                                                'btn-warning' => $rencanaAksi->verifikator == null,
                                            ]) data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $rencanaAksi->id }}">Verifikator</a>
                                            <div class="modal fade bd-example-modal-lg"
                                                id="exampleModal{{ $rencanaAksi->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" style="max-width: 80%!important;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                {{ $rencanaAksi->opd_perjanjian_kinerja->opd->nama_opd ?? '-' }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="btn-close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @can('rencanaAksi-create')
                                                                @if (Auth::user()->opd_id == null)
                                                                    <form
                                                                        action="{{ route('rencanaAksi.update', $rencanaAksi->id) }}"
                                                                        method="post">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            {!! Form::hidden('jenis', 'verifikator', []) !!}
                                                                            {!! Form::label('verifikator_id', 'Verifikator', ['class' => 'form-label']) !!}
                                                                            {!! Form::select(
                                                                                'verifikator_id',
                                                                                $verifikators->pluck('name_jabatan', 'id'),
                                                                                isset($rencanaAksi) ? $rencanaAksi->verifikator_id : @old('verifikator_id'),
                                                                                ['class' => 'form-select', 'placeholder' => 'Pilih Verifikator', 'required'],
                                                                            ) !!}
                                                                        </div>
                                                                        <div class="text-end">
                                                                            {!! Form::submit('Simpan', ['class' => 'btn btn-success']) !!}
                                                                        </div>
                                                                    </form>
                                                                @endif
                                                            @endcan
                                                            @isset($rencanaAksi->verifikator)
                                                                <h5>Detail Verifikator</h5>
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Nama</td>
                                                                            <td>:</td>
                                                                            <td>{{ $rencanaAksi->verifikator->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jabatan</td>
                                                                            <td>:</td>
                                                                            <td>{{ $rencanaAksi->verifikator->jabatan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nomor HP</td>
                                                                            <td>:</td>
                                                                            <td>{{ $rencanaAksi->verifikator->phone }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            @endisset
                                                            @empty($rencanaAksi->verifikator)
                                                                <div class="text-center">
                                                                    <h5>Verifikator Belum Mengisi Data Diri</h5>
                                                                </div>
                                                            @endempty
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('rencanaAksi.show', $rencanaAksi->id) }}">Detail</a>
                                            @if ($rencanaAksi->status_verifikator != 'SELESAI')
                                                <form action="{{ route('rencanaAksi.destroy', $rencanaAksi->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
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
