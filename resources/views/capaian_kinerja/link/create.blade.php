@extends('layout.master')

@push('plugin-styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('link.index') }}">Pelaporan Kinerja LKJIP Kota</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Pelaporan Kinerja LKJIP Kota</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Pelaporan Kinerja LKJIP Kota</h4>
                @include('partials.errors')
                <form
                    action="@isset($link) {{ route('link.update', $link->id) }} @endisset @empty($link) {{ route('link.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($link)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input id="title" class="form-control" name="title" type="text" required
                            value="{{ isset($link) ? $link->title : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Url</label>
                        <input id="url" class="form-control" name="url" type="text" required
                            value="{{ isset($link) ? $link->url : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="" class="form-control" required>
                            <option value="">Pilih Type Link</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}"
                                    @isset($link) @if ($link->type === $type)
                                        selected @endif
                                @endisset>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ isset($link) ? $link->description : '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="file"
                        @empty($link) required @endempty />
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
<script src="{{ asset('assets/js/dropify.js') }}"></script>
<script>
    const inputElement = document.querySelector('input[id="file"]');
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        server: {
            url: '{{ route('link.store_file') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>
@endpush
