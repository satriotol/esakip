<div class="country-lists" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <input type="number" v-model="year_search" placeholder="Cari Berdasarkan Tahun"
                            class="form-control">
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" @click="getKotaRpjmd()">Cari</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in dataRpjmd">
                            <td>
                                @{{ data.year }}
                            </td>
                            <td>
                                @{{ data.name }}
                            </td>
                            <td>
                                <a :href="data.file_url" target="_blank" class="btn btn-success"><i
                                        class="fa-solid fa-eye"></i> View</a>
                                <a download :href="data.file_url" target="_blank" class="btn btn-danger"><i
                                        class="fa-solid fa-download"></i> Download</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="dataRpjmd.length == 0" class="text-center">
                    <img src="{{ asset('no-results.png') }}" style="height: 200px;"><br>
                    <h2>Data Tidak Ditemukan</h2>
                </div>
                <nav aria-label="Page navigation example" class="text-right">
                    <ul class="pagination" style="cursor:pointer;">
                        <li class="page-item" :class="{ active: link.active }" v-for="link in paginationRpjmd.links"
                            @click="getKotaRpjmd(link.url)">
                            <a class="page-link" v-if="link.label">
                                @{{ (link.label).split('.')[1] ?? (link.label).split('.')[0] }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
