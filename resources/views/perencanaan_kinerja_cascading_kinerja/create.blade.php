@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('perencanaan_kinerja_rkpd.index') }}">Perencanaan Kinerja RKPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Perencenaan Kinerja</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Perencanaan Kinerja RKPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($perencanaan_kinerja_rkpd) {{ route('perencanaan_kinerja_rkpd.update', $perencanaan_kinerja_rkpd->id) }} @endisset @empty($perencanaan_kinerja_rkpd) {{ route('perencanaan_kinerja_rkpd.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($perencanaan_kinerja_rkpd)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" name="year" type="number" placeholder="yyyy" required
                            value="{{ isset($perencanaan_kinerja_rkpd) ? $perencanaan_kinerja_rkpd->year : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($perencanaan_kinerja_rkpd) ? $perencanaan_kinerja_rkpd->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" id="myDropify" name="file"
                            @empty($perencanaan_kinerja_rkpd) required @endempty />
                        @isset($perencanaan_kinerja_rkpd)
                            <object data="{{ asset('uploads/' . $perencanaan_kinerja_rkpd->file) }}" class="w-100 mt-5" style="height: 550px"
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
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
