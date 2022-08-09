<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerencanaanKinerja\CascadingKinerjaOpd;
use App\Models\PerencanaanKinerja\PeriodeRenstraOpd;
use App\Models\PerencanaanKinerja\RenjaOpd;
use App\Models\PerencanaanKinerja\RenstraOpd;
use App\Models\PerencanaanKinerja\RktOpd;
use Illuminate\Http\Request;

class PerencanaanKinerjaOpdController extends Controller
{
    public function getRenstraPeriod()
    {
        $renstra_period_datas = PeriodeRenstraOpd::all();
        return $this->successResponse(['renstra_period_datas' => $renstra_period_datas]);
    }
    public function getRenstra(Request $request)
    {
        $renstra_datas = RenstraOpd::when($request->periode_renstra_opd_id, function ($q) use ($request) {
            $q->where('periode_renstra_opd_id', $request->renstra_period_search);
        })->when($request->opd_search, function ($q) use ($request) {
            $q->where('opd_id', $request->opd_search);
        })->paginate();

        return $this->successResponse(['renstra_datas' => $renstra_datas]);
    }
    public function getRkt(Request $request)
    {
        $rkt_datas = RktOpd::when($request->name_search, function ($q) use ($request) {
            $q->where('name', 'like', "%" . $request->name_search . "%");
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->when($request->opd_search, function ($q) use ($request) {
            $q->where('opd_id', $request->opd_search);
        })->orderBy('year', 'desc')->paginate();
        return $this->successResponse(['rkt_datas' => $rkt_datas]);
    }
    public function getRenja(Request $request)
    {
        $renja_datas = RenjaOpd::when($request->opd_search, function ($q) use ($request) {
            $q->where('opd_id', $request->opd_search);
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->when($request->type_search, function ($q) use ($request) {
            $q->where('type', $request->type_search);
        })->orderBy('year', 'desc')->paginate();
        return $this->successResponse(['renja_datas' => $renja_datas]);
    }
    public function getCascadingKinerja(Request $request)
    {
        $cascading_kinerja_datas = CascadingKinerjaOpd::when($request->opd_search, function ($q) use ($request) {
            $q->where('opd_id', $request->opd_search);
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->when($request->type_search, function ($q) use ($request) {
            $q->where('type', $request->type_search);
        })->orderBy('year', 'desc')->paginate();
        return $this->successResponse(['cascading_kinerja_datas' => $cascading_kinerja_datas]);
    }
}
