@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('renjaOpd.index') }}">{{ $name }}</a>
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
                    action="@isset($renjaOpd) {{ route('renjaOpd.update', $renjaOpd->id) }} @endisset @empty($renjaOpd) {{ route('renjaOpd.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($renjaOpd)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" name="year" type="number" placeholder="yyyy" required
                            value="{{ isset($renjaOpd) ? $renjaOpd->year : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">OPD</label>
                        <select class="js-example-basic-single form-select" data-width="100%" required name="opd_id">
                            <option value="">Select OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}"
                                    @isset($renjaOpd) @if ($opd->id === $renjaOpd->opd_id) selected @endif
                                @endisset>
                                {{ $opd->nama_opd }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Type</label>
                    <select class="js-example-basic-single form-select" data-width="100%" required name="type">
                        <option value="">Select Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}"
                                @isset($renjaOpd) @if ($type === $renjaOpd->type) selected @endif
                            @endisset>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" name="file" id="file"
                    @empty($renjaOpd) required @endempty />
                @isset($renjaOpd)
                    <object data="{{ asset('uploads/' . $renjaOpd->file) }}" class="w-100 mt-5" style="height: 550px"
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
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script>
    const inputElement = document.querySelector('input[id="file"]');
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        server: {
            url: '{{ route('renjaOpd.store_file') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
