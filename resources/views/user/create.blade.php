@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{ $name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <form
                    action="@isset($user) {{ route('user.update', $user->id) }} @endisset @empty($user) {{ route('user.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($user)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" name="name" type="text" required
                            value="{{ isset($user) ? $user->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" name="email" type="email" required
                            value="{{ isset($user) ? $user->email : '' }}">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" @empty($user) required @endempty name="password"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Password Confirmation</label>
                        <input type="password" @empty($user) required @endempty
                            name="password_confirmation" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Roles</label>
                        <select class="js-example-basic-single form-select" data-width="100%" required name="roles">
                            <option value="">Select Role</option>
                            @foreach ($roles as $r)
                                <option value="{{ $r->id }}"
                                    @isset($user) @if ($r->id === $user->roles[0]->id) selected @endif
                                @endisset>
                                    {{ $r->name }}
                                </option>
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
