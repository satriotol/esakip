@if (!Auth::user()->opd_id)
    <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
        @csrf
        {!! Form::text('status', 'DIAJUKAN', ['class' => 'd-none']) !!}
        <div class="text-end">
            {!! Form::submit('Kembalikan Ke OPD', [
                'class' => 'btn btn-warning',
                'onclick' => "return confirm('Apakah Anda Yakin, Untuk Mengembalikan Ke OPD?')",
            ]) !!}
        </div>
    </form>
    <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
        @csrf
        {!! Form::text('status', 'DISETUJUI', ['class' => 'd-none']) !!}
        <div class="text-end">
            {!! Form::submit('Terima Rencana Aksi Target', [
                'class' => 'btn btn-success',
                'onclick' => "return confirm('Apakah Anda Yakin, Untuk Melanjutkan Ke Realisasi?')",
            ]) !!}
        </div>
    </form>
@endif
<h5 class="text-danger">Pada Proses Ini Rencana Aksi Target Anda Sedang Kami Evaluasi</h5>
<table class="table">
    <thead>
        <th>Sasaran</th>
        <th>Rencana Aksi</th>
        <th>Indikator</th>
        <th>Target</th>
        <th>Catatan Verifikator</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <tr v-for="(data, index) in datas">
            <td class="text-wrap">@{{ data.opd_perjanjian_kinerja_sasaran_name }}
            </td>
            <td class="text-wrap">
                @{{ data.rencana_aksi_note }}
            </td>
            <td class="text-wrap">
                @{{ data.indikator_kinerja_note }}
            </td>
            <td>
                @{{ data.target }} @{{ data.satuan }} <br>
                @{{ data.type }}
            </td>
            <td>
                @if (Auth::user()->opd_id)
                    @{{ data.note_verifikator }} <br>
                    <div
                        :class="[
                            'badge',
                            { 'bg-success': data.status_rencana_aksi === 'DITERIMA' },
                            { 'bg-danger': data.status_rencana_aksi === 'DITOLAK' }
                        ]">
                        @{{ data.status_rencana_aksi }}</div>
                @else
                    <div class="form-group">
                        {!! Form::label('note_verifikator', 'Catatan Verifikator') !!}
                        {!! Form::textarea('note_verifikator', '', [
                            'v-model' => 'data.note_verifikator',
                            'class' => 'form-control',
                            'placeholder' => 'Masukkan Catatan Verifikator',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('status_rencana_aksi', 'Status Rencana Aksi', ['class' => 'form-label']) !!}
                        {!! Form::select(
                            'status_rencana_aksi',
                            [
                                'DITERIMA' => 'DITERIMA',
                                'DITOLAK' => 'DITOLAK',
                            ],
                            '',
                            [
                                'v-model' => 'data.status_rencana_aksi',
                                'required',
                                'class' => 'form-select',
                            ],
                        ) !!}
                    </div>
                @endif
            </td>
            <td>
                @if (!$rencanaAksi->status_penilaian && !Auth::user()->opd_id)
                    <button class="btn btn-sm btn-primary" @click='updateData(data.id, index)'>PERBARUI</button><br>
                @endif
            </td>
        </tr>
    </tbody>
</table>
@if (!Auth::user()->opd_id)
    <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
        @csrf
        {!! Form::text('status', 'DIAJUKAN', ['class' => 'd-none']) !!}
        <div class="text-end">
            {!! Form::submit('Kembalikan Ke OPD', [
                'class' => 'btn btn-warning',
                'onclick' => "return confirm('Apakah Anda Yakin, Untuk Mengembalikan Ke OPD?')",
            ]) !!}
        </div>
    </form>
    <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
        @csrf
        {!! Form::text('status', 'DISETUJUI', ['class' => 'd-none']) !!}
        <div class="text-end">
            {!! Form::submit('Terima Rencana Aksi Target', [
                'class' => 'btn btn-success',
                'onclick' => "return confirm('Apakah Anda Yakin, Untuk Melanjutkan Ke Realisasi?')",
            ]) !!}
        </div>
    </form>
@endif
