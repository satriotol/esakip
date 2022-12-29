<div class="card">
    <div class="card-body">
        <h4 class="card-title">Form {{ $rencanaAksi->opd_perjanjian_kinerja->opd_name }}
            {{ $rencanaAksi->opd_perjanjian_kinerja->year }} {{ $rencanaAksi->name }}</h4>
        <form action="" @submit.prevent="postData()">
            <div class="mb-3">
                <label class="form-label">Sasaran</label>
                <select name="" class="form-control" v-model="form.opd_perjanjian_kinerja_sasaran_id" required>
                    <option value="">Pilih Sasaran</option>
                    @foreach ($rencanaAksi->opd_perjanjian_kinerja->opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                        <option value="{{ $opd_perjanjian_kinerja_sasaran->id }}">
                            {{ $opd_perjanjian_kinerja_sasaran->sasaran }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Rencana Aksi</label>
                <textarea name="" class="form-control" v-model="form.rencana_aksi_note" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Indikator</label>
                <textarea name="" class="form-control" v-model="form.indikator_kinerja_note" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tipe</label>
                <select name="" class="form-control" v-model="form.type" required>
                    <option value="">Pilih tipe</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}">
                            {{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Target</label>
                        <input type="number" v-model="form.target" required class="form-control" name=""
                            id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" v-model="form.satuan" required class="form-control" name=""
                            id="">
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" @click="postData()" :disabled="loading" type="submit"
                    v-else="loading">Submit</button>
            </div>
        </form>
    </div>
</div>
