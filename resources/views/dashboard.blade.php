@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Selamat Datang Di Dashboard E-SAKIP</h4>
        </div>
    </div>
    @if (Auth::user()->is_reset)
        <div class="grid-margin stretch-card">

            <div class="card mt-3">
                <div class="card-header">
                    <h5>Silahkan Ganti Password Anda</h5>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form action="{{ route('user.resetPassword', Auth::user()->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" @empty($user) required @endempty name="password"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Password Confirmation</label>
                            <input type="password" @empty($user) required @endempty
                                name="password_confirmation" class="form-control">
                            {!! Form::hidden('type', isset($type) ? $type : '') !!}
                        </div>
                        <div class="text-end">
                            <input class="btn btn-primary" type="submit" value="Ganti">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-4">
                <a href="https://penilaian.e-sakip.semarangkota.go.id/" target="_blank">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2>
                                Penilaian AKIP
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            @can('pengelolaanaset-bpkad')
                <div class="col-md-4">
                    <a href="{{ route('login.pengelolaanaset') }}" target="_blank">
                        <div class="card">
                            <div class="card-body text-center">
                                <h2>
                                    Pengelolaan Aset
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
    @endif
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (Auth::user()->is_reset)
        <script>
            Swal.fire({
                title: 'Himbauan',
                html: 'Untuk melindungi akun Anda, kami menyarankan untuk melakukan reset password secara berkala.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endpush
