<div class="modal fade bd-example-modal-lg" id="exampleModal{{ $opd_category_variable->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $opd_category_variable->opd_variable->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                @if ($opd_category_variable->opd_variable->is_iku)
                    <form action="{{ route('opdPenilaianIku.store') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table">
                                <thead>

                                    <th>Sasaran
                                        <br>
                                        Indikator
                                    </th>
                                    <th>Target</th>
                                    <th>Tipe</th>
                                    <th>Realisasi</th>
                                    <th>Capaian</th>
                                </thead>
                                <tbody>
                                    @foreach ($getOpdPerjanjianKinerjaIndikators as $getOpdPerjanjianKinerjaIndikator)
                                        <tr>
                                            <td>
                                                {{ $getOpdPerjanjianKinerjaIndikator->opd_perjanjian_kinerja_sasaran->sasaran }}
                                                <br>
                                                <small>
                                                    {{ $getOpdPerjanjianKinerjaIndikator->indikator }}
                                                </small>
                                            </td>
                                            <td>{{ $getOpdPerjanjianKinerjaIndikator->target }}
                                                {{ $getOpdPerjanjianKinerjaIndikator->satuan }}</td>
                                            <td>
                                                <select name="iku[{{ $loop->index }}][type]" class="form-control">
                                                    <option value="">Pilih Tipe</option>
                                                    @foreach ($ikuTypes as $ikuType)
                                                        <option value="{{ $ikuType }}"
                                                            @selected($opd_category_variable->getIkuType($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) == $ikuType)>{{ $ikuType }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number"
                                                    value="{{ $opd_category_variable->getIkuRealisasi($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}"
                                                    step="any" class="form-control" required
                                                    name="iku[{{ $loop->index }}][realisasi]" id="">
                                            </td>
                                            <td>
                                                {{ $opd_category_variable->getIkuCapaian($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}
                                            </td>
                                            <input type="hidden"
                                                name="iku[{{ $loop->index }}][opd_perjanjian_kinerja_indikator_id]"
                                                value="{{ $getOpdPerjanjianKinerjaIndikator->id }}" id="">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" value="{{ $opdPenilaian->id }}" name="opd_penilaian_id" id="">
                        <input type="hidden" value="{{ $opd_category_variable->id }}" name="opd_category_variable_id">
                        <div class="text-end">
                            <button class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                @elseif ($opd_category_variable->opd_variable->pic == 'SIPD')
                    <form action="{{ route('opdPenilaianKinerja.storeSipd') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $opdPenilaian->id }}" name="opd_penilaian_id" id="">
                        <input type="hidden" value="{{ $opdPenilaian->opd->id }}" name="opd_id" id="">
                        <input type="hidden" value="{{ $opd_category_variable->id }}" name="opd_category_variable_id"
                            id="">
                        <div class="mb-3">
                            <label>Tahap</label>
                            <select name="tahap" class="form-control" required id="">
                                <option value="">Pilih Tahap</option>
                                <option value="1">Murni</option>
                                <option value="2">Pergeseran</option>
                                <option value="3">Perubahan</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary me-2 mb-2 mb-md-0" name=""
                                onclick="this.disabled=true;this.value='Loading...';this.form.submit();" id=""
                                value="Simpan">
                        </div>
                    </form>
                @else
                    <form action="{{ route('opdPenilaianKinerja.store') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $opdPenilaian->id }}" name="opd_penilaian_id" id="">
                        <input type="hidden" value="{{ $opd_category_variable->id }}" name="opd_category_variable_id"
                            id="">
                        <div class="mb-3">
                            <label>Target</label>
                            <input type="number" step="any" class="form-control" name="target" required
                                id=""
                                @isset($opdPenilaian->target($opd_category_variable->id)[1])
                            readonly
                        @endisset
                                value="{{ $opdPenilaian->target($opd_category_variable->id)[0] }}">
                        </div>
                        <div class="mb-3">
                            <label>Realisasi</label>
                            <input type="number" step="any" class="form-control" name="realisasi" required
                                id="" value="{{ $opdPenilaian->realisasi($opd_category_variable->id) }}">
                        </div>
                        <small>
                            Tidak Perlu Menggunakan % <br>
                        </small>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
