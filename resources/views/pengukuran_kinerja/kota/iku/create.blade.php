@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('ikuKota.index') }}">{{$name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form {{$name}}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{$name}}</h4>
                <form
                    action="@isset($ikuKotum) {{ route('ikuKota.update', $ikuKotum->id) }} @endisset @empty($ikuKotum) {{ route('ikuKota.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($ikuKotum)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" id="myDropify" name="file"
                            @empty($ikuKotum) required @endempty />
                        @isset($ikuKotum)
                            <object data="{{ asset('uploads/' . $ikuKotum->file) }}" class="w-100 mt-5"
                                style="height: 550px" type="application/pdf">
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
