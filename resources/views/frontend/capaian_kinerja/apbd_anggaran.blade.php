<div class="country-lists" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <select class="form-control" v-model="skpd_search" style="min-height: 50px;">
                            <option value="">Cari Berdasarkan OPD</option>
                            <option :value="data.id_skpd" v-for="(data, index) in dataSkpds">
                                @{{ data.nama_skpd }}</option>
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" @click="getApbdAnggaran()">Cari</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>OPD</th>
                            <th>Anggaran</th>
                            <th>Anggaran Pergeseran</th>
                            <th>Anggaran Perubahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in dataApbdAnggaran">
                            <td>
                                @{{ data.tahun }}
                            </td>
                            <td>
                                @{{ data.nama_skpd }}
                            </td>
                            <td>
                                @{{ formatPrice(data.anggaran) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.anggaran_pergeseran) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.anggaran_perubahan) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="dataApbdAnggaran.length == 0" class="text-center">
                    <img src="{{ asset('no-results.png') }}" style="height: 200px;"><br>
                    <h2>Data Tidak Ditemukan</h2>
                </div>
            </div>
        </div>
    </div>
</div>