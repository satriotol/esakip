@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('perencanaan_kinerja.index') }}">Perencanaan Kinerja</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Perencenaan Kinerja</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Perencanaan Kinerja</h4>
                <form
                    action="@isset($perencanaan_kinerja_category) {{ route('perencanaan_kinerja_category.update', $perencanaan_kinerja_category->id) }} @endisset @empty($perencanaan_kinerja_category) {{ route('perencanaan_kinerja_category.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($perencanaan_kinerja_category)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($perencanaan_kinerja_category) ? $perencanaan_kinerja_category->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input id="title" class="form-control" name="title" type="text" required
                            value="{{ isset($perencanaan_kinerja_category) ? $perencanaan_kinerja_category->title : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input id="title" class="form-control" name="title" type="text" required
                            value="{{ isset($perencanaan_kinerja_category) ? $perencanaan_kinerja_category->title : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="show" class="form-label">Is Show ?</label>
                        <input id="show" class="form-control" name="show" type="text" required
                            value="{{ isset($perencanaan_kinerja_category) ? $perencanaan_kinerja_category->title : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="download" class="form-label">Is Downloadable ?</label>
                        <input id="download" class="form-control" name="download" type="text" required
                            value="{{ isset($perencanaan_kinerja_category) ? $perencanaan_kinerja_category->title : '' }}">
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
@endpush

@push('custom-scripts')
@endpush
