@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPerjanjianKinerja.index') }}">{{ $name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
        <a href="{{ url()->previous() }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i>
            Back
        </a>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <form
                    action="{{ route('opdPerjanjianKinerjaIndikator.update', [$opdPerjanjianKinerja, $opd_perjanjian_kinerja_indikator->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opd_perjanjian_kinerja_indikator)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="opd_perjanjian_kinerja_sasaran_id" class="form-label">Sasaran</label>
                        <select class="js-example-basic-single form-select" data-width="100%" required
                            name="opd_perjanjian_kinerja_sasaran_id">
                            <option value="">Pilih Sasaran</option>
                            @foreach ($opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                                <option value="{{ $opd_perjanjian_kinerja_sasaran->id }}"
                                    @if ($opd_perjanjian_kinerja_sasaran->id === $opd_perjanjian_kinerja_indikator->opd_perjanjian_kinerja_sasaran_id) selected @endif>
                                    {{ $opd_perjanjian_kinerja_sasaran->sasaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="indikator" class="form-label">Indikator</label>
                        <input id="indikator" class="form-control" name="indikator" type="text" placeholder="Sasaran"
                            required
                            value="{{ isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->indikator : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="target" class="form-label">Target</label>
                        <input id="target" class="form-control" name="target" type="number" step="any"
                            placeholder="Sasaran" required
                            value="{{ isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->target : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input id="satuan" class="form-control" name="satuan" type="text" placeholder="Sasaran"
                            value="{{ isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->satuan : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="sakip" class="form-label">Sakip</label>
                        <select name="is_sakip" class="form-control" id="">
                            <option @selected(isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->is_sakip : old('is_sakip')) value="">Tidak</option>
                            <option @selected(isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->is_sakip : old('is_sakip')) value="1">Ya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sakip" class="form-label">IKU</label>
                        <select name="is_iku" class="form-control" id="">
                            <option @selected(isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->is_iku : old('is_iku')) value="">Tidak</option>
                            <option @selected(isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->is_iku : old('is_iku')) value="1">Ya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sakip" class="form-label">RB</label>
                        <select name="is_rb" class="form-control" id="">
                            <option @selected(isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->is_rb : old('is_rb')) value="">Tidak</option>
                            <option @selected(isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->is_rb : old('is_rb')) value="1">Ya</option>
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="sakip" class="form-label">OPD</label>
                        <select name="is_opd" class="form-control" id="">
                            <option @selected(isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->is_opd : old('is_opd')) value="">Tidak</option>
                            <option @selected(isset($opd_perjanjian_kinerja_indikator) ? $opd_perjanjian_kinerja_indikator->is_opd : old('is_opd')) value="1">Ya</option>
                        </select>
                    </div> --}}
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
