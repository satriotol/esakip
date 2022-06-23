@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('periodeRenstraOpd.index') }}">Perencanaan Kinerja
                    renstra OPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Perencanaan Kinerja renstra OPD
                {{ $periodeRenstraOpd->start_year }} - {{ $periodeRenstraOpd->end_year }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Perencanaan Kinerja renstra OPD {{ $periodeRenstraOpd->start_year }} -
                        {{ $periodeRenstraOpd->end_year }}</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('renstraOpd.create', $periodeRenstraOpd) }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Periode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($renstraOpds as $renstraOpd)
                                    <tr>
                                        {{-- <td>{{ $periodeRenstraOpd->start_year }} - {{ $periodeRenstraOpd->end_year }}
                                        </td>
                                        <td> <a class="btn btn-warning"
                                                href="{{ route('renstraOpd.edit', $periodeRenstraOpd->id) }}">
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('renstraOpd.destroy', $periodeRenstraOpd->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form> --}}
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
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
