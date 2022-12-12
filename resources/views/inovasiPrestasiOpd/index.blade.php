@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inovasiPrestasiOpd.index') }}">Inovasi Prestasi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Inovasi Prestasi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Inovasi Prestasi</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('inovasiPrestasiOpd.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>OPD</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inovasiPrestasiOpds as $inovasiPrestasiOpd)
                                    <tr>
                                        <td>{{ $inovasiPrestasiOpd->opd->nama_opd }}</td>
                                        <td>{{ $inovasiPrestasiOpd->name }}</td>
                                        <td>{{ $inovasiPrestasiOpd->date }}</td>
                                        <td>
                                            <a class="btn btn-warning"
                                                href="{{ route('inovasiPrestasiOpd.edit', $inovasiPrestasiOpd->id) }}">
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('inovasiPrestasiOpd.destroy', $inovasiPrestasiOpd->id) }}"
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
