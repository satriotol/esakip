@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('verifikator.index') }}">{{ $name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <form
                    action="@isset($verifikator) {{ route('verifikator.update', $verifikator->id) }} @endisset @empty($verifikator) {{ route('verifikator.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($verifikator)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        {!! Form::label('name', 'Nama', ['class' => 'form-label']) !!}
                        {!! Form::text('name', isset($verifikator) ? $verifikator->name : @old('name'), [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => 'Masukkan Nama Verifikator',
                        ]) !!}
                    </div>
                    <div class="mb-3">
                        {!! Form::label('phone', 'Nomor HP', ['class' => 'form-label']) !!}
                        {!! Form::number('phone', isset($verifikator) ? $verifikator->phone : @old('phone'), [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => 'Masukkan Nomor HP Verifikator',
                        ]) !!}
                    </div>
                    <div class="mb-3">
                        {!! Form::label('jabatan', 'Jabatan', ['class' => 'form-label']) !!}
                        {!! Form::text('jabatan', isset($verifikator) ? $verifikator->jabatan : @old('jabatan'), [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => 'Masukkan Jabatan Verifikator',
                        ]) !!}
                    </div>
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
