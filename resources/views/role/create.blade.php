@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('role.index') }}">{{ $name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <form
                    action="@isset($role) {{ route('role.update', $role->id) }} @endisset @empty($role) {{ route('role.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($role)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($role) ? $role->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Permission</label>
                        <select name="permission[]" required multiple id="" class="form-control">
                            @foreach ($permission as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
