<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DataUnit;
use Illuminate\Http\Request;

class DataUnitController extends Controller
{
    public function getApbdAnggaran(Request $request)
    {
        $ApbdAnggarans = DataUnit::whereHas('apbd_anggarans', function ($q) use ($request) {
            $q->where('tahun', 2022)->when($request->id_skpd, function ($sq) use ($request) {
                $sq->where('id_skpd', $request->id_skpd);
            });
        })->get();
        return $this->successResponse(['ApbdAnggaran' => $ApbdAnggarans]);
    }
    public function getRealisasAnggaran()
    {
        
    }
}
