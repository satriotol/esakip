<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengukuranKinerja\IkuKota;
use App\Models\PengukuranKinerja\KotaPerjanjianKinerja;
use Illuminate\Http\Request;

class PengukuranKinerjaKotaController extends Controller
{
    public function getIku(Request $request)
    {
        $iku_kotas = IkuKota::when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->orderBy('year', 'desc')->paginate();
        return $this->successResponse(['iku_kotas' => $iku_kotas]);
    }
    public function getPerjanjianKinerja(Request $request)
    {
        $perjanjian_kinerja_datas = KotaPerjanjianKinerja::when($request->name_search, function ($q) use ($request) {
            $q->where('name', 'like', "%" . $request->name_search . "%");
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->orderBy('year', 'desc')->paginate();
        return $this->successResponse(['perjanjian_kinerja_datas' => $perjanjian_kinerja_datas]);
    }
}
