@extends('layout.master')

@push('plugin-styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inovasiPrestasiOpd.index') }}">Inovasi Prestasi Daerah</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Inovasi Prestasi Daerah</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Inovasi Prestasi Daerah</h4>
                @include('partials.errors')
                <form
                    action="@isset($inovasiPrestasiOpd) {{ route('inovasiPrestasiOpd.update', $inovasiPrestasiOpd->id) }} @endisset @empty($inovasiPrestasiOpd) {{ route('inovasiPrestasiOpd.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($inovasiPrestasiOpd)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($inovasiPrestasiOpd) ? $inovasiPrestasiOpd->name : @old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="opd_id" class="form-label">OPD</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="opd_id" required>
                            <option value="">Select OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}"
                                    @isset($inovasiPrestasiOpd)
                                    @selected($opd->id == $inovasiPrestasiOpd->opd_id)
                                @endisset>
                                    {{ $opd->nama_opd }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Tahun</label>
                        <input id="year" class="form-control" name="year" type="number" required
                            value="{{ isset($inovasiPrestasiOpd) ? $inovasiPrestasiOpd->year : @old('year') }}">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Tanggal</label>
                        <input id="date" class="form-control" name="date" type="date" required
                            value="{{ isset($inovasiPrestasiOpd) ? $inovasiPrestasiOpd->date : @old('date') }}">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Instansi Pemberi</label>
                        <input id="instansi_pemberi" class="form-control" name="instansi_pemberi" type="text"
                            value="{{ isset($inovasiPrestasiOpd) ? $inovasiPrestasiOpd->instansi_pemberi : @old('instansi_pemberi') }}">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control">{{ isset($inovasiPrestasiOpd) ? $inovasiPrestasiOpd->description : @old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">File</label>
                        <input type="file" name="file" id="file"
                            @empty($inovasiPrestasiOpd) required @endempty />
                    </div>
                    @isset($inovasiPrestasiOpd->file)
                        <a href="{{ asset('uploads/' . $inovasiPrestasiOpd->file) }}" target="_blank">Buka File</a>
                    @endisset
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
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script>
        const inputElement = document.querySelector('input[id="file"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '{{ route('upload.store') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>
@endpush
