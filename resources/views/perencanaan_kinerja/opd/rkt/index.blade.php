@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('rktOpd.index') }}">{{ $name }}</a>
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
                        <a class="btn btn-primary" href="{{ route('rktOpd.create') }}">
                            <i data-feather="plus"></i>
                            Tambah
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>OPD</th>
                                    <th>Name</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rkt_opds as $rkt_opd)
                                    <tr>
                                        <td>{{ $rkt_opd->year }}</td>
                                        <td>{{ $rkt_opd->opd->nama_opd }}</td>
                                        <td>{{ $rkt_opd->name }}</td>
                                        <td><a href="{{ asset('uploads/' . $rkt_opd->file) }}" target="_blank"
                                                class="btn btn-success">Buka</a></td>
                                        <td>
                                            @can('opdRenja-edit')
                                                <a href="{{ route('rktOpd.edit', $rkt_opd->id) }}"
                                                    class="btn btn-sm btn-warning ml-1">Edit</a>
                                            @endcan
                                            @can('opdRenja-delete')
                                                <form action="{{ route('rktOpd.destroy', $rkt_opd->id) }}" method="POST"
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
                    {{ $rkt_opds->appends($_GET)->links() }}
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
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#dataTableExample').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('rktOpd.getRktOpd') }}",
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                },
                columns: [{
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'opd.nama_opd',
                        name: 'opd.nama_opd'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'pdf',
                        name: 'pdf',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
