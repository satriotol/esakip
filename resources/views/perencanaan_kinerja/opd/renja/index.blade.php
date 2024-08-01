@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('renjaOpd.index') }}">{{ $name }}</a>
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
                        @can('opdRenja-create')
                            <a class="btn btn-primary" href="{{ route('renjaOpd.create') }}">
                                <i data-feather="plus"></i>
                                Tambah
                            </a>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>OPD</th>
                                    <th>Type</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($renja_opds as $renja_opd)
                                    <tr>
                                        <td>
                                            {{ $renja_opd->year }}
                                        </td>
                                        <td>{{ $renja_opd->opd->nama_opd }}</td>
                                        <td>{{ $renja_opd->type }}</td>
                                        <td><a href="{{ asset('uploads/' . $renja_opd->file) }}" target="_blank"
                                                class="btn btn-success">Buka</a></td>
                                        <td>
                                            @can('opdRenja-edit')
                                                <a href="{{ route('renjaOpd.edit', $renja_opd->id) }}"
                                                    class="btn btn-sm btn-warning ml-1">Edit</a>
                                            @endcan
                                            @can('opdRenja-delete')
                                                <form action="{{ route('renjaOpd.destroy', $renja_opd->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    {{ $renja_opds->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
