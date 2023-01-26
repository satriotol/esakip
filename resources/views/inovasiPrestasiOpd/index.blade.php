@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@push('style')
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
                    <form action="{{ route('inovasiPrestasiOpd.index') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="year" value="{{ old('year') }}"
                                    id="">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>OPD</label>
                                    <select name="opd_id" class="js-example-basic-single form-select" id="">
                                        <option value="">Pilih OPD</option>
                                        @foreach ($opds as $opd)
                                            <option @selected(old('opd_id') == $opd->id) value="{{ $opd->id }}">
                                                {{ $opd->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-end">
                                <button name="submit" value="exportExcel" class="btn btn-sm btn-success">Export
                                    Excel</button>
                                <button name="submit" class="btn btn-sm btn-success">Cari</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>OPD</th>
                                    <th>Status</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inovasiPrestasiOpds as $inovasiPrestasiOpd)
                                    <tr>
                                        <td>{{ $inovasiPrestasiOpd->year }}</td>
                                        <td>{{ $inovasiPrestasiOpd->opd->nama_opd }} <br>
                                            <small>{{ $inovasiPrestasiOpd->inovasi_prestasi_tingkat->name }}</small>
                                        </td>
                                        <td>
                                            <div class="badge bg-{{ $inovasiPrestasiOpd->getStatus()['color'] }}">
                                                {{ $inovasiPrestasiOpd->getStatus()['name'] }}
                                            </div>
                                        </td>
                                        <td class="text-wrap">{{ $inovasiPrestasiOpd->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop{{ $inovasiPrestasiOpd->id }}">
                                                Detail
                                            </button>
                                            <div class="modal fade" id="staticBackdrop{{ $inovasiPrestasiOpd->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdrop{{ $inovasiPrestasiOpd->id }}Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    @include('inovasiPrestasiOpd.modalInovasi')
                                                </div>
                                            </div>
                                            @if ($inovasiPrestasiOpd->getStatus()['enabled'])
                                                <a class="btn btn-warning"
                                                    href="{{ route('inovasiPrestasiOpd.edit', $inovasiPrestasiOpd->id) }}">
                                                    Edit
                                                </a>
                                            @endif
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
                        {{ $inovasiPrestasiOpds->appends($_GET)->links() }}
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
