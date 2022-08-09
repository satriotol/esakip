<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerencanaanKinerjaCascadingKinerja;
use App\Models\PerencanaanKinerjaRkpd;
use App\Models\PerencanaanKinerjaRpjmd;
use Illuminate\Http\Request;

class PerencanaanKinerjaKotaController extends Controller
{
    public function getRpjmd(Request $request)
    {
        $rpjmds = PerencanaanKinerjaRpjmd::when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->paginate();

        return $this->successResponse(['rpjmd_datas' => $rpjmds]);
    }
    public function getRkpd(Request $request)
    {
        $rkpds = PerencanaanKinerjaRkpd::when($request->name_search, function ($q) use ($request) {
            $q->where('name', 'like', "%" . $request->name_search . "%");
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->paginate();

        return $this->successResponse(['rkpd_datas' => $rkpds]);
    }
    public function getCascadingKinerja(Request $request)
    {
        $cascading_kinerjas = PerencanaanKinerjaCascadingKinerja::when($request->name_search, function ($q) use ($request) {
            $q->where('name', 'like', "%" . $request->name_search . "%");
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->paginate();

        return $this->successResponse(['cascading_kinerja_datas' => $cascading_kinerjas]);
    }
}
