@push('plugin-styles')
@endpush
<div class="modal fade bd-example-modal-lg" id="exampleModal{{ $opd_category_variable->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 80%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $opd_category_variable->opd_variable->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                @if ($opd_category_variable->opd_variable->is_iku)
                    <form action="{{ route('opdPenilaianIku.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <th>Realisasi <br> Data Dukung</th>
                                    <th>Capaian</th>
                                    <th>Status</th>
                                    <th>Catatan Verifikator</th>
                                </thead>
                                <tbody>
                                    @foreach ($getOpdPerjanjianKinerjaIndikators as $getOpdPerjanjianKinerjaIndikator)
                                        <tr>
                                            <td class="text-wrap">
                                                {{ $getOpdPerjanjianKinerjaIndikator->opd_perjanjian_kinerja_sasaran->sasaran }}
                                                <br>
                                                <small>
                                                    {{ $getOpdPerjanjianKinerjaIndikator->indikator }}
                                                </small>
                                            </td>
                                            <td>{{ $getOpdPerjanjianKinerjaIndikator->target }}
                                                {{ $getOpdPerjanjianKinerjaIndikator->satuan }}</td>
                                            <td>
                                                @if ($getOpdPerjanjianKinerjaIndikator->is_sakip)
                                                    <input type="text" readonly name="iku[{{ $loop->index }}][type]"
                                                        id="" value="UMUM">
                                                @else
                                                    <select name="iku[{{ $loop->index }}][type]" class="form-control"
                                                        @readonly($opd_category_variable->getIkuIsVerified($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id))>
                                                        <option value="">Pilih Tipe Penilaian</option>
                                                        @foreach ($ikuTypes as $ikuType)
                                                            <option value="{{ $ikuType }}"
                                                                @selected($opd_category_variable->getIkuType($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) == $ikuType)>{{ $ikuType }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($getOpdPerjanjianKinerjaIndikator->is_sakip)
                                                    <input type="number" readonly
                                                        value="{{ $opdPenilaian->getEvaluasiKinerja($opdPenilaian->year, $opdPenilaian->opd_id)->value }}"
                                                        step="any" required
                                                        name="iku[{{ $loop->index }}][realisasi]" id="">
                                                @else
                                                    <input type="number" class="form-control"
                                                        placeholder="Masukan Realisasi Organisasi Anda"
                                                        @readonly($opd_category_variable->getIkuIsVerified($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id))
                                                        value="{{ $opd_category_variable->getIkuRealisasi($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}"
                                                        step="any" required
                                                        name="iku[{{ $loop->index }}][realisasi]" id="">
                                                @endif
                                                @if ($opd_category_variable->getIkuIsVerified($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) != 1)
                                                    <input type="file" id="file" class="form-control"
                                                        name="iku[{{ $loop->index }}][file]" />
                                                @endif
                                                @if ($opd_category_variable->getIkuFile($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) != null)
                                                    <a href="{{ asset('uploads/' . $opd_category_variable->getIkuFile($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id)) }}"
                                                        target="_blank">Buka
                                                        File</a>
                                                @endisset

                                        </td>
                                        <td>
                                            {{ $opd_category_variable->getIkuCapaian($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}
                                            %
                                        </td>
                                        <td>
                                            @if (Auth::user()->opd_id)
                                                <select disabled class="form-control">
                                                    <option value="">Pilih Status</option>
                                                    <option value="1" @selected($opd_category_variable->getIkuIsVerified($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) == 1)>Terima
                                                    </option>
                                                </select>
                                                <input class="d-none" type="text"
                                                    name="iku[{{ $loop->index }}][is_verified]"
                                                    value="{{ $opd_category_variable->getIkuIsVerified($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}"
                                                    name="" id="">
                                            @else
                                                <select name="iku[{{ $loop->index }}][is_verified]"
                                                    class="form-control">
                                                    <option value="">Pilih Status</option>
                                                    <option value="1" @selected($opd_category_variable->getIkuIsVerified($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) == 1)>Terima
                                                    </option>
                                                </select>
                                            @endif
                                        </td>
                                        <td>
                                            <textarea @readonly(Auth::user()->opd_id) name="iku[{{ $loop->index }}][note]" id="" cols="20" rows="5"
                                                class="form-control">{{ $opd_category_variable->getIkuNote($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}</textarea>
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
            @elseif ($opd_category_variable->opd_variable->pic != 'SIPD' && $opd_category_variable->opd_variable->is_iku_triwulan != 1)
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
            @elseif ($opd_category_variable->opd_variable->is_iku_triwulan)
                <form action="{{ route('opdPenilaianKinerja.store') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $opdPenilaian->id }}" name="opd_penilaian_id"
                        id="">
                    <input type="hidden" value="{{ $opd_category_variable->id }}"
                        name="opd_category_variable_id" id="">
                    <input type="hidden" value="100" name="target" id="">
                    <div class="mb-3">
                        <label>Rencana Aksi</label>
                        <select name="rencana_aksi_id" id="" required class="form-control">
                            <option value="">Pilih Rencana Aksi</option>
                            @foreach ($opdPenilaian->opd_perjanjian_kinerja->rencana_aksis as $rencana_aksi)
                                <option value="{{ $rencana_aksi->id }}">
                                    {{ $rencana_aksi->name }} | Total Capaian
                                    : {{ $rencana_aksi->getTotalCapaian($rencana_aksi->id) }}</option>
                            @endforeach
                        </select>
                    </div>
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
@push('custom-scripts')
@endpush
