<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Aspek</th>
            <th>Target</th>
            <th>Realisasi</th>
            <th>Nilai Akhir</th>
            <th>Capaian</th>
            <th>Catatan</th>
            <th>Rekomendasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($opdPenilaian->opd_category->opd_category_variables as $opd_category_variable)
            <tr>
                <td>
                    {{ $opd_category_variable->opd_variable->name }}
                    <small>{{ $opdPenilaian->getDate($opd_category_variable->id) }}</small>
                </td>
                <td>
                    {{ $opdPenilaian->target($opd_category_variable->id)[0] }}
                </td>
                <td>
                    {{ $opdPenilaian->realisasi($opd_category_variable->id) }}
                </td>
                <td>
                    {{ $opdPenilaian->capaian($opd_category_variable->id) }} %
                </td>
                <td>
                    {{ $opdPenilaian->nilai_akhir($opd_category_variable->id) }}
                </td>
                <td>
                    <textarea @disabled(Auth::user()->opd_id || $opdPenilaian->status == 'SELESAI') placeholder="Masukan Catatan..." name="data[{{ $loop->index }}][catatan]"
                        class="form-control" id="" cols="30" rows="5">{{ $opdPenilaian->getOpdPenilaianReportValue($opd_category_variable->id)->catatan ?? '' }}</textarea>
                </td>
                <td>
                    <textarea @disabled(Auth::user()->opd_id || $opdPenilaian->status == 'SELESAI') placeholder="Masukan Rekomendasi..."
                        name="data[{{ $loop->index }}][rekomendasi]" class="form-control" id="" cols="30" rows="5">{{ $opdPenilaian->getOpdPenilaianReportValue($opd_category_variable->id)->rekomendasi ?? '' }}</textarea>
                    <input type="text" hidden
                        value="{{ $opd_category_variable->getOpdPenilaian($opdPenilaian->id)->id ?? '' }}"
                        name="data[{{ $loop->index }}][opd_penilaian_kinerja]" id="">
                    <input type="text" hidden value="{{ $opdPenilaian->id }}"
                        name="opdPenilaian" id="">
                </td>

            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-center" colspan="4">Total</td>
            <td>{{ $opdPenilaian->totalNilaiAkhir() }}</td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
</table>