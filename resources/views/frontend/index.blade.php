<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <title>Hello, world!</title>
</head>

<body>
    <div id="app">
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in datas">
                        <td>
                            @{{ data.year }}
                        </td>
                        <td>
                            @{{ data.name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination" style="cursor:pointer;">
                    <li class="page-item" :class="{ active: link.active }" v-for="link in pagination.links"
                        @click="getKotaLkjips(link.url)">
                        <a class="page-link" v-if="link.label">
                            @{{ (link.label).split('.')[1] ?? (link.label).split('.')[0]}}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        const {
            createApp
        } = Vue;
        const API_URL = "{{ env('API_URL') }}";

        createApp({
            data() {
                return {
                    message: 'Hello Vue!',
                    datas: [],
                    url: API_URL + 'kotaLkjip',
                    pagination: "",

                }
            },
            mounted() {
                this.getKotaLkjips();
            },
            methods: {
                getKotaLkjips(pageUrl) {
                    if (pageUrl) {
                        pageUrl = pageUrl.split('=').pop();
                    }
                    axios.get(this.url, {
                            params: {
                                page: pageUrl,
                            }
                        })
                        .then(response => (
                            this.datas = response.data.lkjips_data.data,
                            this.pagination = response.data.lkjips_data
                        ))
                        .catch(function(error) {
                            console.log(error);
                        })
                }
            },
        }).mount('#app')
    </script>

</body>

</html>
