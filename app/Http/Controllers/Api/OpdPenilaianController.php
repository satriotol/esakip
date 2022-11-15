<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpdPenilaianResource;
use App\Models\OpdPenilaian;
use Illuminate\Http\Request;

class OpdPenilaianController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->year;
        $name = $request->name;
        if (!$year) {
            $year = date('Y');
        }
        if (!$name) {
            $name = null;
        }
        $opdPenilaian = OpdPenilaian::where('opd_id', $request->opd_id)->where('year', $year)->where('name', $name)->first();
        if ($opdPenilaian == null) {
            return $this->failedResponse([], 'Data Yang Anda Cari Tidak Ditemukan');
        }
        return $this->successResponse(['opdPenilaians' => new OpdPenilaianResource($opdPenilaian)]);
    }
}
