@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('cascadingKinerjaOpd.index') }}">{{ $name }}</a>
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
                        <a class="btn btn-primary" href="{{ route('cascadingKinerjaOpd.create') }}">
                            <i data-feather="plus"></i>
                            Tambah
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>OPD</th>
                                    <th>Tipe</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cascadingKinerjaOpds as $cascadingKinerjaOpd)
                                    <tr>
                                        <td>{{ $cascadingKinerjaOpd->year }}</td>
                                        <td>{{ $cascadingKinerjaOpd->opd->nama_opd }}</td>
                                        <td>{{ $cascadingKinerjaOpd->type }}</td>
                                        <td><a href="{{ asset('uploads/' . $cascadingKinerjaOpd->file) }}" target="_blank"
                                                class="btn btn-success">Buka</a></td>
                                        <td>
                                            @can('opdCascadingKinerja-edit')
                                                <a href="{{ route('cascadingKinerjaOpd.edit', $cascadingKinerjaOpd->id) }}"
                                                    class="btn btn-sm btn-warning ml-1">Edit</a>
                                            @endcan
                                            @can('opdCascadingKinerja-delete')
                                                <form
                                                    action="{{ route('cascadingKinerjaOpd.destroy', $cascadingKinerjaOpd->id) }}"
                                                    method="POST" class="d-inline">
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
                    {{ $cascadingKinerjaOpds->appends($_GET)->links() }}

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
