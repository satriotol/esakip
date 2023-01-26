@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaian.index') }}">Inovasi Prestasi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Inovasi Prestasi</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card" id="app">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Inovasi Prestasi</h4>
                @include('partials.errors')
                <form
                    action="@isset($opdPenilaian) {{ route('opdPenilaian.update', $opdPenilaian->id) }} @endisset @empty($opdPenilaian) {{ route('opdPenilaian.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdPenilaian)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Inovasi Prestasi OPD</label>
                        <select class="form-select" data-width="100%" name="inovasi_prestasi_opd_id">
                            <option value="">Pilih</option>
                            @foreach ($inovasiPrestasiOpds as $inovasiPrestasiOpd)
                                <option value="{{ $inovasiPrestasiOpd->id }}">
                                    {{ $inovasiPrestasiOpd->opd->nama_opd }} | {{ $inovasiPrestasiOpd->year }}
                                    {{ $inovasiPrestasiOpd->inovasi_prestasi_tingkat->name }} |
                                    {{ $inovasiPrestasiOpd->name }}
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
