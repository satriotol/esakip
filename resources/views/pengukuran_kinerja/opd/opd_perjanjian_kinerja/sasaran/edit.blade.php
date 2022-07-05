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
                    action="{{ route('opdPerjanjianKinerjaSasaran.update', [$opdPerjanjianKinerjaSasaran->opd_perjanjian_kinerja_id, $opdPerjanjianKinerjaSasaran->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdPerjanjianKinerjaSasaran)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="sasaran" class="form-label">Sasaran</label>
                        <input id="sasaran" class="form-control" name="sasaran" type="text" placeholder="Sasaran"
                            required
                            value="{{ isset($opdPerjanjianKinerjaSasaran) ? $opdPerjanjianKinerjaSasaran->sasaran : '' }}">
                    </div>
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @push('plugin-scripts')
    @endpush

    @push('custom-scripts')
    @endpush
