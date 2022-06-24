@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                    href="{{ route('evaluasiKinerjaYear.show', $evaluasiKinerja->evaluasi_kinerja_year_id) }}">{{ $name }}
                    {{ $evaluasiKinerja->evaluasi_kinerja_year->year }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <form
                    action="@isset($evaluasiKinerja) {{ route('evaluasiKinerja.update', $evaluasiKinerja->id) }} @endisset @empty($evaluasiKinerja) {{ route('evaluasiKinerja.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($evaluasiKinerja)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" type="text" placeholder="yyyy" required readonly
                            value="{{ isset($evaluasiKinerja) ? $evaluasiKinerja->evaluasi_kinerja_year->year : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">OPD</label>
                        <input id="year" class="form-control" type="text" placeholder="yyyy" required readonly
                            value="{{ isset($evaluasiKinerja) ? $evaluasiKinerja->opd->nama_opd : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="value" class="form-label">Value</label>
                        <input id="value" class="form-control" type="text" name="value" required 
                            value="{{ isset($evaluasiKinerja) ? $evaluasiKinerja->value : '' }}">
                    </div>
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
@endpush
