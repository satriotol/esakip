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
                    action="@isset($opdPerjanjianKinerjaSasaran) {{ route('opdPerjanjianKinerjaSasaran.update', $opdPerjanjianKinerjaSasaran->id) }} @endisset @empty($opdPerjanjianKinerjaSasaran) {{ route('opdPerjanjianKinerjaSasaran.store', $opdPerjanjianKinerja) }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdPerjanjianKinerjaSasaran)
                        @method('PUT')
                    @endisset
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Sasaran</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="sasaran[]" placeholder="Sasaran" required
                                    class="form-control" /></td>
                            <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add
                                    More</button></td>
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
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" required name="sasaran[' + i +
                ']" placeholder="Sasaran" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
