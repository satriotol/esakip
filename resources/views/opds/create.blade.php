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
                        <input id="nama_opd" class="form-control" name="nama_opd" type="text" required
                            value="{{ isset($opd) ? $opd->nama_opd : @old('nama_opd') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Kategori</label>
                        <select name="opd_category_id" class="form-control" required @selected(old('opd_category_id'))>
                            <option value="">Pilih Kategori</option>
                            @foreach ($opd_categories as $opd_category)
                                <option value="{{ $opd_category->id }}">{{ $opd_category->name }}</option>
                            @endforeach
                        </select>
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
