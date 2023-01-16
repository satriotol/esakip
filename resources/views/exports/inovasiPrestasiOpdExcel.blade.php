<table>
    <thead>
        <tr>
            <th>OPD</th>
            <th>Tahun</th>
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
                <td width="100%">{{ $inovasiPrestasiOpd->opd->nama_opd }}</td>
                <td width="100%">{{ $inovasiPrestasiOpd->year }}</td>
                <td width="100%">{{ $inovasiPrestasiOpd->date }}</td>
                <td width="100%">{{ $inovasiPrestasiOpd->inovasi_prestasi_tingkat->name }}</td>
                <td width="100%">{{ $inovasiPrestasiOpd->name }}</td>
                <td width="100%">{{ $inovasiPrestasiOpd->description }}</td>
                <td width="100%"><a href="{{ asset('uploads/' . $inovasiPrestasiOpd->file) }}">Buka File</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
