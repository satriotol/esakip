@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@push('style')
    <style>
        /* html {
                                                                        zoom: 100%;
                                                                    } */
    </style>
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('audit.index') }}">Audit</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Audit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Audit</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('audit.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audits as $audit)
                                    <tr>
                                        <td>{{ $audit->created_at }}</td>
                                        <td>{{ $audit->user->name }} <br>{{ $audit->auditable_type }}
                                            <br>{{ $audit->event }}
                                        </td>
                                        <td>
                                            {{ $audit->old_values }}
                                        </td>
                                        <td>
                                            <div id="json">

                                                <pre>{{ $audit->new_values }}</pre>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $audits->appends($_GET)->links() }}
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
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        document.getElementById("json").textContent = JSON.stringify(data, null, 2);
    </script>
@endpush
