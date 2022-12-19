<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpdPenilaianResource;
use App\Models\OpdPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpdPenilaianController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->year;
        $name = $request->name;
        $opd_id = $request->opd_id;
        $data_unit_id = $request->data_unit_id;
        $master_unit_kerja_id = $request->master_unit_kerja_id;
        if (!$year) {
            $year = date('Y');
        }
        if (!$name) {
            $name = null;
        }
        $opdPenilaian = OpdPenilaian::where('year', $year)->where('name', $name);
        if ($opd_id) {
            $opdPenilaian->where('opd_id', $opd_id);
        } else if ($data_unit_id) {
            $opdPenilaian->whereHas('opd', function ($q) use ($data_unit_id) {
                $q->where('data_unit_id', $data_unit_id);
            });
        } else if ($master_unit_kerja_id) {
            $opdPenilaian->whereHas('opd', function ($q) use ($master_unit_kerja_id) {
                $q->where('master_unit_kerja_id', $master_unit_kerja_id);
            });
        } else {
            return $this->failedResponse([], 'Pastikan anda sudah mengisi antara (opd_id,data_unit_id,master_unit_kerja_id)');
        }
        if ($opdPenilaian->first() == null) {
            return $this->failedResponse([], 'Data Yang Anda Cari Tidak Ditemukan');
        }
        return $this->successResponse(['opdPenilaians' => new OpdPenilaianResource($opdPenilaian->first())]);
    }
    public function getPenyerapanAnggaranBelanja(Request $request)
    {
        $year = $request->year;
        if (!$year) {
            $year = date('Y');
        }
        $type = $request->type;
        if ($type == null) {
        }
        if ($type === 'INDUK') {
            $type = 'anggaran';
        } elseif ($type === 'PERUBAHAN') {
            $type = 'anggaran_perubahan';
        } else {
            return $this->failedResponse([], 'Pilih INDUK atau PERUBAHAN');
        }
        $query = DB::connection('mysql2')->select("SELECT 
        table_3.kode_skpd,
        table_3.nama_skpd,
        table_1.id_skpd,
        table_1.target,
        table_2.realisasi
        FROM (
            SELECT 
            id_skpd, 
            SUM($type) AS target
            FROM 
            apbd_anggaran 
            WHERE 
            tahun = '$year' 
            GROUP BY 
            id_skpd
        ) table_1
        INNER JOIN (
            SELECT 
            id_skpd, 
            SUM(jml_realisasi) AS  realisasi
            FROM 
            a_realisasi_keuangan_developing 
            WHERE 
            tahun = '$year' 
            GROUP BY 
            id_skpd
        ) table_2
            ON table_1.id_skpd=table_2.id_skpd
        LEFT JOIN
            data_unit table_3
            ON table_1.id_skpd=table_3.id_skpd
        ORDER BY
            table_3.kode_skpd ASC;
        ");
        $id_skpd = $request->id_skpd;
        $data = collect($query);
        if ($id_skpd) {
            $data = $data->where('id_skpd', $id_skpd)->first();
        }
        return $this->successResponse(['penyerapanAnggaranBelanjas' => $data]);
    }
}
