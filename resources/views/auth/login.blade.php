@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

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
                                <form method="POST" class="forms-sample" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="email" id="userEmail"
                                            placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="userPassword"
                                            autocomplete="current-password" placeholder="Password">
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="authCheck">
                                        <label class="form-check-label" for="authCheck">
                                            Remember me
                                        </label>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary me-2 mb-2 mb-md-0">Login</button>
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
