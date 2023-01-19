<div class="card-body">
    <div class="d-flex justify-content-between align-items-baseline">
        <h6 class="card-title mb-0">Total Anggaran</h6>
    </div>
    <div class="row">
        <div class="col-6 col-md-12 col-xl-5">
            <h3 class="mb-2">Rp {{ number_format($opdPerjanjianKinerja->total_anggaran, 2) }}</h3>
        </div>
    </div>
</div>
<div class="text-end">
    @if ($opdPerjanjianKinerja->status != 'DITERIMA')
        <button type="submit" class="btn btn-sm btn-success ml-1" @click="opdPerjanjianKinerjaProgramAnggaran">Tarik
            Program
            Anggaran</button>
    @endif
</div>
<div class="table-responsive mt-2">
    <table id="dataTableExample" class="table dataTableExample">
        <thead>
            <tr>
                <th>Program</th>
                <th>Anggaran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opdPerjanjianKinerja->opd_perjanjian_kinerja_program_anggarans as $opd_perjanjian_kinerja_program_anggaran)
                <tr>
                    <td class="text-wrap">{{ $opd_perjanjian_kinerja_program_anggaran->program }}</td>
                    <td style="text-align: right">Rp.
                        {{ number_format($opd_perjanjian_kinerja_program_anggaran->anggaran) }}
                    </td>
                    <td>{{ $opd_perjanjian_kinerja_program_anggaran->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
