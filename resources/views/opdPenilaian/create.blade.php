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
                            <option value="">Pilih OPD</option>
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
                    <div class="mb-3">
                        <label for="name" class="form-label">Inovasi Prestasi OPD</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="inovasi_prestasi_opd_id"
                            required>
                            <option value="">Pilih Inovasi Prestasi OPD</option>
                            @foreach ($inovasiPrestasiOpds as $inovasiPrestasiOpd)
                                <option value="{{ $inovasiPrestasiOpd->id }}"
                                    @isset($opdPenilaian) 
                                    @if ($inovasiPrestasiOpd->id === $opdPenilaian->inovasi_prestasi_opd_id) selected  @endif
                                @endisset>
                                    {{ $inovasiPrestasiOpd->opd->nama_opd }} | {{ $inovasiPrestasiOpd->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Perjanjian Kinerja</label>
                        <select class="js-example-basic-single form-select" data-width="100%"
                            name="opd_perjanjian_kinerja_id" required>
                            <option value="">Pilih Perjanjian Kinerja</option>
                            @foreach ($opdPerjanjianKinerjas as $opdPerjanjianKinerja)
                                <option value="{{ $opdPerjanjianKinerja->id }}"
                                    @isset($opdPenilaian) 
                                    @if ($opdPerjanjianKinerja->id === $opdPenilaian->opd_perjanjian_kinerja_id) selected  @endif
                                @endisset>
                                    {{ $opdPerjanjianKinerja->opd->nama_opd }} | {{ $opdPerjanjianKinerja->year }} |
                                    {{ $opdPerjanjianKinerja->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Kategori Penilaian</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="opd_category_id"
                            required>
                            <option value="">Pilih Kategori Penilaian</option>
                            @foreach ($opdCategories as $opdCategory)
                                <option value="{{ $opdCategory->id }}"
                                    @isset($opdPenilaian) 
                                        @if ($opdCategory->id === $opdPenilaian->opd_category_id) selected  @endif
                                    @endisset>
                                    {{ $opdCategory->name }}
                                </option>
                            @endforeach
                        </select>
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
