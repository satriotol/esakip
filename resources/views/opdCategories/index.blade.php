@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdCategories.index') }}">Kategori Opd</a>
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
                        <a class="btn btn-primary" href="{{ route('opdCategories.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Reformasi Birokrasi</th>
                                    <th>SAKIP</th>
                                    <th>IKU</th>
                                    <th>Penyerapan Anggaran Belanja</th>
                                    <th>Realisasi Target Pendapatan</th>
                                    <th>P3DN</th>
                                    <th>Inovasi Prestasi Daerah</th>
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
                                            {{ $opdCategory->reformasi_birokrasi }}
                                        </td>
                                        <td>
                                            {{ $opdCategory->sakip }}
                                        </td>
                                        <td>
                                            {{ $opdCategory->iku }}
                                        </td>
                                        <td>
                                            {{ $opdCategory->penyerapan_anggaran_belanja }}
                                        </td>
                                        <td>
                                            {{ $opdCategory->realisasi_target_pendapatan }}
                                        </td>
                                        <td>
                                            {{ $opdCategory->p3dn }}
                                        </td>
                                        <td>
                                            {{ $opdCategory->inovasi_prestasi_daerah }}
                                        </td>
                                        <td>
                                            <a class="btn btn-warning"
                                                href="{{ route('opdCategories.edit', $opdCategory->id) }}">
                                                Edit
                                            </a>
                                            <form action="{{ route('opdCategories.destroy', $opdCategory->id) }}" method="POST"
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
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush