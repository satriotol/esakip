@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('rencanaAksi.index') }}">{{ $name }}</a>
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
                    action="@isset($rencanaAksi) {{ route('rencanaAksi.update', $rencanaAksi->id) }} @endisset @empty($rencanaAksi) {{ route('rencanaAksi.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($rencanaAksi)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Perjanjian Kinerja</label>
                        <select class="js-example-basic-single form-select" data-width="100%"
                            name="opd_perjanjian_kinerja_id" required>
                            <option value="">Pilih Perjanjian Kinerja</option>
                            @foreach ($opdPerjanjianKinerjas as $opdPerjanjianKinerja)
                                <option value="{{ $opdPerjanjianKinerja->id }}" @selected(@old('opd_perjanjian_kinerja_id'))>
                                    {{ $opdPerjanjianKinerja->opd->nama_opd }} | {{ $opdPerjanjianKinerja->year }} |
                                    {{ $opdPerjanjianKinerja->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Triwulan</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="name" required>
                            <option value="">Pilih Triwulan</option>
                            @foreach ($triwulans as $triwulan)
                                <option @selected(@old('name')) value="{{ $triwulan }}">
                                    {{ $triwulan }}
                                </option>
                            @endforeach
                        </select>
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
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
