@if ($rencanaAksi->status_penilaian != 'SELESAI')
    <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
        @csrf
        {!! Form::text('status', null, ['class' => 'd-none']) !!}
        <div class="text-end">
            {!! Form::submit('KEMBALI KE PENGISIAN TARGET', [
                'class' => 'btn btn-warning',
                'onclick' => "return confirm('Apakah Anda Yakin, Untuk Kembali Ke Pengisian Target?')",
            ]) !!}
        </div>
    </form>
    <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
        @csrf
        {!! Form::text('status_penilaian', 'SELESAI', ['class' => 'd-none']) !!}
        <div class="text-end">
            {!! Form::submit('SELESAIKAN REALISASI', [
                'class' => 'btn btn-success',
                'onclick' => "return confirm('Apakah Anda Yakin, Untuk Menyelesaikan Realisasi?')",
            ]) !!}
        </div>
    </form>
@else
    @if (Auth::user()->opd_id == null)
        <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
            @csrf
            {!! Form::text('status_penilaian', null, ['class' => 'd-none']) !!}
            <div class="text-end">
                {!! Form::submit('KEMBALI MENGISI REALISASI', [
                    'class' => 'btn btn-warning',
                    'onclick' => "return confirm('Apakah Anda Yakin, Untuk Kembali Ke Realisasi?')",
                ]) !!}
            </div>
        </form>
    @endif
@endif
<small class="text-danger">Nilai Capaian Akan Muncul Jika Sudah Diverifikasi Oleh Tim Verifikator</small>
<table class="table">
    <thead>
        <th width="15%">Sasaran</th>
        <th width="15%">Rencana Aksi</th>
        <th width="15%">Indikator</th>
        <th>Target <br> Tipe</th>
        <th>Realisasi <br> Data Dukung</th>
        <th>Status & Catatan Verifikator</th>
        <th>Capaian</th>
    </thead>
    <tbody>
        @foreach ($rencanaAksi->rencana_aksi_targets as $rencana_aksi_target)
            <tr>

                <td class="text-wrap">
                    {{ $rencana_aksi_target->opd_perjanjian_kinerja_sasaran_name }}
                </td>
                <td class="text-wrap">
                    {{ $rencana_aksi_target->rencana_aksi_note }}
                </td>
                <td class="text-wrap">
                    {{ $rencana_aksi_target->indikator_kinerja_note }}
                </td>
                <td>
                    {{ $rencana_aksi_target->target }} {{ $rencana_aksi_target->satuan }} <br>
                    <div @class([
                        'badge',
                        'bg-primary' => $rencana_aksi_target->type == 'UMUM',
                        'bg-warning' => $rencana_aksi_target->type == 'KHUSUS',
                    ])>
                        {{ $rencana_aksi_target->type }}
                    </div>
                </td>
                <td>
                    @if ($rencanaAksi->status_penilaian == null)
                        <form action="{{ route('rencanaAksiTarget.update', $rencana_aksi_target->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {!! Form::number('realisasi', $rencana_aksi_target->realisasi, [
                                'class' => 'form-control',
                                'placeholder' => 'Isi Realisasi',
                                'required',
                                'step' => 'any',
                            ]) !!}
                            {!! Form::file('file', [
                                'placeholder' => 'Isi Realisasi',
                                'id' => 'file',
                                'class' => 'upload-filepond',
                                'required' => isset($rencana_aksi_target->file) ? false : true,
                            ]) !!}
                            <div class="text-end">
                                @if ($rencana_aksi_target->file)
                                    <a href="{{ asset('uploads/' . $rencana_aksi_target->file) }}" target="_blank"
                                        class="btn btn-sm btn-info">Buka File</a>
                                @endif
                                @if (!$rencanaAksi->status_penilaian)
                                    <input class="btn btn-sm btn-success" type="submit" value="Update">
                                @endif
                            </div>
                        </form>
                    @else
                        {{ $rencana_aksi_target->realisasi }}
                        @if ($rencana_aksi_target->file)
                            <br>
                            <a href="{{ asset('uploads/' . $rencana_aksi_target->file) }}" target="_blank"
                                class="badge bg-success">Buka File</a>
                        @endif
                    @endif
                </td>
                <td class="text-wrap">
                    STATUS : <div @class([
                        'badge',
                        'bg-success' => $rencana_aksi_target->status_verifikator == 'DITERIMA',
                        'bg-danger' => $rencana_aksi_target->status_verifikator == 'DITOLAK',
                        'bg-info' => $rencana_aksi_target->status_verifikator == null,
                    ])>
                        {{ $rencana_aksi_target->status_verifikator ?? 'PENGAJUAN' }}
                    </div> <br>
                    <hr>
                    CATATAN : <br> {{ $rencana_aksi_target->note_verifikator }}
                </td>
                <td class="text-wrap">
                    {{ $rencana_aksi_target->capaian }} <br>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <th colspan="6">Total Capaian</th>
        <th>
            <h4>{{ $rencanaAksi->getTotalCapaian($rencanaAksi->id) }}</h4>
        </th>
    </tfoot>
</table>
@if ($rencanaAksi->status_penilaian != 'SELESAI')
    <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
        @csrf
        {!! Form::text('status', null, ['class' => 'd-none']) !!}
        <div class="text-end">
            {!! Form::submit('KEMBALI KE PENGISIAN TARGET', [
                'class' => 'btn btn-warning',
                'onclick' => "return confirm('Apakah Anda Yakin, Untuk Kembali Ke Pengisian Target?')",
            ]) !!}
        </div>
    </form>
    <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
        @csrf
        {!! Form::text('status_penilaian', 'SELESAI', ['class' => 'd-none']) !!}
        <div class="text-end">
            {!! Form::submit('SELESAIKAN REALISASI', [
                'class' => 'btn btn-success',
                'onclick' => "return confirm('Apakah Anda Yakin, Untuk Menyelesaikan Realisasi?')",
            ]) !!}
        </div>
    </form>
@else
    @if (Auth::user()->opd_id == null)
        <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
            @csrf
            {!! Form::text('status_penilaian', null, ['class' => 'd-none']) !!}
            <div class="text-end">
                {!! Form::submit('KEMBALI MENGISI REALISASI', [
                    'class' => 'btn btn-warning',
                    'onclick' => "return confirm('Apakah Anda Yakin, Untuk Kembali Ke Realisasi?')",
                ]) !!}
            </div>
        </form>
    @endif
@endif
