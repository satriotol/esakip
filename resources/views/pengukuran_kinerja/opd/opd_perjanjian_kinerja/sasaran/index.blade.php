<div class="text-end">
    @if ($opdPerjanjianKinerja->status != 'DITERIMA')
        <a href="{{ route('opdPerjanjianKinerjaSasaran.create', $opdPerjanjianKinerja->id) }}" class="btn btn-sm btn-info"
            style="margin-right: 1rem">Tambah Sasaran Manual</a>
        <button type="submit" class="btn btn-sm btn-success ml-1" @click="opdPerjanjianKinerjaSasaran">Tarik
            Sasaran</button>
    @endif
</div>
<div class="table-responsive mt-2">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sasaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opdPerjanjianKinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                <tr>
                    <td>{{ $opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                    <td>
                        @if ($opdPerjanjianKinerja->status != 'DITERIMA')
                            <a class="badge rounded-pill bg-warning text-dark"
                                href="{{ route('opdPerjanjianKinerjaSasaran.edit', [$opdPerjanjianKinerja->id, $opd_perjanjian_kinerja_sasaran->id]) }}">
                                Edit
                            </a>
                            <form
                                action="{{ route('opdPerjanjianKinerjaSasaran.destroy', $opd_perjanjian_kinerja_sasaran->id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
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
