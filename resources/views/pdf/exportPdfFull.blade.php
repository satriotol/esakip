<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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

            table,
            td,
            th {
                border: 1px solid;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            * {
                font-family: times;
            }

            .w-100 {
                width: 100%;
            }
        </style>
    </head>
</head>

<body>
    <div class="text-center">
        <H4>HASIL EVALUASI KINERJA PERIODIK <br> ATAS PENCAPAIAN TARGET DAN REALISASI KINERJA PEJABAT PIMPINAN TINGGI PRATAMA
            <br> KOTA SEMARANG
        </H4>
    </div>
    <table>
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>JABATAN</td>
            <td>:</td>
            <td>{{ $opdPenilaian->opd_perjanjian_kinerja->opd_name }}</td>
        </tr>
        <tr>
            <td>SKALA PERIODIK</td>
            <td>:</td>
            <td>
                @if ($opdPenilaian->name == 'TRIWULAN 3')
                    <b>TRIWULAN III</b> (JULI, AGUSTUS, SEPTEMBER 2023)
                @elseif ($opdPenilaian->name == 'TRIWULAN 2')
                    <b>TRIWULAN II</b> (APRIL, MEI, JUNI 2023)
                @else
                    {{ $opdPenilaian->name }}
                @endif
            </td>
        </tr>
    </table>
    @foreach ($opdPenilaian->opd_category->opd_category_variables->sortBy('id') as $opd_category_variable)
        <h5>
            @if ($opd_category_variable->opd_variable->name === 'PROGRAM PENINGKATAN PENGGUNAAN PRODUK DALAM NEGERI')
                {{ str_replace('TRIWULAN', '', $opd_category_variable->opd_variable->name) }} (P3DN)
            @else
                {{ str_replace('TRIWULAN', '', $opd_category_variable->opd_variable->name) }}
            @endif
        </h5>
        @if ($opd_category_variable->opd_variable->is_iku_triwulan)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sasaran</th>
                        <th>Rencana Aksi</th>
                        <th>Indikator Kinerja</th>
                        <th>Target</th>
                        <th>Realisasi</th>
                        <th>Capaian (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($opdPenilaian->opd_perjanjian_kinerja->rencana_aksis->where('name', $opdPenilaian->name)->first()->rencana_aksi_targets->sortBy('opd_perjanjian_kinerja_sasaran_id') as $rencana_aksi_target)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <!-- Menampilkan nomor urut yang bertambah 1 setiap kali iterasi -->
                            <td>{{ $rencana_aksi_target->opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                            <td>{{ $rencana_aksi_target->rencana_aksi_note }}</td>
                            <td>{{ $rencana_aksi_target->indikator_kinerja_note }}</td>
                            <td>{{ $rencana_aksi_target->target }} {{ $rencana_aksi_target->satuan }}</td>
                            <td>{{ $rencana_aksi_target->realisasi }} {{ $rencana_aksi_target->satuan }}</td>
                            <td>{{ $rencana_aksi_target->capaian }} %</td>
                        </tr>
                        @php
                            $no++; // Increment nilai $no setiap kali iterasi
                        @endphp
                    @endforeach
                </tbody>
            </table>
        @else
            <table width="100%">
                <thead>
                    <tr>
                        <th>Target</th>
                        <th>Realisasi</th>
                        <th>Capaian</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $opdPenilaian->target($opd_category_variable->id)[0] }}</td>
                        <td>{{ $opdPenilaian->realisasi($opd_category_variable->id) }}</td>
                        <td> {{ $opdPenilaian->capaian($opd_category_variable->id) }} %</td>
                        <td>
                            @if ($opdPenilaian->capaian($opd_category_variable->id) < 100)
                                Tidak mencapai 100% karena ada efisiensi belanja, harga pasar lebih rendah dari SHS (
                                STANDAR HARGA SATUAN )
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    @endforeach
    <div style="margin-top: 30px">
        <table>
            <tr>
                <td>
                    <b>RATING HASIL KERJA</b> <br>
                    DI ATAS EKSPEKTASI
                </td>
            </tr>
            <tr>
                <td>
                    <b>RATING PERILAKU KERJA</b> <br>
                    DI ATAS EKSPEKTASI
                </td>
            </tr>
            <tr>
                <td>
                    <b>PREDIKAT KINERJA PEGAWAI</b> <br>
                    DI ATAS EKSPEKTASI
                </td>
            </tr>
        </table>
    </div>
    <div class="text-right" style="margin-top: 50px">
        <table>
            <tr>
                <td style="width: 60%"></td>
                <td>Semarang, </td>
            </tr>
            <tr>
                <td style="width: 60%"></td>
                <td class="text-center">PEJABAT PENILAI,</td>
            </tr>
            <tr>
                <td style="width: 60%"></td>
                <td class="text-center">WALIKOTA SEMARANG</td>
            </tr>
            <tr>
                <td style="width: 60%; height:100px"></td>
                <td class="text-center"></td>
            </tr>
            <tr>
                <td style="width: 60%"></td>
                <td class="text-center">Ir. Hj. Hevearita Gunaryanti Rahayu, M.Sos</td>
            </tr>
        </table>
    </div>
</body>

</html>
