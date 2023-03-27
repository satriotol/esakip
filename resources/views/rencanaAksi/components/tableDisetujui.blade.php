<table class="table">
    <thead>
        <th>Sasaran</th>
        <th>Rencana Aksi</th>
        <th>Indikator</th>
        <th>Target</th>
        <th>Realisasi</th>
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
                    <form action="{{ route('rencanaAksiTarget.update', $rencana_aksi_target->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        {!! Form::text('realisasi', $rencana_aksi_target->realisasi, [
                            'class' => 'form-control',
                            'placeholder' => 'Isi Realisasi',
                            'required',
                        ]) !!}
                        @if (!$rencanaAksi->status_penilaian)
                            <input class="btn btn-primary" type="submit" value="Update">
                        @endif
                    </form>
                </td>
                <td>
                    {{ $rencana_aksi_target->capaian }}
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <th colspan="6">Total Capaian</th>
        <th>{{ $rencanaAksi->getTotalCapaian($rencanaAksi->id) }}</th>
    </tfoot>
</table>
