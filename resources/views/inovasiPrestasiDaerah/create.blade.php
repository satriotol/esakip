@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Form Inovasi Prestasi Daerah</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Inovasi Prestasi Daerah</h4>
                @include('partials.errors')
                <form
                    action="@isset($inovasiPrestasiDaerah) {{ route('inovasiPrestasiDaerah.update', $inovasiPrestasiDaerah->id) }} @endisset @empty($inovasiPrestasiDaerah) {{ route('inovasiPrestasiDaerah.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($inovasiPrestasiDaerah)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <input id="nilai" class="form-control" name="nilai" type="number" placeholder="Nilai" required
                            value="{{ isset($inovasiPrestasiDaerah) ? $inovasiPrestasiDaerah->nilai : @old('nilai') }}">
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
