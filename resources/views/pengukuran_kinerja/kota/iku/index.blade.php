@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('ikuKota.index') }}">{{$name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tabel {{$name}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{$name}}</h6>
                    <div class="text-end mb-2">
                        @if ($ikuKotas->count() == 0)
                            <a class="btn btn-primary" href="{{ route('ikuKota.create') }}">
                                <i data-feather="plus"></i>
                                Create
                            </a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ikuKotas as $ikuKota)
                                    <tr>
                                        <td>
                                            <object data="{{ asset('uploads/' . $ikuKota->file) }}"
                                                class="w-100 mt-5" style="height: 550px" type="application/pdf">
                                                <div>No online PDF viewer installed</div>
                                            </object>
                                        </td>
                                        <td> <a class="btn btn-warning btn-icon"
                                                href="{{ route('ikuKota.edit', $ikuKota->id) }}">
                                                <i data-feather="edit"></i>
                                            </a>
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
