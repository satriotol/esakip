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

        .table {
            border-collapse: collapse;
        }

        .w-100 {
            width: 100%;
        }
    </style>
</head>

<body>
    <h3 class="text-center">BERITA ACARA PELAKSANAAN DESK TIMBAL BALIK PEMERINTAH KOTA SEMARANG</h3>
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
            <td>{{ $opdPenilaian->inovasi_prestasi_opd->name }}</td>
        </tr>
    </table>

    <table style="margin-top: 1rem" class="table w-100">
        <thead>
            <th class="th">ASPEK</th>
            <th class="th">CATATAN</th>
            <th class="th">REKOMENDASI</th>
            <th class="th">NILAI AKHIR</th>
        </thead>
        <tbody>
            @foreach ($opdPenilaian->opd_penilaian_kinerjas as $opd_penilaian_kinerja)
                <tr>
                    <td class="td">{{ $opd_penilaian_kinerja->opd_category_variable->opd_variable->name }}
                    </td>
                    <td class="td">{{ $opd_penilaian_kinerja->opd_penilaian_report->catatan }}</td>
                    <td class="td">{{ $opd_penilaian_kinerja->opd_penilaian_report->rekomendasi }}</td>
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
</body>

</html>
