<div class="text-end">
    <button type="submit" class="btn btn-sm btn-success ml-1" @click="opdPerjanjianKinerjaSasaran">Tarik Sasaran</button>
</div>
<div class="table-responsive mt-2">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sasaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opdPerjanjianKinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                <tr>
                    <td>{{ $opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
