<div class="text-end">
    @if ($opdPerjanjianKinerja->status != 'DITERIMA')
        <a href="{{ route('opdPerjanjianKinerjaIndikator.createView', [$opdPerjanjianKinerja]) }}"
            class="btn btn-sm btn-info" style="margin-right: 1rem">Tambah Indikator Manual</a>
        <button type="submit" class="btn btn-sm btn-success ml-2" @click="opdPerjanjianKinerjaIndikator">Tarik
            Indikator</button>
    @endif
</div>
<div class="table-responsive mt-2">
    <table id="dataTableExample" class="table dataTableExample">
        <thead>
            <tr>
                <th>Sasaran</th>
                <th>Indikator</th>
                <th>Target</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opdPerjanjianKinerjaIndikators as $opd_perjanjian_kinerja_indikator)
                <tr>
                    <td>{{ $opd_perjanjian_kinerja_indikator->opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                    <td>{{ $opd_perjanjian_kinerja_indikator->indikator }} <br>
                        @if ($opd_perjanjian_kinerja_indikator->is_sakip)
                            <div class="badge bg-primary">Sakip</div>
                        @endif
                        @if ($opd_perjanjian_kinerja_indikator->is_iku)
                            <div class="badge bg-success">IKU</div>
                        @endif
                    </td>
                    <td>{{ $opd_perjanjian_kinerja_indikator->target }} {{ $opd_perjanjian_kinerja_indikator->satuan }}
                    </td>
                    <td>
                        @if ($opdPerjanjianKinerja->status != 'DITERIMA')
                            <form
                                action="{{ route('opdPerjanjianKinerjaIndikator.destroy', $opd_perjanjian_kinerja_indikator->id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('opdPerjanjianKinerjaIndikator.edit', [$opdPerjanjianKinerja->id, $opd_perjanjian_kinerja_indikator->id]) }}"
                                    class="badge rounded-pill bg-warning">Edit</a>
                                <button type="submit" class="badge rounded-pill bg-danger" style="border: 0"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
