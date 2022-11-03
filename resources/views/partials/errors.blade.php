@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Terjadi Kesalahan</strong> Cek Kembali Inputan Anda<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
