<div class="modal fade bd-example-modal-lg" id="exampleModalStaffAhli{{ $opd_penilaian_staff->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $opd_penilaian_staff->judul }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('opdPenilaianStaff.update', $opd_penilaian_staff->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="table">
                        <tr>
                            <th>Judul</th>
                            <th>:</th>
                            <td>{{ $opd_penilaian_staff->judul }}</td>
                        </tr>
                        <tr>
                            <th>Bulan</th>
                            <th>:</th>
                            <td>{{ $opd_penilaian_staff->month->name }}</td>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <th>:</th>
                            <td>{{ $opd_penilaian_staff->opd_penilaian_staff_type->name }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td><select name="status" required id="" class="form-control">
                                    <option value="">Pilih Status</option>
                                    @foreach ($staffAhliStatuses as $staffAhliStatus)
                                        <option value="{{ $staffAhliStatus }}" @selected($staffAhliStatus == $opd_penilaian_staff->status)>
                                            {{ $staffAhliStatus }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Kualitas</th>
                            <th>:</th>
                            <td>
                                <input max="100" required type="number" step="any" class="form-control"
                                    value="{{ $opd_penilaian_staff->kualitas }}" name="kualitas">
                            </td>
                        </tr>
                        <tr>
                            <th>Data Dukung</th>
                            <th>:</th>
                            <td>
                                <a href="{{ asset('uploads/' . $opd_penilaian_staff->file) }}" target="_blank"
                                    class="btn btn-primary">Buka Data Dukung</a>
                            </td>
                        </tr>
                    </table>
                    <div class="text-end">
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
