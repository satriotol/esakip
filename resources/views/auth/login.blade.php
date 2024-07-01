@extends('layout.master2')
@push('plugin-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="page-content d-flex align-items-center justify-content-center" id="app">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper"
                                style="background-image: url({{ asset('assets/images/others/pemkot.jpg') }})">

                            </div>
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">E-SAKIP PEMKOT SEMARANG</a>
                                <h5 class="text-muted fw-normal mb-4">Selamat Datang Kembali</h5>
                                @include('partials.errors')
                                <form method="post" class="forms-sample" @submit.prevent="login">
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="email" v-model="form.email"
                                            id="userEmail" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input :type="showPassword ? 'text' : 'password'" class="form-control"
                                            name="password" v-model="form.password" id="userPassword"
                                            autocomplete="current-password" placeholder="Password">
                                        <span @click="togglePasswordVisibility"
                                            class="position-absolute top-50 end-0 translate-middle-y pe-3"
                                            style="cursor: pointer;">
                                            <i :class="showPassword ? 'fa fa-eye-slash' : 'fa fa-eye'"></i>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <div class="captcha">
                                            <span v-html="captchaImage"></span>
                                            <button type="button" @click="reloadCaptcha()" class="btn btn-danger"
                                                class="reload">
                                                &#x21bb;
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input id="captcha" type="text" class="form-control"
                                            placeholder="Enter Captcha" name="captcha" v-model="form.captcha">
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="authCheck">
                                        <label class="form-check-label" for="authCheck">
                                            Ingat Saya
                                        </label>
                                    </div>
                                    <div>
                                        <input type="submit" class="btn btn-primary me-2 mb-2 mb-md-0" name=""
                                            id="" value="Login">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.7/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"
        integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    message: 'Hello Vue!',
                    form: {
                        email: "",
                        password: "",
                        captcha: "",
                    },
                    captchaImage: '',
                    showPassword: false
                }
            },
            methods: {
                togglePasswordVisibility() { // New method
                    this.showPassword = !this.showPassword;
                },
                login() {
                    Swal.fire({
                        title: 'Mencoba Masuk',
                        icon: 'info',
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        allowOutsideClick: false
                    });
                    // console.log(this.form);
                    axios.post('/login', this.form)
                        .then((res) => {
                            console.log(res);
                            Swal.fire({
                                title: 'Sukses',
                                icon: 'success',
                                confirmButtonText: 'Lanjut',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    window.location.href = res.request.responseURL
                                }
                            })
                        }).catch((err) => {
                            Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                text: err.response.data.message,
                                confirmButtonText: 'Ok',
                            });
                            this.reloadCaptcha();
                        });
                },
                reloadCaptcha() {
                    axios.get('/reload-captcha')
                        .then((res) => {
                            this.captchaImage = res.data.captcha;
                            console.log(this.captchaImage);
                        });
                }
            },
            mounted() {
                this.reloadCaptcha();
            },
        }).mount('#app')
    </script>
@endpush
