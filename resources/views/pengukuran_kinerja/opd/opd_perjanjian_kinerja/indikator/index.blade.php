<div class="text-end">
    {{-- <a href="{{ route('opdPerjanjianKinerjaIndikator.create', [$opdPerjanjianKinerja]) }}"
        class="btn btn-sm btn-success ml-1">Tarik Indikator</a> --}}
    <button type="submit" class="btn btn-sm btn-success ml-1" @click="opdPerjanjianKinerjaIndikator">Tarik
        Indikator</button>
</div>
<div class="table-responsive mt-2">
    <table id="dataTableExample" class="table dataTableExample">
        <thead>
            <tr>
                <th>Sasaran</th>
                <th>Indikator</th>
                <th>Target</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opdPerjanjianKinerjaIndikators as $opd_perjanjian_kinerja_indikator)
                <tr>
                    <td>{{ $opd_perjanjian_kinerja_indikator->opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                    <td>{{ $opd_perjanjian_kinerja_indikator->indikator }}</td>
                    <td>{{ $opd_perjanjian_kinerja_indikator->target }} {{ $opd_perjanjian_kinerja_indikator->satuan }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
