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
                    action="@isset($opd_program_anggaran) {{ route('opdPerjanjianKinerjaProgramAnggaran.update', [$opdPerjanjianKinerja, $opd_program_anggaran->id]) }} @endisset @empty($opd_program_anggaran) {{ route('opdPerjanjianKinerjaProgramAnggaran.store', $opdPerjanjianKinerja) }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opd_program_anggaran)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="program" class="form-label">Program</label>
                        <input id="program" class="form-control" name="program" type="text" placeholder="Program"
                            required value="{{ isset($opd_program_anggaran) ? $opd_program_anggaran->program : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="anggaran" class="form-label">Anggaran</label>
                        <input id="anggaran" class="form-control currency" name="anggaran" type="text"
                            placeholder="Anggaran" required
                            value="{{ isset($opd_program_anggaran) ? $opd_program_anggaran->anggaran : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input id="keterangan" class="form-control" name="keterangan" type="text"
                            placeholder="Keterangan" required
                            value="{{ isset($opd_program_anggaran) ? $opd_program_anggaran->keterangan : '' }}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-price-format/2.2.0/jquery.priceformat.min.js"
        integrity="sha512-qHlEL6N+fxDGsJoPhq/jFcxJkRURgMerSFixe39WoYaB2oj91lvJXYDVyEO1+tOuWO+sBtUGHhl3v3hUp1tGMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('custom-scripts')
    <script>
        $('.currency').priceFormat({
            prefix: '',
            clearOnEmpty: true,
            limit: 0,
            centsLimit: 0
        });
    </script>
@endpush
