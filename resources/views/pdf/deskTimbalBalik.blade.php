<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .table,
        .td,
        .th {
            border: 1px solid;
        }

        table tbody tr td,
        table thead tr th {
            border-collapse: collapse;

        }

        table thead tr th {
            background: #858585;
            color: #fff;
        }

        * {
            font-family: times;
        }

        .w-100 {
            width: 100%;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tbody>
            <tr>
                <td class="text-center">
                    <img src="data:image/png;base64,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"
                        alt="" height="105" class="text-center" />
                </td>
                <td class="text-center">
                    <h3 style="font-size:21.333px;font-family: Arial;">
                        <strong style="font-family: Arial;">PEMERINTAH KOTA SEMARANG</strong> <br>
                        <span style="font-size:24px;font-family: Arial;">{{ $opdPenilaian->opd->nama_opd }}</span> <br>
                        <span style="font-size:16px;font-weight:400;font-family: Arial;">
                            Jl. Pemuda No. 148 Telp. (024) 3586680 Fax. (024) 3584064 Semarang - 50132
                        </span>
                    </h3>
                </td>
            </tr>

        </tbody>
    </table>
    <hr style="border-top: 1px double #8c8b8b;" />
    <h3 class="text-center">BERITA ACARA PELAKSANAAN DESK TIMBAL BALIK <br> {{ $opdPenilaian->opd->nama_opd }}</h3>
    <table>
        <tr>
            <td>OPD</td>
            <td>:</td>
            <td>{{ $opdPenilaian->opd->nama_opd }}</td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td>{{ $opdPenilaian->year }} {{ $opdPenilaian->name }}</td>
        </tr>
        <tr>
            <td>Inovasi Prestasi OPD</td>
            <td>:</td>
            <td>{{ $opdPenilaian->inovasi_prestasi_opd->name ?? '-' }}</td>
        </tr>
    </table>

    <table style="margin-top: 1rem" class="table w-100">
        <thead>
            <th class="th">
                <h4>ASPEK</h4>
            </th>
            <th class="th">
                <h4>CATATAN</h4>
            </th>
            <th class="th">
                <h4>REKOMENDASI</h4>
            </th>
            <th class="th">
                <h4>NILAI AKHIR</h4>
            </th>
        </thead>
        <tbody>
            @foreach ($opdPenilaian->opd_penilaian_kinerjas as $opd_penilaian_kinerja)
                <tr>
                    <td class="td">{{ $opd_penilaian_kinerja->opd_category_variable->opd_variable->name }}
                    </td>
                    <td class="td">{{ $opd_penilaian_kinerja->opd_penilaian_report->catatan ?? '-' }}</td>
                    <td class="td">{{ $opd_penilaian_kinerja->opd_penilaian_report->rekomendasi ?? '-' }}</td>
                    <td class="td text-right">{{ $opd_penilaian_kinerja->nilai_akhir }} %</td>
                </tr>
            @endforeach
            <tr>
                <td class="td text-center" colspan="3">INOVASI PRESTASI OPD</td>
                <td class="td text-right">{{ $opdPenilaian->inovasi_prestasi_daerah }} %</td>
            </tr>
            <tr>
                <th class="th text-center" colspan="3">Total Nilai Akhir</th>
                <td class="td text-right">{{ $opdPenilaian->totalAkhir() }} % <br>
                    {{ $opdPenilaian->totalAkhirPredikat()['name'] }}</td>
            </tr>
        </tbody>
    </table>
    <div class="text-right">
        <small>
            Batas Maksimal Nilai Akhir : 100%
        </small>
    </div>
</body>

</html>
