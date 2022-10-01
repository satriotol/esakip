@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
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
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('opdPerjanjianKinerja.create') }}">
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
                                            @if ($opdPerjanjianKinerja->file)
                                                <a class="btn btn-sm btn-success" target="_blank"
                                                    href="{{ $opdPerjanjianKinerja->file_url }}"> Open File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja->id) }}"
                                                class="btn btn-sm btn-primary ml-1">Detail</a>
                                            <a href="{{ route('opdPerjanjianKinerja.edit', $opdPerjanjianKinerja->id) }}"
                                                class="btn btn-sm btn-warning ml-1">Edit</a>
                                            <form action="{{ route('opdPerjanjianKinerja.destroy', $opdPerjanjianKinerja->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
@endpush
