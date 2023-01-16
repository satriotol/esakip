<table>
    <thead>
        <tr>
            <th>Tahun</th>
            <th>OPD</th>
            <th>Kategori</th>
            <th>Total Nilai</th>
            <th>Predikat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($opdPenilaians as $opdPenilaian)
            <tr>
                <td>{{ $opdPenilaian->year }}</td>
                <td>{{ $opdPenilaian->opd->nama_opd }}</td>
                <td>{{ $opdPenilaian->opd_category->name }}</td>
                <td>{{ $opdPenilaian->totalAkhir() }}</td>
                <td>{{ $opdPenilaian->totalAkhirPredikat()['name'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
