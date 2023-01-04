@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPerjanjianKinerja.index') }}">{{ $name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel {{ $name }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{ $name }}</h6>
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="number" class="form-control" name="year" value="{{ old('year') }}"
                                        id="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipe</label>
                                    <select name="type" class="form-control" id="">
                                        <option value="">Pilih Tipe</option>
                                        @foreach ($types as $type)
                                            <option {{ old('type') == $type ? 'selected' : '' }}
                                                value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="">Pilih Status</option>
                                        @foreach ($statuses as $status)
                                            <option {{ old('status') == $status ? 'selected' : '' }}
                                                value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>OPD</label>
                                    <select name="opd_id" class="js-example-basic-single form-select" id="">
                                        <option value="">Pilih OPD</option>
                                        @foreach ($opds as $opd)
                                            <option {{ old('opd_id') == $opd->id ? 'selected' : '' }}
                                                value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-sm btn-success">Cari</button>
                        </div>
                    </form>
                    <div class="text-end mt-2">
                        <a class="badge bg-primary" href="{{ route('opdPerjanjianKinerja.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>OPD</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPerjanjianKinerjas as $opdPerjanjianKinerja)
                                    <tr>
                                        <td>{{ $opdPerjanjianKinerja->year }}</td>
                                        <td>{{ $opdPerjanjianKinerja->opd->nama_opd }}</td>
                                        <td>{{ $opdPerjanjianKinerja->type }}</td>
                                        <td>
                                            <div class="badge bg-info">
                                                {{ $opdPerjanjianKinerja->status ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($opdPerjanjianKinerja->file)
                                                <a class="badge bg-danger" target="_blank"
                                                    href="{{ $opdPerjanjianKinerja->file_url }}"> Open File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja->id) }}"
                                                class="badge bg-primary ml-1">Detail</a>
                                            @if ($opdPerjanjianKinerja->status != 'DITERIMA')
                                                <a href="{{ route('opdPerjanjianKinerja.edit', $opdPerjanjianKinerja->id) }}"
                                                    class="badge bg-warning ml-1">Edit</a>
                                                <form
                                                    action="{{ route('opdPerjanjianKinerja.destroy', $opdPerjanjianKinerja->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $opdPerjanjianKinerjas->appends($_GET)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
