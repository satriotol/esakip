@extends('layout.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Dashboard Integrasi BKN</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Pencarian</h5>
        </div>
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-6">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input id="tahun" class="form-control" name="tahun" value="{{ @old('tahun') }}" type="number" placeholder="yyyy"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="opd" class="form-label">OPD</label>
                        <select name="opd" class="js-example-basic-single form-select" data-placeholder="Pilih OPD"
                            id="opd">
                            <option value="">Pilih OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd['nama_opd'] }}"
                                    {{ old('opd') == $opd['nama_opd'] ? 'selected' : '' }}>
                                    {{ $opd['nama_opd'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary mt-3">Cari</button>
                </div>
            </form>
        </div>
    </div>
    @isset($data)
        @isset($data['pegawai'])
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Pegawai</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $data['pegawai']['nama'] }}</td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>{{ $data['pegawai']['nip'] }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>{{ $data['bkn_rhk']['pegawai_jabatan'] }}</td>
                                </tr>
                                <tr>
                                    <td>Unit Kerja</td>
                                    <td>{{ $data['bkn_rhk']['pegawai_unit_kerja'] }}</td>
                                </tr>
                                <tr>
                                    <td>Atasan</td>
                                    <td>{{ $data['bkn_rhk']['atasan_nama'] }} ({{ $data['bkn_rhk']['atasan_jabatan'] }})</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $data['bkn_rhk']['status'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Rencana Hasil Kerja</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>RHK</th>
                                    <th>Indikator</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['rencana_hasil_kerja'] as $index => $rhk)
                                    <tr>
                                        <td rowspan="{{ count($rhk['indikator']) + 1 }}">{{ $index + 1 }}</td>
                                        <td rowspan="{{ count($rhk['indikator']) + 1 }}">{{ $rhk['rhk'] }}</td>
                                    </tr>
                                    @foreach ($rhk['indikator'] as $indikator)
                                        <tr>
                                            <td>{{ $indikator['indikator'] }}</td>
                                            <td>{{ $indikator['target'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endisset
    @endisset
@endsection
