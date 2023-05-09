<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="E-Sakip Kota Semarang">

    <title>ESAKIP - PEMKOT SEMARANG</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('frontend/img/pemkot.png') }}" type="image/x-icon">

    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <!-- end common css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
        integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .required {
            color: red;
        }

        html {
            zoom: 85%;
        }

        .modal-backdrop {
            width: 100%;
            height: 100%;
        }
    </style>
    @stack('style')
</head>

<body data-base-url="{{ url('/') }}">

    <script src="{{ asset('assets/js/spinner.js') }}"></script>

    <div class="main-wrapper" id="app">
        @include('layout.sidebar')
        <div class="page-wrapper">
            @include('layout.header')
            <div class="page-content">
                @yield('content')
            </div>
            @include('layout.footer')
        </div>
    </div>

    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"
        integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.all.min.js"></script>

    @stack('custom-scripts')

    @if (session()->has('success'))
        <script>
            iziToast.success({
                title: 'OK',
                message: 'Successfully',
            });
        </script>
    @elseif(session()->has('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ session()->get('error') }}',
            });
        </script>
    @elseif(session()->has('bug'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session()->get('bug') }}',
            })
        </script>
    @endif
    <script>
        $(function() {
            $('.mb-3:has(input[required]) > label')
                .after('<span class="required"> *</span>')
            $('.mb-3:has(select[required]) > label')
                .after('<span class="required"> *</span>')
            $('.mb-3:has(textarea[required]) > label')
                .after('<span class="required"> *</span>')
        })
    </script>
    <script>
        const inputElements = document.querySelectorAll('.upload-filepond');

        inputElements.forEach(inputElement => {
            FilePond.registerPlugin(FilePondPluginFileValidateSize);
            FilePond.create(inputElement, {
                server: {
                    process: '{{ route('upload.store') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                maxFileSize: '100MB'
            });
        });
    </script>
</body>

</html>
