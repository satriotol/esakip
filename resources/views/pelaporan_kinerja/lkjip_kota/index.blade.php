@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('lkjip_kota.index') }}">Pelaporan Kinerja LKJIP</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Pelaporan Kinerja LKJIP</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Pelaporan Kinerja LKJIP</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('lkjip_kota.create') }}">
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
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#dataTableExample').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('lkjip_kota.getLkjipKota') }}",
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
