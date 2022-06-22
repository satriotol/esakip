@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <div class="alert-body">
            <div class="alert-title">Error Validation!</div>
            <ul class="list-group">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    </div>
@endif
