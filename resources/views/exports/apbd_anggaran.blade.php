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
        @foreach ($ApbdAnggarans as $apbd)
            <tr>
                <td>{{ $apbd['tahun'] }}</td>
                <td>{{ $apbd['nama_skpd'] }}</td>
                <td data-format="0.00">{{ $apbd['anggaran'] }}</td>
                <td data-format="0.00">{{ $apbd['anggaran_pergeseran'] }}</td>
                <td data-format="0.00">{{ $apbd['anggaran_perubahan'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
