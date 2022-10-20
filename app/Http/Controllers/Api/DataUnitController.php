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
        if ($request->year) {
            $ApbdAnggarans = DataUnit::getDataUnitNow($request->year, $request->id_skpd);
        } else {
            $year = Carbon::now()->format('Y');
            $ApbdAnggarans = DataUnit::getDataUnitNow($year, $request->id_skpd);
        }

        return $this->successResponse(['ApbdAnggaran' => ApbdAnggaranResource::collection($ApbdAnggarans)]);
    }
    public function getApbdAnggaranExport()
    {
    }
    public function getRealisasiAnggaran(Request $request)
    {
        if ($request->year) {
            $year = $request->year;
            $RealisasiAnggaran = DataUnit::whereHas('a_realisasi_keuangans', function ($q) use ($request, $year) {
                $q->where('tahun', $year)->when($request->id_skpd, function ($sq) use ($request) {
                    $sq->where('id_skpd', $request->id_skpd);
                });
            })->orderBy('nama_skpd')->get();
        } else {
            $year = Carbon::now()->format('Y');
            $RealisasiAnggaran = DataUnit::whereHas('a_realisasi_keuangans', function ($q) use ($request, $year) {
                $q->where('tahun', $year)->when($request->id_skpd, function ($sq) use ($request) {
                    $sq->where('id_skpd', $request->id_skpd);
                });
            })->orderBy('nama_skpd')->get();
        }
        return $this->successResponse(['RealisasiAnggaran' => ARealisasiKeunganResource::collection($RealisasiAnggaran)]);
    }
}
