<div class="col-md-5 mt-2">
    <div class="card">
        <div class="card-body">
            <div class="card-title">Form Staf Ahli</div>
            <form action="{{ route('opdPenilaianStaff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="opd_penilaian_id" class="d-none" value="{{ $opdPenilaian->id }}"
                    id="">
                <div class="mb-3">
                    <label for="name" class="form-label">Tipe Dokumen</label>
                    <select class="js-example-basic-single form-select" data-width="100%"
                        name="opd_penilaian_staff_type_id" required>
                        <option value="">Pilih Tipe</option>
                        @foreach ($opdPenilaianStaffTypes as $opdPenilaianStaffType)
                            <option value="{{ $opdPenilaianStaffType->id }}">
                                {{ $opdPenilaianStaffType->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Bulan</label>
                    <select class="js-example-basic-single form-select" data-width="100%" name="month_id" required>
                        <option value="">Pilih Bulan</option>
                        @foreach ($months as $month)
                            <option value="{{ $month->id }}">
                                {{ $month->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input id="judul" class="form-control" name="judul" type="text" required
                        value="{{ isset($opdPenilaian) ? $opdPenilaian->judul : @old('year') }}">
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input type="file" id="filePendukung" name="file"
                        @empty($opdPenilaian) required @endempty />
                </div>
                <div class="text-end">
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-7 mt-2">
    <div class="card">
        <div class="card-body">
            <div class="card-title">Penilaian Kinerja OPD</div>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Tipe</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Kualitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opdPenilaian->opd_penilaian_staffs as $opd_penilaian_staff)
                            <tr>
                                <td>{{ $opd_penilaian_staff->month->name }}</td>
                                <td>{{ $opd_penilaian_staff->opd_penilaian_staff_type->name }}</td>
                                <td>{{ $opd_penilaian_staff->judul }}</td>
                                <td>{{ $opd_penilaian_staff->status }}
                                </td>
                                <td>{{ $opd_penilaian_staff->kualitas }}</td>
                                <td>
                                    @include('opdPenilaian.modalStaffAhil')
                                    <form action="{{ route('opdPenilaianStaff.destroy', $opd_penilaian_staff->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        @if (!Auth::user()->opd_id)
                                            <a type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalStaffAhli{{ $opd_penilaian_staff->id }}">
                                                Update Status
                                            </a>
                                        @endif
                                        <button type="submit" class="badge bg-danger"
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
        </div>
    </div>
</div>
