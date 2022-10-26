@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdCategory.index') }}">Kategori Opd</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Kategori Opd</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Kategori Opd</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('opdCategory.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tipe</th>
                                    <th>Variabel</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdCategories as $opdCategory)
                                    <tr>
                                        <td>
                                            {{ $opdCategory->name }}
                                        </td>
                                        <td>
                                            {{ $opdCategory->type }}
                                        </td>
                                        <td>
                                            @foreach ($opdCategory->opd_category_variables as $opd_category_variable)
                                                <div class="badge bg-success">
                                                    {{ $opd_category_variable->opd_variable->name }} |
                                                    {{ $opd_category_variable->opd_variable->bobot }}
                                                </div> <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('opdCategory.show', $opdCategory->id) }}">
                                                Detail
                                            </a>
                                            <form action="{{ route('opdCategory.destroy', $opdCategory->id) }}"
                                                method="POST" class="d-inline">
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
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
