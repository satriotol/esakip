@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdVariable.index') }}">Variable OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Variable OPD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Variable OPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($opdVariable) {{ route('opdVariable.update', $opdVariable->id) }} @endisset @empty($opdVariable) {{ route('opdVariable.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdVariable)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Variable</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($opdVariable) ? $opdVariable->name : @old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="bobot" class="form-label">Bobot</label>
                        <input id="bobot" class="form-control" name="bobot" type="number" required
                            value="{{ isset($opdVariable) ? $opdVariable->bobot : @old('bobot') }}">
                    </div>
                    <div class="mb-3">
                        <label for="pic">PIC</label>
                        <select name="pic" class="form-control" id="" required>
                            <option value="">Pilih PIC</option>
                            @foreach ($pics as $pic)
                                <option value="{{ $pic }}" @selected(isset($opdVariable) ? $opdVariable->pic == $pic : @old('pic'))>{{ $pic }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Efisiensi</label>
                        <select name="is_efisiensi" class="form-control" id="">
                            <option value="">Pilih Efisiensi</option>
                            <option value="1" @selected(isset($opdVariable) ? 1 == $opdVariable->is_efisiensi : @old('is_efisiensi'))>Ya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">SAKIP</label>
                        <select name="is_sakip" class="form-control" id="">
                            <option value="">Pilih Tipe</option>
                            <option value="1" @selected(isset($opdVariable) ? 1 == $opdVariable->is_sakip : @old('is_sakip'))>Ya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Reformasi Birokrasi</label>
                        <select name="is_reformasi_birokrasi" class="form-control" id="">
                            <option value="">Pilih Tipe</option>
                            <option value="1" @selected(isset($opdVariable) ? 1 == $opdVariable->is_reformasi_birokrasi : @old('is_reformasi_birokrasi'))>Ya</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
