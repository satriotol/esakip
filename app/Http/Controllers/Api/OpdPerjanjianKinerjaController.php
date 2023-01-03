<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpdPerjanjianKinerjaResource;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpdPerjanjianKinerjaController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id;
        $nama_opd = $request->nama_opd;
        $kode_opd = $request->kode_opd;
        $type = $request->type;
        $year = $request->year;
        $limit = $request->input('limit');

        if ($id) {
            $perjanjian_kinerja = OpdPerjanjianKinerja::find($id);
            if ($perjanjian_kinerja == null) {
                return $this->failedResponse([], 'Oops, Data Tidak Ditemukan');
            }
            return $this->successResponse(['perjanjian_kinerja' => new OpdPerjanjianKinerjaResource($perjanjian_kinerja)]);
        }
        $perjanjian_kinerja = OpdPerjanjianKinerja::query();


        if ($kode_opd) {
            $perjanjian_kinerja->whereHas('opd', function ($q) use ($kode_opd) {
                $q->where('kode_opd', $kode_opd);
            });
        }
        if ($type) {
            $perjanjian_kinerja->where('type', $type);
        }
        if ($year) {
            $perjanjian_kinerja->where('year', $year);
        }
        if ($perjanjian_kinerja->first() == null) {
            return $this->failedResponse([], 'Oops, ada yang salah, Pastikan Kode OPD, Tipe, & Tahun Yang Anda Masukkan Benar');
        }
        return $this->successResponse(['perjanjian_kinerja' => new OpdPerjanjianKinerjaResource($perjanjian_kinerja->first())]);
    }
    public function getProgramAnggaran(Request $request)
    {
        $year = $request->year;
        if (!$year) {
            $year = date('Y');
        }
        $id_skpd = $request->id_skpd;
        if (!$id_skpd) {
            return $this->failedResponse([], 'OPD Harus Diisi');
        }
        $query = DB::connection('mysql2')->select("SELECT 
        table_5.kode_skpd, 
        table_5.nama_skpd,
        table_1.id_skpd, 
        table_4.kode AS kode_program, 
        table_4.uraian AS program, 
        SUM(table_1.anggaran) AS anggaran_induk, 
        SUM(table_1.anggaran_perubahan) AS anggaran_perubahan
    FROM 
        apbd_anggaran table_1
        LEFT JOIN tampung_exel_subkegiatan table_2 ON table_2.id = table_1.id_subkegiatan 
        LEFT JOIN tampung_exel_kegiatan table_3 ON table_3.id = table_2.id_kegiatan 
        LEFT JOIN tampung_exel_program table_4 ON table_4.id = table_3.id_program 
        LEFT JOIN data_unit table_5 ON table_5.id_skpd = table_1.id_skpd 
    WHERE 
        table_1.tahun = $year AND 
        table_1.id_skpd = $id_skpd
    GROUP BY 
        table_1.id_skpd,
        table_4.id 
    ORDER BY 
        table_5.kode_skpd, 
        table_4.kode ASC;
    ");
        $data = collect($query);
        return $this->successResponse(['programAnggarans' => $data]);
    }
}
