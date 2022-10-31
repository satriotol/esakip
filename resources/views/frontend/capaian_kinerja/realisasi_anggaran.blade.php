<div class="country-lists" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control" v-model="skpd_search" style="min-height: 50px;">
                            <option value="">Cari Berdasarkan OPD</option>
                            <option :value="data.id_skpd" v-for="(data, index) in dataSkpds">
                                @{{ data.nama_skpd }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="number" v-model="year_search" placeholder="Cari Berdasarkan Tahun"
                            class="form-control">
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-success" @click="exportRealisasiAnggaran" target="_blank"
                        :disabled="loading">Download Excel</button>
                    <button class="btn btn-primary" @click="getRealisasiAnggaran()">Cari</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>OPD</th>
                            <th>Anggaran</th>
                            <th>Perubahan</th>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Maret</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Juni</th>
                            <th>Juli</th>
                            <th>Agustus</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Desember</th>
                            <th>Jumlah Realisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in dataRealisasiAnggaran">
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
                                @{{ formatPrice(data.perubahan) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.januari) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.februari) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.maret) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.april) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.mei) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.juni) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.juli) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.agustus) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.september) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.oktober) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.november) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.desember) }}
                            </td>
                            <td>
                                @{{ formatPrice(data.jml_realisasi) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="dataRealisasiAnggaran.length == 0" class="text-center">
                    <img src="{{ asset('no-results.png') }}" style="height: 200px;"><br>
                    <h2>Data Tidak Ditemukan</h2>
                </div>
            </div>
        </div>
    </div>
</div>
