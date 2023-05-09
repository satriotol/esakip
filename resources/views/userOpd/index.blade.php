@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('userOpd.index') }}">{{ $name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel {{ $name }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{ $name }}</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('userOpd.create') }}">
                            <i data-feather="plus"></i>
                            Tambah
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>OPD</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    <label class="badge bg-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $user->opd->nama_opd }}</td>
                                        <td>
                                            <form action="{{ route('user.resetPassword', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-info"
                                                    onclick="return confirm('Are you sure?')">
                                                    Reset Password
                                                </button>
                                            </form>
                                            <a class="btn btn-warning" href="{{ route('userOpd.edit', $user->id) }}">
                                                Edit
                                            </a>
                                            @if ($user->id != Auth::user()->id)
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
