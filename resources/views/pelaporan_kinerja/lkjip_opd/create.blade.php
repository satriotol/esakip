@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('lkjip_opd.index') }}">Pelaporan Kinerja LKJIP OPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Pelaporan Kinerja LKJIP OPD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Pelaporan Kinerja LKJIP OPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($lkjip_opd) {{ route('lkjip_opd.update', $lkjip_opd->id) }} @endisset @empty($lkjip_opd) {{ route('lkjip_opd.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($lkjip_opd)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" name="year" type="number" placeholder="yyyy" required
                            value="{{ isset($lkjip_opd) ? $lkjip_opd->year : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">OPD</label>
                        <select class="js-example-basic-single form-select" data-width="100%" required name="opd_id">
                            <option value="">Select OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}"
                                    @isset($lkjip_opd) @if ($opd->id === $lkjip_opd->opd_id) selected @endif
                                @endisset>
                                {{ $opd->nama_opd }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input type="file" id="myDropify" name="file"
                        @empty($lkjip_opd) required @endempty />
                    @isset($lkjip_opd)
                        <object data="{{ asset('uploads/' . $lkjip_opd->file) }}" class="w-100 mt-5" style="height: 550px"
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
<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/dropify.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
