@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdCategories.index') }}">Kategori OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Kategori OPD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Kategori OPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($opdCategory) {{ route('opdCategories.update', $opdCategory->id) }} @endisset @empty($opdCategory) {{ route('opdCategories.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdCategory)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">NAMA KATEGORI</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($opdCategory) ? $opdCategory->name : @old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="reformasi_birokrasi" class="form-label">REFORMASI BIROKRASI</label>
                        <input id="reformasi_birokrasi" class="form-control" name="reformasi_birokrasi" type="number" required
                            value="{{ isset($opdCategory) ? $opdCategory->reformasi_birokrasi : @old('reformasi_birokrasi') }}">
                    </div>
                    <div class="mb-3">
                        <label for="sakip" class="form-label">SAKIP</label>
                        <input id="sakip" class="form-control" name="sakip" type="number" required
                            value="{{ isset($opdCategory) ? $opdCategory->sakip : @old('sakip') }}">
                    </div>
                    <div class="mb-3">
                        <label for="iku" class="form-label">IKU</label>
                        <input id="iku" class="form-control" name="iku" type="number" required
                            value="{{ isset($opdCategory) ? $opdCategory->iku : @old('iku') }}">
                    </div>
                    <div class="mb-3">
                        <label for="penyerapan_anggaran_belanja" class="form-label">PENYERAPAN ANGGARAN BELANJA</label>
                        <input id="penyerapan_anggaran_belanja" class="form-control" name="penyerapan_anggaran_belanja" type="number" required
                            value="{{ isset($opdCategory) ? $opdCategory->penyerapan_anggaran_belanja : @old('penyerapan_anggaran_belanja') }}">
                    </div>
                    <div class="mb-3">
                        <label for="realisasi_target_pendapatan" class="form-label">REALISASI TARGET PENDAPATAN</label>
                        <input id="realisasi_target_pendapatan" class="form-control" name="realisasi_target_pendapatan" type="number" required
                            value="{{ isset($opdCategory) ? $opdCategory->realisasi_target_pendapatan : @old('realisasi_target_pendapatan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="p3dn" class="form-label">P3DN</label>
                        <input id="p3dn" class="form-control" name="p3dn" type="number" required
                            value="{{ isset($opdCategory) ? $opdCategory->p3dn : @old('p3dn') }}">
                    </div>
                    <div class="mb-3">
                        <label for="inovasi_prestasi_daerah" class="form-label">INOVASI PRESTASI DAERAH</label>
                        <input id="inovasi_prestasi_daerah" class="form-control" name="inovasi_prestasi_daerah" type="number" required
                            value="{{ isset($opdCategory) ? $opdCategory->inovasi_prestasi_daerah : @old('inovasi_prestasi_daerah') }}">
                    </div>
                    <div class="text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
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
