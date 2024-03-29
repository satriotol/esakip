<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpdPenilaianResource;
use App\Models\Master;
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
        $kode_opd = $request->kode_opd;
        $triwulan = $request->triwulan;
        if (!$year) {
            $year = date('Y');
        }
        // if (!$name) {
        //     $name = null;
        // }
        $opdPenilaian = OpdPenilaian::where('year', $year);
        if ($opd_id) {
            $opdPenilaian->where('opd_id', $opd_id);
        } else if ($data_unit_id) {
            $opdPenilaian->whereHas('opd', function ($q) use ($data_unit_id) {
                $q->where('data_unit_id', $data_unit_id);
            });
        } else if ($kode_opd) {
            $opdPenilaian->whereHas('opd', function ($q) use ($kode_opd) {
                $q->where('kode_opd', $kode_opd);
            });
        } else {
            return $this->failedResponse([], 'Pastikan anda sudah mengisi antara (opd_id,data_unit_id,master_unit_kerja_id,kode_opd)');
        }
        if ($triwulan) {
            $opdPenilaian->where('name', $triwulan);
        } else {
            $opdPenilaian->where('name', null);
        }
        if ($opdPenilaian->count() == 0) {
            return $this->failedResponse([], 'Belum melakukan pengisian Penilaian OPD');
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
    public function getp3dn(Request $request)
    {
        $year = $request->year;
        if (!$year) {
            $year = date('Y');
        }
        $query = DB::connection('mysql2')->select("SELECT
	table_3.kode_skpd,
	table_3.nama_skpd,
	table_1.id_skpd,
	table_2.indikator,
	table_2.satuan,
	-- Optional untuk target, dapat langsung difilter by variable
	-- targetX, X diganti dengan variable yang didapatkan pada filter tahun di e-sakip
	-- Contoh tahun pilihan 2022 => 1, 2023 => 2, 2024 => 3, dst. Maka,
	-- targetX akan menjadi target1 apabila tahun yang dipilih 2022 (disesuaikan dg. kebutuhan)
		table_2.target1_anggaran AS periode_1_rpjmd,
		table_2.target2_anggaran AS periode_2_rpjmd,
		table_2.target3_anggaran AS periode_3_rpjmd,
		table_2.target4_anggaran AS periode_4_rpjmd,
		table_2.target5_anggaran AS periode_5_rpjmd,
	-- 
	table_1.triwulan1_anggaran,
	table_1.triwulan2_anggaran,
	table_1.triwulan3_anggaran,
	table_1.triwulan4_anggaran,
	table_1.updated_at
FROM
	data_capaian table_1
LEFT JOIN
	iku_pd table_2
ON table_1.id_skpd = table_2.id_skpd
LEFT JOIN
	data_unit table_3
ON table_1.id_skpd = table_3.id_skpd
WHERE 
	table_1.id_indikator=table_2.id
	AND table_1.tahun='2022'
	AND table_1.jenis='12'
ORDER BY
	table_3.kode_skpd;
        ");
        $id_skpd = $request->id_skpd;
        if ($id_skpd == null) {
            return $this->failedResponse([], "Pastikan Id SKPD anda Sudah Terisi");
        }
        $data = collect($query);
        $data = $data->where('id_skpd', $id_skpd)->first();
        // return $data;
        $master = Master::first();
        $totalYear = $year - $master->tahun_awal_p3dn;
        if ($totalYear < 0) {
            return $this->failedResponse([], "Minimal Tahun Adalah {$master->tahun_awal_p3dn}");
        }
        if ($data == null) {
            return $this->failedResponse([], "Data Yang Anda Cari Tidak Ada");
        }
        if ($totalYear == 0) {
            $target = $data->periode_1_rpjmd;
        } elseif ($totalYear = 1) {
            $target = $data->periode_2_rpjmd;
        } elseif ($totalYear = 2) {
            $target = $data->periode_3_rpjmd;
        } elseif ($totalYear = 3) {
            $target = $data->periode_4_rpjmd;
        } elseif ($totalYear = 4) {
            $target = $data->periode_5_rpjmd;
        }
        $totalTahunP3DN = $data->triwulan1_anggaran + $data->triwulan2_anggaran + $data->triwulan3_anggaran + $data->triwulan4_anggaran;
        $capaian = round($totalTahunP3DN) / round($target, 2) * 100;
        if ($capaian > 100) {
            $capaian = 100;
        }
        $data = [
            'id_skpd' => $data->id_skpd,
            'nama_skpd' => $data->nama_skpd,
            // "tahun_iku" => $data->tahun_iku,
            // "tahun_capaian" => $data->tahun_capaian,
            "indikator" => $data->indikator,
            "satuan" => $data->satuan,
            "target" => round($target, 2),
            "triwulan1" => $data->triwulan1_anggaran,
            "triwulan2" => $data->triwulan2_anggaran,
            "triwulan3" => $data->triwulan3_anggaran,
            "triwulan4" => $data->triwulan4_anggaran,
            "totalTahunP3DN" => round($totalTahunP3DN, 2),
            'capaian' => round($capaian, 2),
        ];
        return $this->successResponse(['p3dn' => $data]);
    }
}
