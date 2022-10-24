@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdCategories.index') }}">Kategori OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Kategori OPD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Kategori OPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($opdCategory) {{ route('opdCategories.update', $opdCategory->id) }} @endisset @empty($opdCategory) {{ route('opdCategories.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdCategory)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($opdCategory) ? $opdCategory->name : @old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="type">Tipe</label>
                        <select name="type" class="form-control" id="" required>
                            <option value="">Pilih Tipe</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}" @selected(isset($opdCategory) ? $opdCategory->type == $type : @old('type'))>{{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="opd_variable_id">Variable</label>
                        <select name="opd_variable_id[]" class="js-example-basic-single form-select" required multiple>
                            @foreach ($opdVariables as $opdVariable)
                                <option value="{{ $opdVariable->id }}">
                                    {{ $opdVariable->name }} | {{ $opdVariable->bobot }} </option>
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
