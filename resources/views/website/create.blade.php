@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('website.index') }}">{{ $name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <form
                    action="@isset($website) {{ route('website.update', $website->id) }} @endisset @empty($website) {{ route('website.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($website)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="tinymceExample" rows="10">{{ isset($website) ? $website->description : '' }}</textarea>
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
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>
@endpush
