@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPerjanjianKinerja.index') }}">{{ $name }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form {{ $name }}</li>
        </ol>
        <a href="{{ url()->previous() }}" class="badge rounded-pill bg-primary">
            <i data-feather="arrow-left"></i> Back
        </a>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form {{ $name }}</h4>
                @include('partials.errors')
                <form
                    action="@isset($opdPerjanjianKinerjaIndikator) {{ route('opdPerjanjianKinerjaIndikator.update', $opdPerjanjianKinerjaIndikator->id) }} @endisset @empty($opdPerjanjianKinerjaIndikator) {{ route('opdPerjanjianKinerjaIndikator.store', $opdPerjanjianKinerja) }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdPerjanjianKinerjaIndikator)
                        @method('PUT')
                    @endisset
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Sasaran</th>
                            <th>Indikator</th>
                            <th>Target</th>
                            <th>Satuan</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="addMoreInputFields[0][opd_perjanjian_kinerja_sasaran_id]" class="form-control"
                                    required>
                                    <option value="">Pilih Sasaran</option>
                                    @foreach ($opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran)
                                    <option value="{{$opd_perjanjian_kinerja_sasaran->id}}">{{$opd_perjanjian_kinerja_sasaran->sasaran}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" required class="form-control" name="addMoreInputFields[0][indikator]">
                            </td>
                            <td>
                                <input type="text" required class="form-control" name="addMoreInputFields[0][target]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="addMoreInputFields[0][satuan]">
                            </td>
                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Indikator</button></td>
                        </tr>
                    </table>
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
    <script type="text/javascript">
        var i = 0;
    
            $("#dynamic-ar").click(function() {
                ++i;
                var sasaran = '@foreach($opd_perjanjian_kinerja_sasarans as $opd_perjanjian_kinerja_sasaran) <option value="{{$opd_perjanjian_kinerja_sasaran->id}}">{{$opd_perjanjian_kinerja_sasaran->sasaran}}</option> @endforeach';
                var sasaran_table = '<td><select name="addMoreInputFields['+i+'][opd_perjanjian_kinerja_sasaran_id]" class="form-control" required><option value="">Pilih Sasaran</option>'+sasaran+'</select></td>';
                var target_table = '<td><input type="text" required class="form-control" name="addMoreInputFields['+i+'][target]"></td>';
                var indikator_table = '<td><input type="text" required class="form-control" name="addMoreInputFields['+i+'][indikator]"></td>';
                var satuan_table = '<td><input type="text" class="form-control" name="addMoreInputFields['+i+'][satuan]"></td>'
                let html = '<tr>'+ sasaran_table + indikator_table + target_table + satuan_table +'<td><button type="button" class="btn btn-outline-danger remove-input-field">Hapus</button></td><tr>';    
            $("#dynamicAddRemove").append(html);
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
