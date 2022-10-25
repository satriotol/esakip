@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaian.index') }}">Penilaian OPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Penilaian OPD</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Penilaian OPD</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('opdPenilaian.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Kategori</th>
                                    <th>OPD</th>
                                    <th>Inovasi Prestasi Daerah</th>
                                    <th>Total Akhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPenilaians as $opdPenilaian)
                                    <tr>
                                        <td>{{ $opdPenilaian->year }} {{ $opdPenilaian->name }}</td>
                                        <td>{{ $opdPenilaian->opd_category->name }}</td>
                                        <td>{{ $opdPenilaian->opd->nama_opd }}</td>
                                        <td>{{ $opdPenilaian->inovasi_prestasi_daerah }}</td>
                                        <td>{{ $opdPenilaian->totalAkhir() }}</td>
                                        <td>

                                            <a href="{{ route('opdPenilaian.show', $opdPenilaian->id) }}"
                                                class="btn btn-sm btn-primary ml-1">Detail</a>
                                            <form action="{{ route('opdPenilaian.destroy', $opdPenilaian->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $opdPenilaians->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
