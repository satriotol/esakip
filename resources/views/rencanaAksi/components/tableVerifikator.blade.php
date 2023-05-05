<table class="table">
    <thead>
        <th>Detail</th>
        <th>Realisasi</th>
        <th>Catatan Verifikator</th>
    </thead>
    <tbody>
        @foreach ($rencanaAksi->rencana_aksi_targets as $rencana_aksi_target)
            <tr>
                <td>
                    <table>
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
                                <th>Indikator Kinerja</th>
                                <th>:</th>
                                <td class="text-wrap"> {{ $rencana_aksi_target->indikator_kinerja_note }}</td>
                            </tr>
                            <tr>
                                <th>Tipe</th>
                                <th>:</th>
                                <td>{{ $rencana_aksi_target->type }}</td>
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
                            <td> <a href="{{ asset('uploads/' . $rencana_aksi_target->file) }}" target="_blank"
                                    class="btn btn-sm btn-success">Buka File</a></td>
                        </tr>
                        <tr>
                            <th>Capaian</th>
                            <th>:</th>
                            <th>
                                <h4>{{ $rencana_aksi_target->capaian }}</h4>
                            </th>
                        </tr>
                    </table>
                </td>
                <td>
                    <form action="{{ route('rencanaAksiTarget.update', $rencana_aksi_target->id) }}" method="post">
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
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
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
