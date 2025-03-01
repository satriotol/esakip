@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Selamat Datang Di Dashboard E-SAKIP</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-2">
            <a href="https://penilaian.e-sakip.semarangkota.go.id/" target="_blank">
                <div class="card">
                    <div class="card-body text-center">
                        <h2>
                            Penilaian AKIP
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        @can('pengelolaanaset-bpkad')
            <div class="col-md-4">
                <a href="{{ route('login.pengelolaanaset') }}" target="_blank">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2>
                                Pengelolaan Aset
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <h5>Pencarian</h5>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Tahun</label>
                                    <input id="year" class="form-control" name="year" type="number"
                                        placeholder="yyyy" value="{{ @old('year') }}">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="opd_id" class="form-label">OPD</label>
                                    <select name="opd_id" class="js-example-basic-single form-select">
                                        <option value="">Pilih OPD</option>
                                        @foreach ($opds as $opd)
                                            <option value="{{ $opd->id }}"
                                                {{ old('opd_id') == $opd->id ? 'selected' : '' }}>
                                                {{ $opd->nama_opd }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <input class="btn btn-primary" type="submit" value="Cari">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Penilaian OPD</h5>
                </div>
                <div class="card-body">
                    @if ($opd_penilaians->isEmpty())
                        <div class="alert alert-danger" role="alert">
                            Belum Ada Penilaian Kinerja Organisasi Untuk Tahun Ini
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>OPD</th>
                                    <th>Tahun</th>
                                    <th>Periode</th>
                                    <th>Nilai</th>
                                    <th>Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opd_penilaians as $opd_penilaian)
                                    <tr>
                                        <td>{{ $opd_penilaian->opd->nama_opd }}</td>
                                        <td>{{ $opd_penilaian->year }}</td>
                                        <td>{{ $opd_penilaian->name ?? 'TAHUNAN' }}</td>
                                        <td>{{ $opd_penilaian->totalAkhir() }}</td>
                                        <td>
                                            @if ($opd_penilaian->opd_penilaian_feedback)
                                                Sudah Ada Feedback
                                            @else
                                                Belum Ada Feedback
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $opd_penilaians->appends($_GET)->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
