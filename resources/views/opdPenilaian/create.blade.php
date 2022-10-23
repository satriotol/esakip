@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaian.index') }}">Penilaian OPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Penilaian OPD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Penilaian OPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($opdPenilaian) {{ route('opdPenilaian.update', $opdPenilaian->id) }} @endisset @empty($opdPenilaian) {{ route('opdPenilaian.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdPenilaian)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" name="year" type="number" placeholder="yyyy" required
                            value="{{ isset($opdPenilaian) ? $opdPenilaian->year : @old('year') }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">OPD</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="opd_id" required>
                            <option value="">Select OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}"
                                    @isset($opdPenilaian) 
                                    @if ($opd->id === $opdPenilaian->opd_id) selected  @endif
                                @endisset>
                                    {{ $opd->nama_opd }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Tipe</th>
                                    <th>Target</th>
                                    <th>Realisasi</th>
                                    <th>Capaian (Realisasi/Target) dalam %</th>
                                    <th>Penyesuaian Capaian</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Reformasi Birokrasi</th>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->rb_target : @old('rb_target') }}"
                                            name="rb_target" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->rb_realisasi : @old('rb_realisasi') }}"
                                            name="rb_realisasi" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->rb_capaian : @old('rb_capaian') }}"
                                            name="rb_capaian" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->rb_penyesuaian_capaian : @old('rb_penyesuaian_capaian') }}"
                                            name="rb_penyesuaian_capaian" class="form-control" required>
                                    </td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->rb_nilai_akhir : @old('rb_nilai_akhir') }}"
                                            name="rb_nilai_akhir" class="form-control" required></td>
                                </tr>
                                <tr>
                                    <th>SAKIP</th>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->sakip_target : @old('sakip_target') }}"
                                            name="sakip_target" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->sakip_realisasi : @old('sakip_realisasi') }}"
                                            name="sakip_realisasi" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->sakip_capaian : @old('sakip_capaian') }}"
                                            name="sakip_capaian" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->sakip_penyesuaian_capaian : @old('sakip_penyesuaian_capaian') }}"
                                            name="sakip_penyesuaian_capaian" class="form-control" required>
                                    </td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->sakip_nilai_akhir : @old('sakip_nilai_akhir') }}"
                                            name="sakip_nilai_akhir" class="form-control" required></td>
                                </tr>
                                <tr>
                                    <th>IKU</th>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->iku_target : @old('iku_target') }}"
                                            name="iku_target" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->iku_realisasi : @old('iku_realisasi') }}"
                                            name="iku_realisasi" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->iku_capaian : @old('iku_capaian') }}"
                                            name="iku_capaian" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->iku_penyesuaian_capaian : @old('iku_penyesuaian_capaian') }}"
                                            name="iku_penyesuaian_capaian" class="form-control" required>
                                    </td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->iku_nilai_akhir : @old('iku_nilai_akhir') }}"
                                            name="iku_nilai_akhir" class="form-control" required></td>
                                </tr>
                                <tr>
                                    <th>Penerapan Anggaran Belanja</th>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->penerapan_anggaran_belanja_target : @old('penerapan_anggaran_belanja_target') }}"
                                            name="penerapan_anggaran_belanja_target" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->penerapan_anggaran_belanja_realisasi : @old('penerapan_anggaran_belanja_realisasi') }}"
                                            name="penerapan_anggaran_belanja_realisasi" class="form-control" required>
                                    </td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->penerapan_anggaran_belanja_capaian : @old('penerapan_anggaran_belanja_capaian') }}"
                                            name="penerapan_anggaran_belanja_capaian" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->penerapan_anggaran_belanja_penyesuaian_capaian : @old('penerapan_anggaran_belanja_penyesuaian_capaian') }}"
                                            name="penerapan_anggaran_belanja_penyesuaian_capaian" class="form-control"
                                            required>
                                    </td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->penerapan_anggaran_belanja_nilai_akhir : @old('penerapan_anggaran_belanja_nilai_akhir') }}"
                                            name="penerapan_anggaran_belanja_nilai_akhir" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Realisasi Target Pendapatan</th>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->realisasi_target_pendapatan_target : @old('realisasi_target_pendapatan_target') }}"
                                            name="realisasi_target_pendapatan_target" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->realisasi_target_pendapatan_realisasi : @old('realisasi_target_pendapatan_realisasi') }}"
                                            name="realisasi_target_pendapatan_realisasi" class="form-control" required>
                                    </td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->realisasi_target_pendapatan_capaian : @old('realisasi_target_pendapatan_capaian') }}"
                                            name="realisasi_target_pendapatan_capaian" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->realisasi_target_pendapatan_penyesuaian_capaian : @old('realisasi_target_pendapatan_penyesuaian_capaian') }}"
                                            name="realisasi_target_pendapatan_penyesuaian_capaian" class="form-control"
                                            required>
                                    </td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->realisasi_target_pendapatan_nilai_akhir : @old('realisasi_target_pendapatan_nilai_akhir') }}"
                                            name="realisasi_target_pendapatan_nilai_akhir" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>P3DN</th>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->p3dn_target : @old('p3dn_target') }}"
                                            name="p3dn_target" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->p3dn_realisasi : @old('p3dn_realisasi') }}"
                                            name="p3dn_realisasi" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->p3dn_capaian : @old('p3dn_capaian') }}"
                                            name="p3dn_capaian" class="form-control" required></td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->p3dn_penyesuaian_capaian : @old('p3dn_penyesuaian_capaian') }}"
                                            name="p3dn_penyesuaian_capaian" class="form-control" required>
                                    </td>
                                    <td><input type="number"
                                            value="{{ isset($opdPenilaian) ? $opdPenilaian->p3dn_nilai_akhir : @old('p3dn_nilai_akhir') }}"
                                            name="p3dn_nilai_akhir" class="form-control" required></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('opdPenilaian.index') }}" class="btn btn-warning">Kembali</a>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
