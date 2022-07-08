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
                        <div class="form-group">

                            <label for="name" class="form-label">Permission</label> <br>
                            @empty($role)
                                <div class="row">
                                    @foreach ($permission as $value)
                                        <div class="col-md-3">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name form-check-input']) }}
                                                    {{ $value->name }}</label>
                                                <br />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endempty
                            @isset($role)
                                <div class="row">
                                    @foreach ($permission as $value)
                                        <div class="col-md-3">
                                            <div class="form-check form-check-inline">

                                                <label
                                                    class="form-check-label">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name form-check-input']) }}
                                                    {{ $value->name }}</label>
                                                <br />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endisset
                        </div>
                    </div>
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
