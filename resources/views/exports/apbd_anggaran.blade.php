<table>
    <thead>
        <tr>
            <th>Tahun</th>
            <th>OPD</th>
            <th>Anggaran</th>
            <th>Anggaran Pergeseran</th>
            <th>Anggaran Perubahan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ApbdAnggarans as $ApbdAnggaran)
            <tr>
                <td>{{ $ApbdAnggaran->tahun }}</td>
                <td>{{ $ApbdAnggaran->nama_skpd }}</td>
                <td>{{ $ApbdAnggaran->anggaran }}</td>
                <td>{{ $ApbdAnggaran->anggaran_pergeseran }}</td>
                <td>{{ $ApbdAnggaran->anggaran_perubahan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
