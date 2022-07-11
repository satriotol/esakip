<div class="card-body">
    <div class="d-flex justify-content-between align-items-baseline">
        <h6 class="card-title mb-0">Total Anggaran</h6>
    </div>
    <div class="row">
        <div class="col-6 col-md-12 col-xl-5">
            <h3 class="mb-2">Rp {{ number_format($opdPerjanjianKinerja->total_anggaran,2 )}}</h3>
        </div>
    </div>
</div>
<div class="text-end">
    <a href="{{ route('opdPerjanjianKinerjaProgramAnggaran.create', [$opdPerjanjianKinerja]) }}"
        class="btn btn-sm btn-success ml-1">Tambah Program Anggaran</a>
</div>
<div class="table-responsive mt-2">
    <table id="dataTableExample" class="table dataTableExample">
        <thead>
            <tr>
                <th>Program</th>
                <th>Anggaran</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opdPerjanjianKinerja->opd_perjanjian_kinerja_program_anggarans as $opd_perjanjian_kinerja_program_anggaran)
                <tr>
                    <td>{{ $opd_perjanjian_kinerja_program_anggaran->program }}</td>
                    <td>{{ number_format($opd_perjanjian_kinerja_program_anggaran->anggaran) }}</td>
                    <td>{{ $opd_perjanjian_kinerja_program_anggaran->keterangan }}</td>
                    <td>
                        <a class="badge rounded-pill bg-warning text-dark"
                            href="{{ route('opdPerjanjianKinerjaProgramAnggaran.edit', [$opdPerjanjianKinerja, $opd_perjanjian_kinerja_program_anggaran->id]) }}">
                            Edit
                        </a>
                        <form
                            action="{{ route('opdPerjanjianKinerjaProgramAnggaran.destroy', $opd_perjanjian_kinerja_program_anggaran->id) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge rounded-pill bg-danger" style="border: 0"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
