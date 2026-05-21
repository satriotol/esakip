<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="E-SAKIP - Sistem Akuntabilitas Kinerja Instansi Pemerintah Secara Elektronik Pemerintah Kota Semarang">
    <title>E-SAKIP PEMKOT SEMARANG</title>
    <link rel="shortcut icon" href="{{ asset('frontend/img/pemkot.png') }}" type="image/x-icon">

    {{-- Bootstrap 3 (untuk grid & kompabilitas) --}}
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #333;
            background: #f5f6fa;
            margin: 0;
            padding-top: 0;
        }
        img { max-width: 100%; }
        a { transition: color .2s; }
    </style>

    @stack('css')
</head>

<body>

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

    {{-- Core JS --}}
    <script src="{{ asset('frontend/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    {{-- Vue 3 & Axios --}}
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    @stack('script')

</body>

</html>
