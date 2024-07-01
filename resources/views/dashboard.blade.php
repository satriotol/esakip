@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Selamat Datang Di Dashboard E-Sakip</h4>
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
    @endif
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
