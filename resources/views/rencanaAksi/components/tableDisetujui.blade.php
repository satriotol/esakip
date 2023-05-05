<table class="table">
    <thead>
        <th>Sasaran</th>
        <th>Rencana Aksi</th>
        <th>Indikator</th>
        <th>Target</th>
        <th>Tipe</th>
        <th>Realisasi <br> Data Dukung</th>
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
                    {{ $rencana_aksi_target->target }} {{ $rencana_aksi_target->satuan }}
                </td>
                <td>
                    {{ $rencana_aksi_target->type }}
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
                                'class' => 'form-control',
                                'placeholder' => 'Isi Realisasi',
                            ]) !!}
                            @if ($rencana_aksi_target->file)
                                <a href="{{ asset('uploads/' . $rencana_aksi_target->file) }}" target="_blank"
                                    class="badge bg-success">Buka File</a>
                            @endif
                            <div class="text-end">
                                @if (!$rencanaAksi->status_penilaian)
                                    <input class="btn btn-primary" type="submit" value="Update">
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
                <td>
                    {{ $rencana_aksi_target->capaian }}
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <th colspan="6">Total Capaian</th>
        <th>{{ $rencanaAksi->getTotalCapaian($rencanaAksi->id) }}</th>
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
