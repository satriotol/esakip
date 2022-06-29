<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengukuranKinerja\IkuOpd;
use Illuminate\Http\Request;

class PengukuranKinerjaOpdController extends Controller
{
    public function getIku(Request $request)
    {
        $iku_datas = IkuOpd::when($request->year_search, function ($q) use ($request) {
            $q->where('year', 'like', "%" . $request->year_search . "%");
        })->when($request->opd_search, function ($q) use ($request) {
            $q->where('opd_id', $request->opd_search);
        })->orderBy('year')->paginate();
        return $this->successResponse(['iku_datas' => $iku_datas]);    }
    public function getPerjanjianKinerja()
    {

    }
}
