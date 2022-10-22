<?php

namespace App\Http\Controllers\Api;

use App\Exports\DataUnitExcel;
use App\Exports\RealisasiAnggaranExport;
use App\Http\Controllers\API\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApbdAnggaranResource;
use App\Http\Resources\ARealisasiKeunganResource;
use App\Models\DataUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataUnitController extends Controller
{
    public function getApbdAnggaran(Request $request)
    {
        if ($request->year) {
            $ApbdAnggarans = DataUnit::getApbdAnggaran($request->year, $request->id_skpd);
        } else {
            $year = Carbon::now()->format('Y');
            $ApbdAnggarans = DataUnit::getApbdAnggaran($year, $request->id_skpd);
        }

        return $this->successResponse(['ApbdAnggaran' => ApbdAnggaranResource::collection($ApbdAnggarans)]);
    }
    public function getApbdAnggaranExport(Request $request)
    {
        return Excel::download(new DataUnitExcel($request), 'Anggaran APBD.xlsx');
    }
    public function getRealisasiAnggaran(Request $request)
    {
        if ($request->year) {
            $RealisasiAnggaran = DataUnit::getRealisasiAnggaran($request->year, $request->id_skpd);
        } else {
            $year = Carbon::now()->format('Y');
            $RealisasiAnggaran = DataUnit::getRealisasiAnggaran($year, $request->id_skpd);
        }
        return $this->successResponse(['RealisasiAnggaran' => ARealisasiKeunganResource::collection($RealisasiAnggaran)]);
    }
    public function getRealisasiAnggaranExport(Request $request)
    {
        return Excel::download(new RealisasiAnggaranExport($request), 'Realisasi Anggaran.xlsx');
    }
}
