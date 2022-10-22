<table>
    <thead>
        <tr>
            <th>OPD</th>
            <th>Tahun</th>
            <th>Anggaran</th>
            <th>Anggaran Perubahan</th>
            <th>Januari</th>
            <th>Februari</th>
            <th>Maret</th>
            <th>April</th>
            <th>Mei</th>
            <th>Juni</th>
            <th>Juli</th>
            <th>Agustus</th>
            <th>September</th>
            <th>Oktober</th>
            <th>November</th>
            <th>Desember</th>
            <th>Jumlah Realisasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($realisasiAnggarans as $realisasiAnggaran)
            <tr>
                <td>{{ $realisasiAnggaran['nama_skpd'] }}</td>
                <td>{{ $realisasiAnggaran['tahun'] }}</td>
                <td>{{ $realisasiAnggaran['anggaran'] }}</td>
                <td>{{ $realisasiAnggaran['perubahan'] }}</td>
                <td>{{ $realisasiAnggaran['januari'] }}</td>
                <td>{{ $realisasiAnggaran['februari'] }}</td>
                <td>{{ $realisasiAnggaran['maret'] }}</td>
                <td>{{ $realisasiAnggaran['april'] }}</td>
                <td>{{ $realisasiAnggaran['mei'] }}</td>
                <td>{{ $realisasiAnggaran['juni'] }}</td>
                <td>{{ $realisasiAnggaran['juli'] }}</td>
                <td>{{ $realisasiAnggaran['agustus'] }}</td>
                <td>{{ $realisasiAnggaran['september'] }}</td>
                <td>{{ $realisasiAnggaran['oktober'] }}</td>
                <td>{{ $realisasiAnggaran['november'] }}</td>
                <td>{{ $realisasiAnggaran['desember'] }}</td>
                <td>{{ $realisasiAnggaran['jml_realisasi'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
