@extends('layout.master')

@push('plugin-styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('perencanaan_kinerja_rpjmd.index') }}">Perencanaan Kinerja
                    RPJMD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Perencanaan Kinerja RPJMD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Perencanaan Kinerja RPJMD</h4>
                @include('partials.errors')
                <form
                    action="@isset($perencanaan_kinerja_rpjmd) {{ route('perencanaan_kinerja_rpjmd.update', $perencanaan_kinerja_rpjmd->id) }} @endisset @empty($perencanaan_kinerja_rpjmd) {{ route('perencanaan_kinerja_rpjmd.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($perencanaan_kinerja_rpjmd)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($perencanaan_kinerja_rpjmd) ? $perencanaan_kinerja_rpjmd->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input id="year" class="form-control" name="year" type="number" placeholder="yyyy" required
                            value="{{ isset($perencanaan_kinerja_rpjmd) ? $perencanaan_kinerja_rpjmd->year : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" name="file" id="file"
                            @empty($perencanaan_kinerja_rpjmd) required @endempty />
                        @isset($perencanaan_kinerja_rpjmd)
                            <object data="{{ asset('uploads/' . $perencanaan_kinerja_rpjmd->file) }}" class="w-100 mt-5"
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
    <script>
        const inputElement = document.querySelector('input[id="file"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '{{ route('perencanaan_kinerja_rpjmd.store_file') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>
@endpush
