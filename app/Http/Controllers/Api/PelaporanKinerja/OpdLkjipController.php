<?php

namespace App\Http\Controllers\Api\PelaporanKinerja;

use App\Http\Controllers\Controller;
use App\Http\Resources\LkjipOpdCollection;
use App\Http\Resources\LkjipOpdResource;
use App\Models\PelaporanKinerja\LkjipOpd;
use Illuminate\Http\Request;

class OpdLkjipController extends Controller
{
    public function index(Request $request)
    {
        $lkjips = LkjipOpd::with('opd')->when($request->opd_search, function ($q) use ($request) {
            $q->where('opd_id', $request->opd_search);
        })->when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->orderBy('year')->paginate();
        return $this->successResponse(['lkjips_opd_data' => $lkjips]);
    }
}
