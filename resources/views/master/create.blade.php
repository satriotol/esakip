@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Form Master</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Master</h4>
                @include('partials.errors')
                <form
                    action="@isset($master) {{ route('master.update', $master->id) }} @endisset @empty($master) {{ route('master.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($master)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="reformasi_birokrasi" class="form-label">Reformasi Birokrasi</label>
                        <input id="reformasi_birokrasi" class="form-control" name="reformasi_birokrasi" type="number" placeholder="Reformasi Birokrasi" required
                            value="{{ isset($master) ? $master->reformasi_birokrasi : @old('reformasi_birokrasi') }}">
                    </div>
                    <div class="mb-3">
                        <label for="sakip" class="form-label">SAKIP</label>
                        <input id="sakip" class="form-control" name="sakip" type="number" placeholder="Reformasi Birokrasi" required
                            value="{{ isset($master) ? $master->sakip : @old('sakip') }}">
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