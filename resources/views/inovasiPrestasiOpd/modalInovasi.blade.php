<form action="{{ route('inovasiPrestasiOpd.updateStatus', [$inovasiPrestasiOpd->id]) }}">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdrop{{ $inovasiPrestasiOpd->id }}Label">
                {{ $inovasiPrestasiOpd->name }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td class="text-wrap">
                        {{ $inovasiPrestasiOpd->name }}
                    </td>
                </tr>
                <tr>
                    <td>OPD</td>
                    <td>:</td>
                    <td>{{ $inovasiPrestasiOpd->opd->nama_opd }}</td>
                </tr>
                <tr>
                    <td>Tingkat</td>
                    <td>:</td>
                    <td>{{ $inovasiPrestasiOpd->inovasi_prestasi_tingkat->name }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pemberian</td>
                    <td>:</td>
                    <td>{{ $inovasiPrestasiOpd->date }}</td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td>{{ $inovasiPrestasiOpd->year }}</td>
                </tr>
                <tr>
                    <td>Instansi Pemberi</td>
                    <td>:</td>
                    <td class="text-wrap">
                        {{ $inovasiPrestasiOpd->instansi_pemberi }}
                    </td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td class="text-wrap">
                        {{ $inovasiPrestasiOpd->description }}</td>
                </tr>
                <tr>
                    <td>File</td>
                    <td>:</td>
                    <td>
                        <a href="{{ asset('uploads/' . $inovasiPrestasiOpd->file) }}" target="_blank">Buka File</a>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>
                        {{ $inovasiPrestasiOpd->getStatus()['name'] }}
                        @unlessrole('OPD')
                            <select name="is_verified" id="" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1" @selected($inovasiPrestasiOpd->is_verified == 1)>Diterima</option>
                                <option value="2" @selected($inovasiPrestasiOpd->is_verified == 2)>Ditolak</option>
                            </select>
                        @endunlessrole
                    </td>
                </tr>
                <tr>
                    <td>Note</td>
                    <td>:</td>
                    <td>
                        <textarea @disabled(Auth::user()->opd_id) name="note" class="form-control">{{ $inovasiPrestasiOpd->note }}</textarea>
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            @unlessrole('OPD')
                <button type="submit" class="btn btn-success">Simpan</button>
            @endunlessrole
        </div>
    </div>
</form>
