@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('audit.index') }}">Audit</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Audit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Audit</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('audit.create') }}">
                            <i data-feather="plus"></i>
                            Tambah
                        </a>
                    </div>
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User</label>
                                    <select name="user_id" class="js-example-basic-single form-select" id="">
                                        <option value="">Pilih OPD</option>
                                        @foreach ($users as $user)
                                            <option {{ old('user_id') == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('event', 'Event') !!}
                                    {!! Form::select('event', $events, old('event'), [
                                        'class' => 'js-example-basic-single form-select',
                                        'placeholder' => 'Pilih Event',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('auditable_type', 'Auditable Type') !!}
                                    {!! Form::select('auditable_type', $auditable_types, old('auditable_type'), [
                                        'class' => 'js-example-basic-single form-select',
                                        'placeholder' => 'Pilih Auditable Type',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-sm btn-success">Cari</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>User</th>
                                    <th>Event</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audits as $audit)
                                    <tr>
                                        <td>{{ $audit->created_at }}</td>
                                        <td>{{ $audit->user->name }} <br>{{ $audit->auditable_type }}
                                            <br>
                                            <div class="badge bg-danger">
                                                {{ $audit->ip_address }}
                                            </div>
                                            <br>
                                            <a href="{{ $audit->url }}" target="_blank">{{ $audit->url }}</a>
                                            <br>
                                            <div class="badge bg-success">
                                                {{ $audit->event }}
                                            </div>
                                        </td>
                                        <td>
                                            {{-- <pre>{{ $audit->old_values }}</pre> --}}
                                            <textarea name="" id="" rows="5" readonly class="form-control">{{ $audit->old_values }}</textarea>
                                            <textarea name="" id="" rows="5" readonly class="form-control mt-2">{{ $audit->new_values }}</textarea>
                                            {{-- <pre>{{ $audit->new_values }}</pre> --}}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $audits->appends($_GET)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script>
        document.getElementById("json").textContent = JSON.stringify(data, null, 2);
    </script>
@endpush
