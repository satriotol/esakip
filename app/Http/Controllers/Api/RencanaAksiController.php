<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use App\Models\RencanaAksi;
use Illuminate\Http\Request;

class RencanaAksiController extends Controller
{
    public function index(Request $request)
    {
        $rencanaAksis = OpdPerjanjianKinerja::getRencanaAksiApi($request);

        return $this->successResponse(['data' => $rencanaAksis]);
    }
    public function index_v2(Request $request)
    {
        $opd_id = $request->opd_id;
        $type = $request->type;
        $name = $request->name;
        $year = $request->year;
        $rencanaAksi = RencanaAksi::query();
        if ($opd_id) {
            $rencanaAksi->whereHas('opd_perjanjian_kinerja', function ($q) use ($opd_id) {
                $q->where('opd_id', $opd_id);
            });
        } else {
            return $this->failedResponse([], "OPD Harus Terisi", 422);
        }
        if ($type == 'INDUK' || $type == 'PERUBAHAN') {
            $rencanaAksi->whereHas('opd_perjanjian_kinerja', function ($q) use ($type) {
                $q->where('type', $type);
            });
        } else {
            return $this->failedResponse([], "Type Harus Terisi, INDUK atau PERUBAHAN", 422);
        }

        if ($name) {
            $rencanaAksi->where('name', $name);
        }
        if ($year) {
            $rencanaAksi->whereHas('opd_perjanjian_kinerja', function ($q) use ($year) {
                $q->where('year', $year);
            });
        }
        $rencanaAksi = $rencanaAksi->first();
        if ($rencanaAksi == null) {
            return $this->failedResponse([], "Data Tidak Ditemukan");
        }
        $data = [
            "id" => $rencanaAksi->id,
            "opd_perjanjian_kinerja_id" => $rencanaAksi->opd_perjanjian_kinerja_id,
            "perjanjian_kinerja" => asset('uploads/' . $rencanaAksi->opd_perjanjian_kinerja->file),
            "year" => $rencanaAksi->opd_perjanjian_kinerja->year,
            "type" => $rencanaAksi->opd_perjanjian_kinerja->type,
            "name" => $rencanaAksi->name,
            "status" => $rencanaAksi->status,
            "note" => $rencanaAksi->note,
            "capaian" => $rencanaAksi->getTotalCapaian($rencanaAksi->id),
            "predikat" => $rencanaAksi->getTotalCapaianPredikat($rencanaAksi->id),
        ];

        return $this->successResponse(['data' => $data]);
    }
}
