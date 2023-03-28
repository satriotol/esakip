<table class="table">
    <thead>
        <th>Sasaran</th>
        <th>Rencana Aksi</th>
        <th>Indikator</th>
        <th>Target</th>
        <th>Satuan</th>
        <th>Tipe</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <tr v-for="(data, index) in datas">
            <td class="text-wrap">@{{ data.opd_perjanjian_kinerja_sasaran_name }}
            </td>
            <td>
                <textarea v-model='data.rencana_aksi_note' class="form-control" name="" id=""></textarea>
            </td>
            <td>
                <textarea v-model='data.indikator_kinerja_note' class="form-control" name="" id=""></textarea>
            </td>
            <td>
                <input type="number" step="any" v-model='data.target' class="form-control" name=""
                    id="">
            </td>
            <td>
                <input type="text" class="form-control" v-model='data.satuan' name="" id="">
            </td>
            <td>
                @{{ data.type }}
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
<form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
    @csrf
    {!! Form::text('status', 'DISETUJUI', ['class' => 'd-none']) !!}
    <div class="text-end">

        {!! Form::submit('Lanjut Membuat Realisasi', ['class' => 'btn btn-success']) !!}
    </div>
</form>
