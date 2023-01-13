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
                                    <td>{{ $getOpdPerjanjianKinerjaIndikator->target }}</td>
                                    <td>
                                        {{ $opd_category_variable->getIkuType($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}
                                    </td>
                                    <td>{{ $opd_category_variable->getIkuRealisasi($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}
                                    </td>
                                    <td>
                                        {{ $opd_category_variable->getIkuCapaian($opdPenilaian->id, $getOpdPerjanjianKinerjaIndikator->id) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
