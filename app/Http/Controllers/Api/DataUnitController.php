<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApbdAnggaranResource;
use App\Http\Resources\ARealisasiKeunganResource;
use App\Models\DataUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataUnitController extends Controller
{
    public function getApbdAnggaran(Request $request)
    {
        $year = Carbon::now()->format('Y');
        $ApbdAnggarans = DataUnit::whereHas('apbd_anggarans', function ($q) use ($request, $year) {
            $q->where('tahun', $year)->when($request->id_skpd, function ($sq) use ($request) {
                $sq->where('id_skpd', $request->id_skpd);
            });
        })->orderBy('nama_skpd')->get();
        return $this->successResponse(['ApbdAnggaran' => ApbdAnggaranResource::collection($ApbdAnggarans)]);
    }
    public function getRealisasiAnggaran(Request $request)
    {
        $year = Carbon::now()->format('Y');
        $RealisasiAnggaran = DataUnit::whereHas('a_realisasi_keuangans', function ($q) use ($request, $year) {
            $q->where('tahun', $year)->when($request->id_skpd, function ($sq) use ($request) {
                $sq->where('id_skpd', $request->id_skpd);
            });
        })->orderBy('nama_skpd')->get();
        return $this->successResponse(['RealisasiAnggaran' => ARealisasiKeunganResource::collection($RealisasiAnggaran)]);
    }
}
