@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('evaluasiKinerjaYear.index') }}">{{ $name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <form
                    action="@isset($evaluasiKinerjaYear) {{ route('evaluasiKinerjaYear.update', $evaluasiKinerjaYear->id) }} @endisset @empty($evaluasiKinerjaYear) {{ route('evaluasiKinerjaYear.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($evaluasiKinerjaYear)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" name="year" type="number" placeholder="yyyy" required
                            value="{{ isset($evaluasiKinerjaYear) ? $evaluasiKinerjaYear->year : '' }}">
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
