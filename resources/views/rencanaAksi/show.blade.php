@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('rencanaAksi.index') }}">{{ $name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail {{ $name }}
                {{ $opdPerjanjianKinerja->opd_name }} {{ $opdPerjanjianKinerja->year }}</li>
        </ol>
        <a href="{{ route('rencanaAksi.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{ $name }}</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>TRIWULAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPerjanjianKinerja->rencana_aksis as $rencana_aksi)
                                    <tr>
                                        <td>{{ $rencana_aksi->name }}</td>
                                        <td>
                                            <a href="{{ route('rencanaAksiTarget.create', $rencana_aksi->id) }}"
                                                class="badge bg-success">
                                                Rencana Aksi
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
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
                '][subject]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
