@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPerjanjianKinerja.index') }}">{{ $name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail {{ $name }}
                {{ $opdPerjanjianKinerja->opd_name }} {{ $opdPerjanjianKinerja->year }}</li>
        </ol>
        <a href="{{ route('opdPerjanjianKinerja.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div class="row">
        <div class="col-xl-12 main-content ps-xl-4 pe-xl-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" role="tab"
                        aria-controls="detail" aria-selected="true">Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="sasaran-tab" data-bs-toggle="tab" data-bs-target="#sasaran" role="tab"
                        aria-controls="sasaran" aria-selected="false">Sasaran</a>
                </li>
            </ul>
            <div class="tab-content border border-top-0 p-3" id="myTabContent" style="background-color: white">
                <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                    <p>
                        Tahun : {{ $opdPerjanjianKinerja->year }} <br>
                        OPD : {{ $opdPerjanjianKinerja->opd_name }} <br>
                        Type : {{ $opdPerjanjianKinerja->type }}
                    </p>
                    <object data="{{ asset('uploads/' . $opdPerjanjianKinerja->file) }}" class="w-100 mt-1"
                        style="height: 550px" type="application/pdf">
                        <div>No online PDF viewer installed</div>
                    </object>
                </div>
                <div class="tab-pane fade" id="sasaran" role="tabpanel" aria-labelledby="sasaran-tab">
                    <div class="text-end">
                        <a href="{{ route('opdPerjanjianKinerjaSasaran.create', $opdPerjanjianKinerja->id) }}"
                            class="btn btn-sm btn-success ml-1">Tambah Sasaran</a>
                    </div>
                    <div class="table-responsive mt-2">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sasaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPerjanjianKinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                                    <tr>
                                        <td>{{ $opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                                        <td>
                                            <a class="badge rounded-pill bg-warning text-dark"
                                                href="{{ route('opdPerjanjianKinerjaSasaran.edit', [$opdPerjanjianKinerja->id, $opd_perjanjian_kinerja_sasaran->id]) }}">
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('opdPerjanjianKinerjaSasaran.destroy', $opd_perjanjian_kinerja_sasaran->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge rounded-pill bg-danger" style="border: 0"
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
    <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
