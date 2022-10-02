<div class="card-body">
    <div class="d-flex justify-content-between align-items-baseline">
        <h3 class="card-title mb-0">{{ $rencanaAksi->name }}</h3>
    </div>
</div>
<div class="table-responsive mt-2">
    <form action="">
        <table class="table">
            <thead>
                <tr>
                    <th>Sasaran</th>
                    <th>Target</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opdPerjanjianKinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                    <tr>
                        <td>{{ $opd_perjanjian_kinerja_sasaran->sasaran }}</td>
                        <td><input type="text" class="form-control" value="" name="target" placeholder="Target">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
