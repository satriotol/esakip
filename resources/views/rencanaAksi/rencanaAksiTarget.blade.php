<div class="card-body">
    <div class="d-flex justify-content-between align-items-baseline">
        <h3 class="card-title mb-0">{{ $rencanaAksi->name }}</h3>
    </div>
</div>
<div class="table-responsive mt-2">
    <form action="{{ route('rencanaAksiTarget.store') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Sasaran</th>
                    <th>Realisasi</th>
                    <th>Target</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opdPerjanjianKinerja->opd_perjanjian_kinerja_sasarans as $key => $opd_perjanjian_kinerja_sasaran)
                    <tr>
                        <input type="text" value="{{ $opd_perjanjian_kinerja_sasaran->id }}" class="d-none"
                            name="realisasiAksiTarget[{{ $key }}][opd_perjanjian_kinerja_sasaran_id]"
                            id="">
                        <input class="d-none" type="text" value="{{ $rencanaAksi->id }}"
                            name="realisasiAksiTarget[{{ $key }}][rencana_aksi_id]" id="">
                        <td>
                            {{ $opd_perjanjian_kinerja_sasaran->sasaran }}
                        </td>
                        <td><select name="realisasiAksiTarget[{{ $key }}][realisasi]" class="form-control"
                                id="" required>
                                <option value="">Pilih Realisasi</option>
                                @foreach ($realisasis as $realisasi)
                                    <option value="{{ $realisasi }}" @selected($rencanaAksi->rencana_aksi_targets->where('opd_perjanjian_kinerja_sasaran_id', $opd_perjanjian_kinerja_sasaran->id)->first()?->realisasi == $realisasi)>
                                        {{ $realisasi }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>

                            <textarea name="realisasiAksiTarget[{{ $key }}][target]" required id="" class="form-control"
                                cols="30" rows="3" placeholder="Masukan Target Realisasi">{{ $rencanaAksi->rencana_aksi_targets->where('opd_perjanjian_kinerja_sasaran_id', $opd_perjanjian_kinerja_sasaran->id)->first()?->target }}</textarea>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </form>
</div>
