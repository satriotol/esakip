@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('renstraOpd.index', $periodeRenstraOpd->id) }}">Pelaporan Kinerja
                    RENSTRA OPD {{ $periodeRenstraOpd->start_year }} - {{ $periodeRenstraOpd->end_year }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Pelaporan Kinerja RENSTRA OPD
                {{ $periodeRenstraOpd->start_year }} - {{ $periodeRenstraOpd->end_year }}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Pelaporan Kinerja RENSTRA OPD {{ $periodeRenstraOpd->start_year }} -
                    {{ $periodeRenstraOpd->end_year }}</h4>
                @include('partials.errors')
                <form
                    action="@isset($renstraOpd) {{ route('renstraOpd.update', [$periodeRenstraOpd->id, $renstraOpd->id]) }} @endisset @empty($renstraOpd) {{ route('renstraOpd.store', $periodeRenstraOpd->id) }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($renstraOpd)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">OPD</label>
                        <select class="js-example-basic-single form-select" data-width="100%" required name="opd_id">
                            <option value="">Select OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}"
                                    @isset($renstraOpd) @if ($opd->id === $renstraOpd->opd_id) selected @endif
                                @endisset>
                                    {{ $opd->nama_opd }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" name="file" class="form-control" id="file"
                            @empty($renstraOpd) required @endempty />
                        <small class="text-danger">Format PDF, maksimal 10MB</small>
                        @isset($renstraOpd)
                            <object data="{{ asset('uploads/' . $renstraOpd->file) }}" class="w-100 mt-5" style="height: 550px"
                                type="application/pdf">
                                <div>No online PDF viewer installed</div>
                            </object>
                        @endisset
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
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
