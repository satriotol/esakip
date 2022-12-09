@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@push('style')
    <style>
        html {
            zoom: 100%;
        }

        td {
            white-space: normal !important;
            word-wrap: break-word;
        }

        table {
            table-layout: fixed;
        }
    </style>
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('error.index') }}">Error</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Error</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Error</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>User</th>
                                    <th>Error Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($errors as $error)
                                    <tr>
                                        <td>{{ $error->created_at }}</td>
                                        <td>{{ $error->user->name }}</td>
                                        <td>{{ $error->message }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $error->id }}">
                                                Detail
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $error->id }}" tabindex="-1"
                                                aria-labelledby="exampleModal{{ $error->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="exampleModal{{ $error->id }}Label">Error Detail
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="">
                                                                <table class="table">
                                                                    <tr>
                                                                        <td>User</td>
                                                                        <td>{{ $error->user->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Code</td>
                                                                        <td>{{ $error->code }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>File</td>
                                                                        <td>{{ $error->file }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Line</td>
                                                                        <td>{{ $error->line }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Message</td>
                                                                        <td>{{ $error->message }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Trace</td>
                                                                        <td>{{ $error->trace }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $errors->links() }}
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
