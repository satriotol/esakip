@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('evaluasiKinerja.index') }}">{{ $name }}</a>
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
                    action="@isset($evaluasiKinerja) {{ route('evaluasiKinerja.update', $evaluasiKinerja->id) }} @endisset @empty($evaluasiKinerja) {{ route('evaluasiKinerja.store', $evaluasiKinerjaYear) }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($evaluasiKinerja)
                        @method('PUT')
                    @endisset
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>OPD</th>
                            <th>Value</th>
                        </tr>
                        @foreach ($opds as $opd)
                            <tr>
                                <td>
                                    <input type="text" name="opd_id[]" class="d-none" value="{{ $opd->id }}">
                                    <input type="text" name="opd" placeholder="Enter subject" class="form-control"
                                        value="{{ $opd->nama_opd }}" readonly />
                                </td>
                                <td>
                                    <input type="text" name="value[]" class="form-control">
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="text-end mt-2">
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
