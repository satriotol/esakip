<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Penilaian</title>
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
    <h3 class="text-center">DETAIL PENILAIAN OPD <br> {{ $opdPenilaian->opd->nama_opd }}</h3>
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
                <h4>TARGET</h4>
            </th>
            <th class="th">
                <h4>REALISASI</h4>
            </th>
            <th class="th">
                <h4>CAPAIAN</h4>
            </th>
            <th class="th">
                <h4>NILAI AKHIR</h4>
            </th>
        </thead>
        <tbody>
            @foreach ($opdPenilaian->opd_category->opd_category_variables as $opd_category_variable)
                <tr>
                    <td class="td">
                        {{ $opd_category_variable->opd_variable->name }}
                    </td>
                    <td class="td">
                        {{ $opdPenilaian->target($opd_category_variable->id)[0] }}
                    </td>
                    <td class="td">
                        {{ $opdPenilaian->realisasi($opd_category_variable->id) }}
                    </td>
                    <td class="td text-right">
                        {{ $opdPenilaian->capaian($opd_category_variable->id) }}
                    </td>
                    <td class="td text-right">
                        {{ $opdPenilaian->nilai_akhir($opd_category_variable->id) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="td text-center" colspan="4">INOVASI PRESTASI OPD</td>
                <td class="td text-right">{{ $opdPenilaian->inovasi_prestasi_daerah }}</td>
            </tr>
            <tr>
                <th class="th text-center" colspan="4">Total Nilai Akhir</th>
                <td class="td text-right">{{ $opdPenilaian->totalAkhir() }} <br>
                    {{ $opdPenilaian->totalAkhirPredikat()['name'] }}</td>
            </tr>
        </tbody>
    </table>
    <div class="text-right">
        <small>
            Batas Maksimal Nilai Akhir : 100
        </small>
    </div>
    <div id="footer">
        Tanggal cetak: {{ date('Y-m-d H:i:s') }}
    </div>
</body>

</html>
