<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerencanaanKinerjaRkpd;
use Illuminate\Http\Request;

class PerencanaanKinerjaKotaController extends Controller
{
    public function getRkpd(Request $request)
    {
        $rkpds = PerencanaanKinerjaRkpd::when($request->name_search, function ($q) use ($request) {
            $q->where('name', 'like', "%" . $request->name_search . "%");
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->paginate();

        return $this->successResponse(['rkpd_datas' => $rkpds]);
    }
}
