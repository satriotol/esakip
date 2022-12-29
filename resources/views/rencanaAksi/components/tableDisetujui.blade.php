<table class="table">
    <thead>
        <th>Sasaran</th>
        <th>Rencana Aksi</th>
        <th>Indikator</th>
        <th>Target</th>
        <th>Realisasi</th>
        <th>Satuan</th>
        <th>Capaian</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <tr v-for="(data, index) in datas">
            <td>@{{ data.opd_perjanjian_kinerja_sasaran_name }}
            </td>
            <td>
                <textarea v-model='data.rencana_aksi_note' class="form-control" name="" id="" readonly></textarea>
            </td>
            <td>
                <textarea v-model='data.indikator_kinerja_note' readonly class="form-control" name="" id=""></textarea>
            </td>
            <td>
                <input type="number" readonly v-model='data.target' class="form-control" name="" id="">
            </td>
            <td>
                <input type="text" v-model='data.realisasi' class="form-control" name="" id=""
                    :readonly="data.rencana_aksi.status_penilaian">
            </td>
            <td>
                <input type="text" class="form-control" v-model='data.satuan' readonly name="" id="">
            </td>
            <td>
                @{{ data.capaian }}
            </td>
            <td>
                @if (!$rencanaAksi->status_penilaian)
                    <button class="badge bg-warning" @click='updateData(data.id, index)'>Update</button><br>
                @endif
            </td>
        </tr>
    </tbody>
    <tfoot>
        <th colspan="6">Total Capaian</th>
        <th>@{{ total_capaian }}</th>
    </tfoot>
</table>
{{-- @if (!$rencanaAksi->status_penilaian)
    <div class="text-end mt-2">
        <a href="{{ route('rencanaAksi.updateStatusSelesai', $rencanaAksi->id) }}" class="btn btn-success"
            onclick="return confirm('Apakah Anda Yakin?')">Selesai</a>
    </div>
@endif --}}
