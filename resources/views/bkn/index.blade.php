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
                        <input id="tahun" class="form-control" name="tahun" value="{{ @old('tahun') }}" type="number"
                            placeholder="yyyy" required>
                    </div>
                    <div class="col-md-6">
                        <label for="opd" class="form-label">OPD</label>
                        <select name="opd" class="js-example-basic-single form-select" data-placeholder="Pilih OPD"
                            id="opd">
                            <option value="">Pilih OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd['bkn_id'] }}" {{ old('opd') == $opd['bkn_id'] ? 'selected' : '' }}>
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
                    <h5>Informasi </h5>
                </div>
                <div class="card-body">
                    <h5>Periode Penilaian : {{ $data['bkn_rhk']['periode_awal'] }} s/d {{ $data['bkn_rhk']['periode_akhir'] }}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th colspan="2">PEGAWAI YANG DINILAI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Nama</td>
                                            <td>{{ $data['pegawai']['nama'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>NIP</td>
                                            <td>{{ $data['pegawai']['nip'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Pangkat / Gol Ruang</td>
                                            <td>{{ $data['bkn_rhk']['pangkat'] }} / {{ $data['bkn_rhk']['pegawai_golru'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Jabatan</td>
                                            <td>{{ $data['bkn_rhk']['pegawai_jabatan'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Unit Kerja</td>
                                            <td>{{ $data['bkn_rhk']['pegawai_unit_kerja'] }} <br>
                                                ID : {{ $data['bkn_rhk']['bkn_skp_id'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th colspan="2">PEJABAT PENILAI KINERJA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Nama</td>
                                            <td>{{ $data['bkn_rhk']['atasan_nama'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>NIP</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Pangkat / Gol Ruang</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Jabatan</td>
                                            <td>{{ $data['bkn_rhk']['atasan_jabatan'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Unit Kerja</td>
                                            <td>{{ $data['bkn_rhk']['atasan_unit_kerja'] }} <br>
                                                ID : {{ $data['bkn_rhk']['bkn_skp_id'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Rencana Hasil Kerja</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">No</th>
                                        <th class="text-wrap">RHK</th>
                                        <th class="text-wrap">Indikator</th>
                                        <th class="text-wrap">Target</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['rencana_hasil_kerja'] as $index => $rhk)
                                        <tr>
                                            <td rowspan="{{ count($rhk['indikator']) + 1 }}" class="align-top text-wrap">
                                                {{ $index + 1 }}</td>
                                            <td rowspan="{{ count($rhk['indikator']) + 1 }}" class="align-top text-wrap">
                                                {{ $rhk['rhk'] }}</td>
                                        </tr>
                                        @foreach ($rhk['indikator'] as $indikator)
                                            <tr>
                                                <td class="text-wrap">{{ $indikator['indikator'] }}</td>
                                                <td class="text-wrap">{{ $indikator['target'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>SKP</h5>
                        </div>
                        <div class="card-body">
                            <a href="{{route('opdPerjanjianKinerja.show', $opd_perjanjian_kinerja->id)}}" target="_blank">
                                Perjanjian Kinerja {{$opd_perjanjian_kinerja->year}} | {{$opd_perjanjian_kinerja->type}}
                            </a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">No</th>
                                        <th class="text-wrap">Sasaran</th>
                                        <th class="text-wrap">Indikator</th>
                                        <th class="text-wrap">Target</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($opd_perjanjian_kinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                                        <tr>
                                            <td
                                                rowspan="{{ count($opd_perjanjian_kinerja_sasaran->opd_perjanjian_kinerja_indikators) + 1 }}">
                                                {{ $loop->iteration }}</td>
                                            <td rowspan="{{ count($opd_perjanjian_kinerja_sasaran->opd_perjanjian_kinerja_indikators) + 1 }}"
                                                class="text-wrap">{{ $opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                                        </tr>
                                        @foreach ($opd_perjanjian_kinerja_sasaran->opd_perjanjian_kinerja_indikators as $opd_perjanjian_kinerja_indikator)
                                            <tr>
                                                <td class="text-wrap">{{ $opd_perjanjian_kinerja_indikator->indikator }}</td>
                                                <td class="text-wrap">{{ $opd_perjanjian_kinerja_indikator->target }}
                                                    {{ $opd_perjanjian_kinerja_indikator->satuan }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <table class="table table-bordered mt-5">
                        <tbody>
                            <tr>
                                <td>Dukungan</td>
                                <td>
                                    <textarea class="form-control" id="" disabled rows="5">{{ $data['bkn_rhk']['dukungan'] }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Konsekuensi</td>
                                <td>
                                    <textarea class="form-control" id="" disabled rows="5">{{ $data['bkn_rhk']['konsekuensi'] }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Pertanggung Jawaban</td>
                                <td>
                                    <textarea class="form-control" id="" disabled rows="5">{{ $data['bkn_rhk']['pertanggungjawaban'] }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endisset
    @endisset
@endsection
