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
                    <img src="https://sigelar.diskominfo.semarangkota.go.id/uploads/drive/20200818141926-2020-08-18drive141924.jpg"
                        alt="" width="74" height="105" class="text-center" />
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
            <td>{{ $opdPenilaian->year }}</td>
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
