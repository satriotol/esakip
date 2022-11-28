@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opds.index') }}">OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form OPD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form OPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($opd) {{ route('opds.update', $opd->id) }} @endisset @empty($opd) {{ route('opds.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opd)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="nama_opd" class="form-control" name="nama_opd" type="text" readonly required
                            value="{{ isset($opd) ? $opd->nama_opd : @old('nama_opd') }}">
                    </div>
                    <div class="mb-3">
                        <label for="data_unit_id" class="form-label">Data Unit</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="data_unit_id" required>
                            <option value="">Select Data Unit</option>
                            @foreach ($dataUnits as $dataUnit)
                                <option value="{{ $dataUnit->id_skpd }}"
                                    @isset($opd)
                                    @selected($opd->data_unit_id == $dataUnit->id_skpd)
                                @endisset>
                                    {{ $dataUnit->nama_skpd }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inovasi_prestasi_daerah" class="form-label">Inovasi Prestasi Daerah</label>
                        <input id="inovasi_prestasi_daerah" class="form-control" name="inovasi_prestasi_daerah"
                            type="number" required
                            value="{{ isset($opd) ? $opd->inovasi_prestasi_daerah : @old('inovasi_prestasi_daerah') }}">
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
