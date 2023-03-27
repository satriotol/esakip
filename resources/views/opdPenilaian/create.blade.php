@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('opdPenilaian.index') }}">Penilaian OPD</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Form Penilaian OPD</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card" id="app">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Penilaian OPD</h4>
                @include('partials.errors')
                <form
                    action="@isset($opdPenilaian) {{ route('opdPenilaian.update', $opdPenilaian->id) }} @endisset @empty($opdPenilaian) {{ route('opdPenilaian.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($opdPenilaian)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="year" class="form-label">Tahun</label>
                        <input id="year" class="form-control" name="year" v-model="year" type="number"
                            @change="getPerjanjianKinerjas" placeholder="yyyy" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Triwulan</label>
                        <select name="name" id="" class="form-control">
                            <option value="">Pilih Triwulan</option>
                            @foreach ($triwulans as $triwulan)
                                <option value="{{ $triwulan }}">{{ $triwulan }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">Kosongkan jika penilaian tahunan</small>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">OPD</label>
                        <select class="form-select" v-model="opd_id" data-width="100%" @change="getPerjanjianKinerjas"
                            name="opd_id" required>
                            <option value="">Pilih OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}"
                                    @isset($opdPenilaian) 
                                    @if ($opd->id === $opdPenilaian->opd_id) selected  @endif
                                @endisset>
                                    {{ $opd->nama_opd }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if (Auth::user()->opd?->is_staff_ahli != 1)
                        <div class="mb-3">
                            <label for="name" class="form-label">Perjanjian Kinerja</label>
                            <select class="form-select" v-model="opd_perjanjian_kinerja_id" required data-width="100%"
                                name="opd_perjanjian_kinerja_id">
                                <option value="">Pilih Perjanjian Kinerja</option>
                                <option :value="opdPerjanjianKinerja.id"
                                    v-for="opdPerjanjianKinerja in opdPerjanjianKinerjas">@{{ opdPerjanjianKinerja.year }} |
                                    @{{ opdPerjanjianKinerja.opd.nama_opd }} | @{{ opdPerjanjianKinerja.type }}</option>
                            </select>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="">Kategori Penilaian</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="opd_category_id"
                            required>
                            <option value="">Pilih Kategori Penilaian</option>
                            @foreach ($opdCategories as $opdCategory)
                                <option value="{{ $opdCategory->id }}"
                                    @isset($opdPenilaian) 
                                        @if ($opdCategory->id === $opdPenilaian->opd_category_id) selected  @endif
                                    @endisset>
                                    {{ $opdCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('opdPenilaian.index') }}" class="btn btn-warning">Kembali</a>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    year: '',
                    opd_id: '',
                    type: '',
                    opdPerjanjianKinerjas: '',
                    inovasiPrestasiOpds: '',
                    opd_perjanjian_kinerja_id: '',
                    inovasi_prestasi_opd_id: '',
                    loading: false,
                }
            },
            mounted() {},
            methods: {
                getPerjanjianKinerjas() {
                    this.opd_perjanjian_kinerja_id = '';
                    this.loading = true;
                    this.inovasi_prestasi_opd_id = '';
                    axios.get('{{ route('opdPenilaian.getOpdPerjanjianKinerjas') }}', {
                            params: {
                                year: this.year,
                                opd_id: this.opd_id
                            },
                        })
                        .then(response => (
                            this.opdPerjanjianKinerjas = response.data.opdPerjanjianKinerjas,
                            this.inovasiPrestasiOpds = response.data.inovasiPrestasiOpds
                        ))
                        .catch(function(error) {
                            console.log(error)
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },
            },
        }).mount('#app')
    </script>
@endpush
