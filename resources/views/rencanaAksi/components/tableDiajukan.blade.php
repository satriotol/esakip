<form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
    @csrf
    {!! Form::text('status', 'PROSES', ['class' => 'd-none']) !!}
    <div class="text-end">
        {!! Form::submit('Ajukan Rencana Aksi Target', [
            'class' => 'btn btn-success',
            'onclick' => "return confirm('Apakah Anda Yakin, Untuk Melanjutkan Ke Realisasi?')",
        ]) !!}
    </div>
</form>
<table class="table table-bordered">
    <thead>
        <th>Sasaran</th>
        <th>Rencana Aksi</th>
        <th>Indikator</th>
        <th>Target</th>
        <th>Satuan</th>
        <th>Tipe</th>
        <th>Verifikator</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <tr v-for="(data, index) in datas">
            <td class="text-wrap" style="width: 25%">@{{ data.opd_perjanjian_kinerja_sasaran_name }}
            </td>
            <td>
                <textarea v-model='data.rencana_aksi_note' class="form-control" style="width: 100%" name="" id=""></textarea>
            </td>
            <td>
                <textarea v-model='data.indikator_kinerja_note' class="form-control" name="" id=""></textarea>
            </td>
            <td>
                <input type="number" step="any" min="0" v-model='data.target' class="form-control"
                    name="" id="">
            </td>
            <td>
                <input type="text" class="form-control" v-model='data.satuan' name="" id="">
            </td>
            <td>
                @{{ data.type }}
            </td>
            <td class="text-wrap">
                <p>
                    @{{ data.note_verifikator }}
                </p>
                <div
                    :class="[
                        'badge',
                        { 'bg-success': data.status_rencana_aksi === 'DITERIMA' },
                        { 'bg-danger': data.status_rencana_aksi === 'DITOLAK' }
                    ]">
                    @{{ data.status_rencana_aksi }}</div>
            </td>
            <td>
                @if (!$rencanaAksi->status_penilaian)
                    <button class="btn btn-sm btn-warning" @click='updateData(data.id, index)'>PERBARUI</button><br>
                    <button class="btn btn-sm btn-danger" v-if="data.rencana_aksi.status != 'DISETUJUI'"
                        @click='deleteData(data.id)'>HAPUS</button>
                @endif
            </td>
        </tr>
    </tbody>
</table>
<form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
    @csrf
    {!! Form::text('status', 'PROSES', ['class' => 'd-none']) !!}
    <div class="text-end">
        {!! Form::submit('Ajukan Rencana Aksi Target', [
            'class' => 'btn btn-success',
            'onclick' => "return confirm('Apakah Anda Yakin, Untuk Melanjutkan Ke Realisasi?')",
        ]) !!}
    </div>
</form>
