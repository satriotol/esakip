@can('rencanaAksi-create')
    @if (Auth::user()->opd_id == null)
        @if ($rencanaAksi->status_verifikator != 'SELESAI')
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
            <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
                @csrf
                {!! Form::text('status_verifikator', 'SELESAI', ['class' => 'd-none']) !!}
                <div class="text-end">
                    {!! Form::submit('SELESAI VERIFIKASI', [
                        'class' => 'btn btn-success',
                        'onclick' => "return confirm('Apakah Anda Yakin, Menyelesaikan Verifikasi?')",
                    ]) !!}
                </div>
            </form>
        @else
            <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
                @csrf
                {!! Form::text('status_verifikator', null, ['class' => 'd-none']) !!}
                <div class="text-end">
                    {!! Form::submit('KEMBALI VERIFIKASI', [
                        'class' => 'btn btn-warning',
                        'onclick' => "return confirm('Apakah Anda Yakin, Untuk Kembali Ke Verifikasi?')",
                    ]) !!}
                </div>
            </form>
        @endif
    @endif
@endcan
<table class="table table-bordered">
    <thead>
        <th>Detail</th>
        <th>Realisasi</th>
        <th>Catatan Verifikator</th>
    </thead>
    <tbody>
        @foreach ($rencanaAksi->rencana_aksi_targets as $rencana_aksi_target)
            <tr>
                <td>
                    <table class="table table-bordered text-wrap">
                        <tbody>
                            <tr>
                                <th>Sasaran</th>
                                <th>:</th>
                                <td class="text-wrap">{{ $rencana_aksi_target->opd_perjanjian_kinerja_sasaran_name }}
                                </td>
                            </tr>
                            <tr>
                                <th>Rencana Aksi</th>
                                <th>:</th>
                                <td class="text-wrap"> {{ $rencana_aksi_target->rencana_aksi_note }}</td>
                            </tr>
                            <tr>
                                <th>Indikator Rencana Aksi</th>
                                <th>:</th>
                                <td class="text-wrap"> {{ $rencana_aksi_target->indikator_kinerja_note }}</td>
                            </tr>
                            <tr>
                                <th>Tipe</th>
                                <th>:</th>
                                <td>
                                    <div @class([
                                        'badge',
                                        'bg-primary' => $rencana_aksi_target->type == 'UMUM',
                                        'bg-warning' => $rencana_aksi_target->type == 'KHUSUS',
                                    ])>
                                        {{ $rencana_aksi_target->type }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Target</th>
                                <th>:</th>
                                <td>
                                    <h4>
                                        {{ $rencana_aksi_target->target }} {{ $rencana_aksi_target->satuan }}
                                    </h4>
                                </td>
                            </tr>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <th>Realisasi</th>
                            <th>:</th>
                            <td>
                                <h4>{{ $rencana_aksi_target->realisasi }} {{ $rencana_aksi_target->satuan }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <th>Data Dukung</th>
                            <th>:</th>
                            <td><a href="{{ asset('uploads/' . $rencana_aksi_target->file) }}" target="_blank">Klik
                                    Disini</a></td>
                        </tr>
                        <tr>
                            <th>Capaian</th>
                            <th>:</th>
                            <th>
                                <h4>{{ $rencana_aksi_target->capaian }}</h4>
                            </th>
                        </tr>
                        <tr>
                            <th>Status Verifikasi</th>
                            <th>:</th>
                            <th>
                                <div @class([
                                    'badge',
                                    'bg-success' => $rencana_aksi_target->status_verifikator == 'DITERIMA',
                                    'bg-danger' => $rencana_aksi_target->status_verifikator == 'DITOLAK',
                                    'bg-info' => $rencana_aksi_target->status_verifikator == null,
                                ])>
                                    {{ $rencana_aksi_target->status_verifikator ?? 'PROSES' }}
                                </div>
                            </th>
                        </tr>
                    </table>
                </td>
                <td>
                    @if (Auth::user()->opd_id == null && $rencanaAksi->status_verifikator != 'SELESAI')
                        @can('rencanaAksi-create')
                            <form action="{{ route('rencanaAksiTarget.update', $rencana_aksi_target->id) }}"
                                method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    {!! Form::label('note_verifikator', 'Catatan Verifikator') !!}
                                    {!! Form::textarea('note_verifikator', $rencana_aksi_target->note_verifikator, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Masukkan Catatan Verifikator',
                                    ]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('status_verifikator', 'Status Verifikasi') !!}
                                    @php
                                        $statusVerifikators = [
                                            'DITERIMA' => 'DITERIMA',
                                            'DITOLAK' => 'DITOLAK',
                                        ];
                                    @endphp
                                    {!! Form::select('status_verifikator', $statusVerifikators, $rencana_aksi_target->status_verifikator, [
                                        'class' => 'form-select',
                                        'placeholder' => 'Pilih Status',
                                        'required',
                                    ]) !!}
                                </div>
                                <div class="text-end">
                                    {!! Form::submit('Simpan', ['class' => 'btn btn-success']) !!}
                                </div>
                            </form>
                        @endcan
                    @else
                        {{ $rencana_aksi_target->note_verifikator }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@can('rencanaAksi-create')

    @if (Auth::user()->opd_id == null)
        @if ($rencanaAksi->status_verifikator != 'SELESAI')
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
            <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
                @csrf
                {!! Form::text('status_verifikator', 'SELESAI', ['class' => 'd-none']) !!}
                <div class="text-end">
                    {!! Form::submit('SELESAI VERIFIKASI', [
                        'class' => 'btn btn-success',
                        'onclick' => "return confirm('Apakah Anda Yakin, Menyelesaikan Verifikasi?')",
                    ]) !!}
                </div>
            </form>
        @else
            <form action="{{ route('rencanaAksi.updateStatus', $rencanaAksi->id) }}" class="mt-2" method="post">
                @csrf
                {!! Form::text('status_verifikator', null, ['class' => 'd-none']) !!}
                <div class="text-end">
                    {!! Form::submit('KEMBALI VERIFIKASI', [
                        'class' => 'btn btn-warning',
                        'onclick' => "return confirm('Apakah Anda Yakin, Untuk Kembali Ke Verifikasi?')",
                    ]) !!}
                </div>
            </form>
        @endif
    @endif
@endcan
