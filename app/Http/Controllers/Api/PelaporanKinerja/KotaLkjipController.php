<?php

namespace App\Http\Controllers\Api\PelaporanKinerja;

use App\Http\Controllers\Controller;
use App\Models\PelaporanKinerja\LkjipKota;
use Illuminate\Http\Request;

class KotaLkjipController extends Controller
{
    public function index(Request $request)
    {
        $lkjips = LkjipKota::when($request->name_search, function ($q) use ($request) {
            $q->where('name', 'like', "%" . $request->name_search . "%");
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->orderBy('year', 'desc')->paginate();
        return $this->successResponse(['lkjips_kota_data' => $lkjips]);
    }
}
