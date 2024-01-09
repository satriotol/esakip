<table>
    <thead>
        <tr>
            <th>OPD</th>
            <th>Tahun</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Tingkat</th>
            <th>Nama Prestasi</th>
            <th>Deskripsi Prestasi</th>
            <th>File</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inovasiPrestasiOpds as $inovasiPrestasiOpd)
            <tr>
                <td>{{ $inovasiPrestasiOpd->opd->nama_opd }}</td>
                <td>{{ $inovasiPrestasiOpd->year }}</td>
                <td>{{ $inovasiPrestasiOpd->getStatus()['name'] }}</td>
                <td>{{ $inovasiPrestasiOpd->date }}</td>
                <td>{{ $inovasiPrestasiOpd->inovasi_prestasi_tingkat->name }}</td>
                <td>{{ $inovasiPrestasiOpd->name }}</td>
                <td>{{ $inovasiPrestasiOpd->description }}</td>
                <td><a href="{{ asset('uploads/' . $inovasiPrestasiOpd->file) }}">Buka File</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
