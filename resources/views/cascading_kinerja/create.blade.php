@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('cascading_kinerja.index') }}">Cascading Kinerja</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Perencenaan Kinerja</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Cascading Kinerja</h4>
                @include('partials.errors')
                <form
                    action="@isset($cascading_kinerja) {{ route('cascading_kinerja.update', $cascading_kinerja->id) }} @endisset @empty($cascading_kinerja) {{ route('cascading_kinerja.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($cascading_kinerja)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" name="year" type="number" placeholder="yyyy" required
                            value="{{ isset($cascading_kinerja) ? $cascading_kinerja->year : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($cascading_kinerja) ? $cascading_kinerja->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" id="myDropify" name="file"
                            @empty($cascading_kinerja) required @endempty />
                        @isset($cascading_kinerja)
                            <object data="{{ asset('uploads/' . $cascading_kinerja->file) }}" class="w-100 mt-5" style="height: 550px"
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
