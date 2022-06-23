@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('periodeRenstraOpd.index') }}">Perencanaan Kinerja renstra OPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Perencanaan Kinerja renstra OPD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Perencanaan Kinerja renstra OPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($periodeRenstraOpd) {{ route('periodeRenstraOpd.update', $periodeRenstraOpd->id) }} @endisset @empty($periodeRenstraOpd) {{ route('periodeRenstraOpd.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($periodeRenstraOpd)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="start_year" class="form-label">Start Year</label>
                        <input id="start_year" class="form-control" name="start_year" type="number" placeholder="yyyy" required
                            value="{{ isset($periodeRenstraOpd) ? $periodeRenstraOpd->start_year : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="end_year" class="form-label">End Year</label>
                        <input id="end_year" class="form-control" name="end_year" type="number" placeholder="yyyy" required
                            value="{{ isset($periodeRenstraOpd) ? $periodeRenstraOpd->end_year : '' }}">
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

@push('custom-scripts')
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
