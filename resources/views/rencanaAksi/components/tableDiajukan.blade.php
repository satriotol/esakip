<table class="table">
    <thead>
        <th>Sasaran</th>
        <th>Rencana Aksi</th>
        <th>Indikator</th>
        <th>Target</th>
        <th>Satuan</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <tr v-for="(data, index) in datas">
            <td>@{{ data.opd_perjanjian_kinerja_sasaran_name }}
            </td>
            <td>
                <textarea v-model='data.rencana_aksi_note' class="form-control" name="" id=""></textarea>
            </td>
            <td>
                <textarea v-model='data.indikator_kinerja_note' class="form-control" name="" id=""></textarea>
            </td>
            <td>
                <input type="number" v-model='data.target' class="form-control" name="" id="">
            </td>
            <td>
                <input type="text" class="form-control" v-model='data.satuan' name="" id="">
            </td>
            <td>
                @if (!$rencanaAksi->status_penilaian)
                    <button class="badge bg-warning" @click='updateData(data.id, index)'>Update</button><br>
                    <button class="badge bg-danger" v-if="data.rencana_aksi.status != 'DISETUJUI'"
                        @click='deleteData(data.id)'>Delete</button>
                @endif
            </td>
        </tr>
    </tbody>
</table>