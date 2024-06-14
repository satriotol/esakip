<table>
    <thead>
        <tr>
            <th>Tahun</th>
            <th>Tipe</th>
            <th>OPD</th>
            <th>Sasaran</th>
            <th>Indikator</th>
            <th>Target</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($indicators as $indicator)
            <tr>
                <td>{{ $indicator->opd_perjanjian_kinerja_sasaran->opd_perjanjian_kinerja->year }}</td>
                <td>{{ $indicator->opd_perjanjian_kinerja_sasaran->opd_perjanjian_kinerja->type }}</td>
                <td>{{ $indicator->opd_perjanjian_kinerja_sasaran->opd_perjanjian_kinerja->opd->nama_opd }}</td>
                <td>{{ $indicator->opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                <td>{{ $indicator->indikator }}</td>
                <td>{{ $indicator->target }}</td>
                <td>{{ $indicator->satuan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
