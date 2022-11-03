<div class="modal fade bd-example-modal-lg" id="exampleModal{{ $opd_category_variable->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $opd_category_variable->opd_variable->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('opdPenilaianKinerja.store') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $opdPenilaian->id }}" name="opd_penilaian_id" id="">
                    <input type="hidden" value="{{ $opd_category_variable->id }}" name="opd_category_variable_id"
                        id="">
                    @if (!$opd_category_variable->opd_variable->is_range)
                        <div class="mb-3">
                            <label>Target</label>
                            <input type="number" class="form-control" name="target" required id=""
                                value="{{ $opdPenilaian->target($opd_category_variable->id) }}">
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Target Bawah</label>
                                    <input type="number" class="form-control" name="target" step="any" required id=""
                                        value="{{ $opdPenilaian->target($opd_category_variable->id) ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Target Atas</label>
                                    <input type="number" class="form-control" name="target_atas" step="any" required
                                        id=""
                                        value="{{ $opdPenilaian->targetAtas($opd_category_variable->id) ?? '' }}">
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label>Realisasi</label>
                        <input type="number" class="form-control" name="realisasi" required id=""
                            value="{{ $opdPenilaian->realisasi($opd_category_variable->id) }}">
                    </div>
                    <small>
                        Tidak Perlu Menggunakan % <br>
                    </small>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
