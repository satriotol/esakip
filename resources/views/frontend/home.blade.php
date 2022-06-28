@extends('frontend.layouts.main')
@section('content')
    <div class="banner-area text-center single-banner bg-cover text-light"
        style="background-image: url({{('kotasemarangvector.jpg')}});">
        <div class="item">
            <div class="box-table shadow theme-hard">
                <div class="box-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="content">
                                    <h2 data-animation="animated fadeInLeft">E-SAKIP</h2>
                                    <p data-animation="animated slideInUp">
                                        Sistem Akuntabilitas Kinerja Instansi Pemerintah Secara Elektronik <br>
                                        PEMERINTAH KOTA SEMARANG
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wavesshape">
                        <img src="{{asset('frontend/img/waves-shape.svg')}}" alt="Shape">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
