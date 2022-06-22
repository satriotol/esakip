@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('perencanaan_kinerja_rkpd.index') }}">Perencanaan Kinerja RKPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Perencanaan Kinerja RKPD</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Perencanaan Kinerja RKPD</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('perencanaan_kinerja_rkpd.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Name</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perencanaan_kinerja_rkpds as $perencanaan_kinerja_rkpd)
                                    <tr>
                                        <td>{{ $perencanaan_kinerja_rkpd->year }}</td>
                                        <td>{{ $perencanaan_kinerja_rkpd->name }}</td>
                                        <td>
                                            <a class="btn btn-success btn-icon" target="_blank"
                                                href="{{ asset('uploads/' . $perencanaan_kinerja_rkpd->file) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </td>
                                        <td> <a class="btn btn-warning btn-icon"
                                                href="{{ route('perencanaan_kinerja_rkpd.edit', $perencanaan_kinerja_rkpd->id) }}">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('perencanaan_kinerja_rkpd.destroy', $perencanaan_kinerja_rkpd->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-icon show_confirm"
                                                    data-toggle="tooltip" title='Delete'>
                                                    <i data-feather="trash"></i>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    @endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush
