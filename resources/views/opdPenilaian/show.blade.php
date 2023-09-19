@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush
@push('style')
    <style>
    </style>
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaian.index') }}">Penilaian OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Penilaian OPD</li>
        </ol>
        <a href="{{ route('opdPenilaian.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div class="row">
        @include('partials.errors')
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Penilaian OPD</h4>
                    <div class="mb-3">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td>{{ $opdPenilaian->year }} {{ $opdPenilaian->name }}</td>
                                </tr>
                                <tr>
                                    <td>OPD</td>
                                    <td>:</td>
                                    <td class="text-wrap">{{ $opdPenilaian->opd->nama_opd }}</td>
                                </tr>
                                <tr>
                                    <td>Perjanjian Kinerja</td>
                                    <td>:</td>
                                    <td class="text-wrap">
                                        @isset($opdPenilaian->opd_perjanjian_kinerja_id)
                                            <a href="{{ route('opdPerjanjianKinerja.show', $opdPenilaian->opd_perjanjian_kinerja_id) }}"
                                                target="_blank">
                                                {{ $opdPenilaian->opd_perjanjian_kinerja->type }}
                                            </a>
                                        @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td class="text-wrap">{{ $opdPenilaian->opd_category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Inovasi Prestasi Daerah</td>
                                    <td>:</td>
                                    <td>{{ $opdPenilaian->inovasi_prestasi_daerah }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="test"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Status</h6>
                    <form action="{{ route('opdPenilaian.updateStatus', $opdPenilaian->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="js-example-basic-single form-select" required
                                @disabled(Auth::user()->opd_id)>
                                <option value="">Pilih Status</option>
                                @foreach ($statuses as $status)
                                    <option @selected($status == $opdPenilaian->status) value="{{ $status }}">{{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Catatan</label>
                            <textarea name="note" class="form-control" @disabled(Auth::user()->opd_id)>{{ $opdPenilaian->note }}</textarea>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-sm btn-success" @disabled(Auth::user()->opd_id)
                                type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if ($opdPenilaian->opd->is_staff_ahli)
            @include('opdPenilaian.staffAhli')
        @endif

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Penilaian Kinerja OPD</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Variabel</th>
                                    <th>Bobot</th>
                                    <th>Target</th>
                                    <th>Realisasi</th>
                                    <th>Capaian</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdPenilaian->opd_category->opd_category_variables as $opd_category_variable)
                                    <tr>
                                        <td>
                                            {{ $opd_category_variable->opd_variable->name }} |
                                            @if ($opd_category_variable->opd_variable->pic == 'BAPENDA' && $checkStatus != 1)
                                                <a class="badge bg-primary tarik-data"
                                                    href="{{ route('opdPenilaianKinerja.getRealisasiTargetPendapatan', [$opdPenilaian->id, $opd_category_variable->id]) }}">TARIK
                                                    DATA BAPENDA (WEBSERVICE BAPENDA)</a>
                                                <br>
                                                <small class="text-danger">
                                                    Nominal merupakan data realisasi yang sudah dilaporkan ke BAPENDA <a
                                                        href="http://103.101.52.67:13000/api/bapenda/realtime/getDataRealtimePadByDate?tglawal={{ $opdPenilaian->year }}-01-01&tglakhir={{ $opdPenilaian->year }}-12-31"
                                                        target="_blank">Disini</a>
                                                </small>
                                            @elseif ($opd_category_variable->opd_variable->pic == 'SIPD' && $checkStatus != 1)
                                                <a href="{{ route('opdPenilaianKinerja.storeSipd', [$opdPenilaian->id, $opd_category_variable->id, $opdPenilaian->year, $opdPenilaian->opd->data_unit_id]) }}"
                                                    class="badge bg-primary tarik-data">
                                                    TARIK DATA DARI SIPD (QUERY BAPPEDA)
                                                </a>
                                                <br>
                                                <small class="text-danger">
                                                    Jika Terjadi Selisih Bisa Melakukan Konfirmasi Ke BPKAD KOTA SEMARANG
                                                </small>
                                            @elseif ($opd_category_variable->opd_variable->pic == 'P3DN' && $checkStatus != 1)
                                                <a href="{{ route('opdPenilaianKinerja.storep3dn', [$opdPenilaian->id, $opd_category_variable->id, $opdPenilaian->year, $opdPenilaian->opd->data_unit_id]) }}"
                                                    class="badge bg-primary tarik-data">
                                                    TARIK DATA P3DN (QUERY BAPPEDA)
                                                </a>
                                                <br>
                                                <small class="text-danger">
                                                    Pastikan Sudah Melakukan Validasi Dan Update Realisasi di <a
                                                        href="https://siera.bpkp.go.id/" target="_blank">Siera BPKP</a>
                                                </small>
                                            @elseif($opd_category_variable->opd_variable->is_reformasi_birokrasi && $checkStatus != 1)
                                                <a href="{{ route('opdPenilaianKinerja.storeRb', [$opdPenilaian->id, $opd_category_variable->id, $opdPenilaian->year]) }}"
                                                    class="badge bg-primary tarik-data">
                                                    TARIK DATA REFORMASI BIROKRASI (LKE-RB)
                                                </a>
                                                <br>
                                                <small class="text-danger">
                                                    Mengambil Data Dari <a href="http://lke-rb.semarangkota.go.id/"
                                                        target="_blank">LKE RB KOTA SEMARANG</a>
                                                </small>
                                            @elseif($opd_category_variable->opd_variable->is_sakip && $checkStatus != 1)
                                                <a href="{{ route('opdPenilaianKinerja.storeAkip', [$opdPenilaian->id, $opd_category_variable->id, $opdPenilaian->year]) }}"
                                                    class="badge bg-primary tarik-data">
                                                    TARIK DATA E-SAKIP
                                                </a>
                                            @elseif($opd_category_variable->opd_variable->is_iku && $checkStatus != 1)
                                                <a type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $opd_category_variable->id }}">
                                                    INPUT RENCANA AKSI
                                                </a>
                                                <br>
                                                <small class="text-danger">
                                                    Mengambil Data Dari Perjanjian Kinerja <a
                                                        href="{{ route('opdPerjanjianKinerja.show', $opdPenilaian->opd_perjanjian_kinerja_id) }}"
                                                        target="_blank">{{ $opdPenilaian->opd_perjanjian_kinerja->type }}</a>
                                                </small>
                                                @if ($getIkuStatus)
                                                    <br>
                                                    <small class="badge bg-success">
                                                        Total Verifikasi : {{ $getIkuStatus['is_verified'] }} /
                                                        {{ $getIkuStatus['total'] }}
                                                    </small>
                                                @endif
                                            @elseif($opd_category_variable->opd_variable->is_iku_triwulan && $checkStatus != 1)
                                                @if ($opdPenilaian->getRencanaAksiTriwulan())
                                                    <form action="{{ route('opdPenilaianKinerja.store') }}"
                                                        class="d-inline" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $opdPenilaian->id }}"
                                                            name="opd_penilaian_id" id="">
                                                        <input type="hidden" value="{{ $opd_category_variable->id }}"
                                                            name="opd_category_variable_id" id="">
                                                        <input type="hidden" value="100" name="target" id="">
                                                        <input type="hidden" name="rencana_aksi_id"
                                                            value="{{ $opdPenilaian->getRencanaAksiTriwulan()->id }}"
                                                            id="">
                                                        <button type="submit" class="badge bg-primary">TARIK RENCANA AKSI
                                                            {{ $opdPenilaian->name }}</button>
                                                    </form>
                                                @else
                                                    <br>
                                                    <small class="text-danger">Buat Rencana Aksi Terlebih Dahulu !</small>
                                                @endif
                                            @else
                                                {{-- @if (Auth::user()->hasRole('SUPERADMIN') && $opd_category_variable->opd_variable->pic != 'SIPD' && $checkStatus != 1)
                                                    <a type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $opd_category_variable->id }}">
                                                        {{ $opd_category_variable->opd_variable->pic }}
                                                    </a>
                                                @endif --}}
                                            @endif

                                            @include('opdPenilaian.modal')

                                            <small>
                                                @if ($opdPenilaian->getDate($opd_category_variable->id))
                                                    <br>
                                                    {{ $opdPenilaian->getDate($opd_category_variable->id) }}
                                                @endif
                                                @if ($opdPenilaian->getRencanaAksi($opd_category_variable->id)?->rencana_aksi_id)
                                                    <a target="_blank"
                                                        href="{{ route('rencanaAksi.show', $opdPenilaian->getRencanaAksi($opd_category_variable->id)->rencana_aksi_id) }}">
                                                        Detail Rencana Aksi
                                                    </a>
                                                @endif
                                            </small>
                                            @if ($opdPenilaian->capaian($opd_category_variable->id) != null)
                                                <br>
                                                <div class="badge bg-success">
                                                    Sudah
                                                </div>
                                            @else
                                                <br>
                                                <div class="badge bg-danger">
                                                    Belum
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $opd_category_variable->opd_variable->bobot }} %
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->target($opd_category_variable->id)[0] }}
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->realisasi($opd_category_variable->id) }}
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->capaian($opd_category_variable->id) }} %
                                        </td>
                                        <td>
                                            {{ $opdPenilaian->nilai_akhir($opd_category_variable->id) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center">Total</td>
                                    <td>{{ $opdPenilaian->opd_category->total_bobot }}</td>
                                    <td colspan="3" class="text-center">Total</td>
                                    <td>{{ $opdPenilaian->totalNilaiAkhir() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        Inovasi dan Prestasi Daerah
                                    </td>
                                    <td>{{ $opdPenilaian->inovasi_prestasi_daerah }}</td>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-center">Total Akhir</th>
                                    <th>{{ $opdPenilaian->totalAkhir() }}
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.7/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script>
        Highcharts.chart('test', {

            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: '40%'
            },

            title: {
                text: 'Predikat OPD'
            },

            pane: {
                startAngle: -90,
                endAngle: 89.9,
                background: null,
                center: ['50%', '75%'],
                size: '110%'
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 100,
                tickPixelInterval: 72,
                tickPosition: 'inside',
                tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                tickLength: 20,
                tickWidth: 2,
                minorTickInterval: null,
                labels: {
                    distance: 20,
                    style: {
                        fontSize: '14px'
                    }
                },
                plotBands: [{
                        from: 0,
                        to: 60,
                        color: '#FF0D0D', // green
                        thickness: 20
                    },
                    {
                        from: 60,
                        to: 70,
                        color: '#FF4E11', // green
                        thickness: 20
                    }, {
                        from: 70,
                        to: 80,
                        color: '#FF8E15', // yellow
                        thickness: 20
                    }, {
                        from: 80,
                        to: 90,
                        color: '#ACB334', // red
                        thickness: 20
                    }, {
                        from: 90,
                        to: 100,
                        color: '#69B34C', // red
                        thickness: 20
                    }
                ]
            },

            series: [{
                name: 'Predikat OPD',
                data: [{{ $opdPenilaian->totalAkhir() }}],
                tooltip: {
                    valueSuffix: '{{ $opdPenilaian->totalAkhirPredikat()['name'] }}'
                },
                dataLabels: {
                    format: '{y} {{ $opdPenilaian->totalAkhirPredikat()['name'] }}',
                    borderWidth: 0,
                    color: (
                        Highcharts.defaultOptions.title &&
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || '#333333',
                    style: {
                        fontSize: '16px'
                    }
                },
                dial: {
                    radius: '80%',
                    backgroundColor: 'gray',
                    baseWidth: 12,
                    baseLength: '0%',
                    rearLength: '0%'
                },
                pivot: {
                    backgroundColor: 'gray',
                    radius: 6
                }

            }]

        });
    </script>
    <script>
        $(".tarik-data").click(function() {
            Swal.fire({
                title: 'Loading',
                text: 'Sedang Mengambil Data',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            })
        });
    </script>
    <script>
        const inputElement = document.querySelector('input[id="filePendukung"]');
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: ['application/pdf'],
            allowFileTypeValidation: true,
            maxFileSize: '10MB'
        });
        FilePond.setOptions({
            server: {
                url: '{{ route('opdPerjanjianKinerja.store_file') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>
@endpush
