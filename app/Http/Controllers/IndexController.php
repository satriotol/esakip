<?php

namespace App\Http\Controllers;

use App\Models\PengukuranKinerja\IkuKota;
use App\Models\PerencanaanKinerjaRpjmd;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }
    public function pelaporan_kinerja()
    {
        return view('frontend.pelaporan_kinerja.index');
    }
    public function perencanaan_kinerja_kota()
    {
        $name = 'Perencanaan Kinerja Kota';
        $rpjmd = PerencanaanKinerjaRpjmd::first();
        return view('frontend.perencanaan_kinerja_kota.index', compact('name', 'rpjmd'));
    }
    public function perencanaan_kinerja_opd()
    {
        $name = 'Perencanaan Kinerja Opd';
        return view('frontend.perencanaan_kinerja_opd.index', compact('name'));
    }
    public function pengukuran_kinerja_kota()
    {
        $name = 'Pengukuran Kinerja Kota';
        $iku = IkuKota::first();
        return view('frontend.pengukuran_kinerja_kota.index', compact('name', 'iku'));
    }
    public function pengukuran_kinerja_opd()
    {
        $name = 'Pengukuran Kinerja Opd';
        return view('frontend.pengukuran_kinerja_opd.index', compact('name'));
    }
    public function capaian_kinerja()
    {
        $name = 'Capaian Kinerja';
        return view('frontend.capaian_kinerja.index', compact('name'));
    }
    public function evaluasi_kinerja()
    {
        $name = 'Evaluasi Kinerja';
        return view('frontend.evaluasi_kinerja.index', compact('name'));
    }
}
