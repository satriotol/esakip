<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<div id="app">
    <table>
        <thead>
            <th>OPD</th>
            <th>Anggaran</th>
            <th>Januari</th>
        </thead>
        <tbody v-for="test in realisasiAnggarans.RealisasiAnggaran">
            <td>@{{ test.nama_skpd }}</td>
            <td>@{{ test.nama_skpd }}</td>
            <td>@{{ test.januari }}</td>
        </tbody>
    </table>
</div>

<script>
    const {
        createApp
    } = Vue;
    const API_URL = "{{ env('API_URL') }}";

    createApp({
        data() {
            return {
                message: 'Hello Vue!',
                realisasiAnggarans: [],
            }
        },
        mounted() {
            this.getRealisasiAnggarans();
        },
        methods: {
            getRealisasiAnggarans() {
                axios.get(API_URL + 'getRealisasiAnggaran')
                    .then(response => (this.realisasiAnggarans = response.data))
                    .catch(function(error) {
                        console.log(error);
                    })
            }
        },
    }).mount('#app')
</script>
