@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdCategory.index') }}">Kategori OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Kategori OPD</li>
        </ol>
        <a href="{{ route('opdCategory.index') }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Kategori OPD</h4>
                    @include('partials.errors')
                    <form
                        action="@isset($opdCategory) {{ route('opdCategory.update', $opdCategory->id) }} @endisset @empty($opdCategory) {{ route('opdCategory.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($opdCategory)
                            @method('PUT')
                        @endisset
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input id="name" class="form-control" name="name" type="text" required
                                value="{{ isset($opdCategory) ? $opdCategory->name : @old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="type">Tipe</label>
                            <select name="type" class="form-control" id="" required>
                                <option value="">Pilih PIC</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" @selected(isset($opdCategory) ? $opdCategory->type == $type : @old('type'))>{{ $type }}
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
            <div class="card mt-2">
                <div class="card-body">
                    <h4 class="card-title">Form Variabel</h4>
                    @include('partials.errors')
                    <form action="{{ route('opdCategoryVariable.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $opdCategory->id }}" name="opd_category_id" id="">
                        <div class="mb-3">
                            <label for="opd_variable_id">Variabel</label>
                            <select name="opd_variable_id" class="js-example-basic-single form-select" id=""
                                required>
                                <option value="">Pilih Variabel</option>
                                @foreach ($opdVariables as $opdVariable)
                                    <option value="{{ $opdVariable->id }}" required>{{ $opdVariable->name }} |
                                        {{ $opdVariable->bobot }}
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Kategori Opd</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Variabel</th>
                                    <th>Bobot</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opdCategory->opd_category_variables as $opd_category_variable)
                                    <tr>
                                        <td>
                                            {{ $opd_category_variable->opd_variable?->name }}
                                        </td>
                                        <td>
                                            {{ $opd_category_variable->opd_variable?->bobot }}
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('opdCategoryVariable.destroy', $opd_category_variable->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th colspan="1">Total</th>
                                <th>{{ $opdCategory->total_bobot }}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
