@extends('layout.master')

@push('plugin-styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kotaPerjanjianKinerja.index') }}">{{ $name }}</a>
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
                    action="@isset($kotaPerjanjianKinerja) {{ route('kotaPerjanjianKinerja.update', $kotaPerjanjianKinerja->id) }} @endisset @empty($kotaPerjanjianKinerja) {{ route('kotaPerjanjianKinerja.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($kotaPerjanjianKinerja)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" name="year" type="number" placeholder="yyyy" required
                            value="{{ isset($kotaPerjanjianKinerja) ? $kotaPerjanjianKinerja->year : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($kotaPerjanjianKinerja) ? $kotaPerjanjianKinerja->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" id="file" name="file"
                            @empty($kotaPerjanjianKinerja) required @endempty />
                        @isset($kotaPerjanjianKinerja)
                            <object data="{{ asset('uploads/' . $kotaPerjanjianKinerja->file) }}" class="w-100 mt-5"
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
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endpush

@push('custom-scripts')
    =
    <script>
        const inputElement = document.querySelector('input[id="file"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '{{ route('perencanaan_kinerja_rkpd.store_file') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>
@endpush
