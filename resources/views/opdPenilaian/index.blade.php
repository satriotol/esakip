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
                                    <th>Year</th>
                                    <th>OPD</th>
                                    <th>Type</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPenilaians as $opdPenilaian)
                                    <tr>
                                        <td>{{ $opdPenilaian->year }}</td>
                                        <td>{{ $opdPenilaian->opd->nama_opd }}</td>
                                        <td>{{ $opdPenilaian->type }}</td>
                                        <td>
                                            @if ($opdPenilaian->file)
                                                <a class="badge bg-danger" target="_blank"
                                                    href="{{ $opdPenilaian->file_url }}"> Open File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('opdPenilaian.show', $opdPenilaian->id) }}"
                                                class="btn btn-sm btn-primary ml-1">Detail</a>
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
