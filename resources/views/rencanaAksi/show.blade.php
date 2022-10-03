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
        <div class="col-xl-12 main-content ps-xl-4 pe-xl-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($opdPerjanjianKinerja->rencana_aksis as $key => $rencanaAksi)
                    <li class="nav-item">
                        <a class="nav-link  @if ($loop->first) active @endif" id="{{ $rencanaAksi->slug }}-tab" data-bs-toggle="tab"
                            data-bs-target="#{{ $rencanaAksi->slug }}" role="tab"
                            aria-controls="{{ $rencanaAksi->slug }}" aria-selected="true">{{ $rencanaAksi->name }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content border border-top-0 p-3" id="myTabContent" style="background-color: white">
                @foreach ($opdPerjanjianKinerja->rencana_aksis as $rencana_aksi)
                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                        id="{{ $rencana_aksi->slug }}" role="tabpanel" aria-labelledby="{{ $rencana_aksi->slug }}-tab">
                        @include('rencanaAksi.rencanaAksiTarget', [
                            'rencanaAksi' => $rencana_aksi,
                        ])
                    </div>
                @endforeach
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
