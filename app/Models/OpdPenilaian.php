<?php

namespace App\Models;

use App\Models\EvaluasiKinerja\EvaluasiKinerja;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class OpdPenilaian extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    protected $fillable = ['opd_id', 'opd_category_id', 'inovasi_prestasi_opd_id', 'year', 'name', 'inovasi_prestasi_daerah', 'status', 'note', 'opd_perjanjian_kinerja_id'];


    const STATUS1 = 'BELUM';
    const STATUS2 = 'VERIFIKASI';
    const STATUS3 = 'SELESAI';
    const STATUS4 = 'PENGEMBALIAN';
    const STATUSES = [
        self::STATUS2,
        self::STATUS3
    ];
    const STATUSESVERIF = [
        self::STATUS4,
        self::STATUS2,
        self::STATUS3,
    ];
    const STATUSBELUM = [
        self::STATUS1,
        self::STATUS4,
    ];
    const STATUSALL = [
        self::STATUS1,
        self::STATUS2,
        self::STATUS4,
        self::STATUS3,
    ];

    const TRIWULANS = [
        'TRIWULAN 1',
        'TRIWULAN 2',
        'TRIWULAN 3',
        'TRIWULAN 4',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
    public function inovasi_prestasi_opd()
    {
        return $this->belongsTo(InovasiPrestasiOpd::class, 'inovasi_prestasi_opd_id', 'id');
    }
    public function opd_category()
    {
        return $this->belongsTo(OpdCategory::class, 'opd_category_id', 'id');
    }
    public function opd_perjanjian_kinerja()
    {
        return $this->belongsTo(OpdPerjanjianKinerja::class, 'opd_perjanjian_kinerja_id', 'id');
    }
    public function opd_penilaian_staffs()
    {
        return $this->hasMany(OpdPenilaianStaff::class, 'opd_penilaian_id', 'id');
    }
    public function opd_penilaian_kinerjas()
    {
        return $this->hasMany(OpdPenilaianKinerja::class, 'opd_penilaian_id', 'id');
    }
    public function evaluasi_kinerjas()
    {
        return $this->hasMany(EvaluasiKinerja::class, 'opd_id', 'opd_id');
    }
    public static function getEvaluasiKinerja($year, $opd_id)
    {
        return EvaluasiKinerja::whereHas('evaluasi_kinerja_year', function ($q) use ($year) {
            $q->where('year', $year);
        })->where('opd_id', $opd_id)->first();
    }
    public static function getOpdPenilaian($request, $verifikasi)
    {

        $opd_id = $request->opd_id;
        $year = $request->year;
        $opd_category_id = $request->opd_category_id;
        $status = $request->status;
        if (Auth::user()->opd_id) {
            $getOpdPenilaian = OpdPenilaian::query()->where('opd_id', Auth::user()->opd_id);
        } else {
            $getOpdPenilaian = OpdPenilaian::query();
        }
        if ($opd_id) {
            $getOpdPenilaian->where('opd_id', $opd_id);
        }
        if ($year) {
            $getOpdPenilaian->where('year', $year);
        }
        if ($opd_category_id) {
            $getOpdPenilaian->where('opd_category_id', $opd_category_id);
        }
        if ($status) {
            $getOpdPenilaian->where('status', $status);
        }
        return $getOpdPenilaian->orderBy('year', 'desc');
    }
    public function checkStatusReport()
    {
        if ($this->status == self::STATUS2 || $this->status == self::STATUS3) {
            return true;
        }
        return false;
    }
    public static function getOpdPerjanjianKinerjaIndikator($opdPenilaian, $is_iku = '')
    {
        if ($is_iku == 1) {
            $datas = OpdPerjanjianKinerjaIndikator::where('is_iku', 1)->whereHas('opd_perjanjian_kinerja_sasaran', function ($q) use ($opdPenilaian) {
                $q->where('opd_perjanjian_kinerja_id', $opdPenilaian->opd_perjanjian_kinerja_id);
            })->get();
        } else {
            $datas = OpdPerjanjianKinerjaIndikator::whereHas('opd_perjanjian_kinerja_sasaran', function ($q) use ($opdPenilaian) {
                $q->where('opd_perjanjian_kinerja_id', $opdPenilaian->opd_perjanjian_kinerja_id);
            })->get();
        }
        return $datas;
    }
    public static function ifTahunan($opd_category_id)
    {
        $ifTahunan =  OpdCategory::where('id', $opd_category_id)->first()->type == 'TAHUNAN';
        return $ifTahunan;
    }

    public function realisasi($opd_category_variable_id)
    {
        $opdCategoryVariable = OpdCategoryVariable::find($opd_category_variable_id);
        $data = $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->realisasi ?? '';
        if ($opdCategoryVariable->opd_variable->pic == 'BAPENDA' && $data) {
            return 'Rp ' . (number_format((float)$data));
        } elseif ($opdCategoryVariable->opd_variable->pic == 'SIPD' && $data) {
            return 'Rp ' . (number_format((float)$data));
        } elseif ($opdCategoryVariable->opd_variable->is_p3dn && $data) {
            return 'Rp ' . (number_format((float)$data));
        } elseif ($opdCategoryVariable->opd_variable->is_iku && $data) {
            return $this->capaian($opd_category_variable_id) . ' %';
        } else {
            return $data;
        }
    }
    public function getOpdPenilaianReportValue($opd_category_variable_id)
    {
        $data = $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->opd_penilaian_report ?? '';
        return $data;
    }
    public function target($opd_category_variable_id)
    {
        $opdCategoryVariable = OpdCategoryVariable::find($opd_category_variable_id);
        $master = Master::first();
        $data = $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->target ?? '';
        if ($opdCategoryVariable->opd_variable->pic == 'BAPENDA' && $data) {
            $data = [
                'Rp ' . (number_format((float)$data))
            ];
            return $data;
        } elseif ($opdCategoryVariable->opd_variable->pic == 'SIPD' && $data) {
            $data = [
                'Rp ' . (number_format((float)$data))
            ];
            return $data;
        } elseif ($opdCategoryVariable->opd_variable->is_p3dn && $data) {
            $data = [
                'Rp ' . (number_format((float)$data))
            ];
            return $data;
        } elseif ($opdCategoryVariable->opd_variable->is_sakip) {
            $data = [
                $master->sakip,
                'disabled'
            ];
            return $data;
        } else {
            return [$data];
        }
    }
    public function capaian($opd_category_variable_id)
    {
        return $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->capaian ?? '';
    }
    public function capaianStaff()
    {
        $totalStatus = $this->opd_penilaian_staffs->where('status', 'TERIMA')->count();
        $batasStatus = 3;
        $totalKualitas = $this->opd_penilaian_staffs->sum('kualitas');
        $batasKualitas = 300;
        $opdVariableKualitas = OpdVariable::where('id', 22)->first();
        $opdVariableStatus = OpdVariable::where('id', 21)->first();
        $totalCapaianKualitas = round($totalKualitas / $batasKualitas * 100, 2);
        $totalCapaianStatus = round($totalStatus / $batasStatus * 100, 2);
        if ($totalCapaianKualitas > 100) {
            $totalCapaianKualitas = 100;
        }
        if ($totalCapaianStatus > 100) {
            $totalCapaianStatus = 100;
        }
        $data = [
            'totalStatus' => $totalStatus,
            'batasStatus' => $batasStatus,
            'batasKualitas' => $batasKualitas,
            'totalKualitas' => $totalKualitas,
            'totalCapaianKualitas' => $totalCapaianKualitas,
            'totalCapaianStatus' => $totalCapaianStatus,
            'totalNilaiAkhirKualitas' =>  round($opdVariableKualitas->bobot / 100 * $totalCapaianKualitas, 2),
            'totalNilaiAkhirStatus' =>  round($opdVariableStatus->bobot / 100 * $totalCapaianStatus, 2),
        ];
        return $data;
    }
    public function nilai_akhir($opd_category_variable_id)
    {
        return $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->nilai_akhir ?? '-';
    }
    public function getDate($opd_category_variable_id)
    {
        $data = $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last();
        $d = $data->updated_at ?? $data->created_at ?? "";
        return $d;
    }
    public function getRencanaAksi($opd_category_variable_id)
    {
        $data = $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last();
        return $data;
    }
    public function totalNilaiAkhir()
    {
        return $this->opd_penilaian_kinerjas->sum('nilai_akhir');
    }
    public function totalAkhir()
    {
        $total = $this->totalNilaiAkhir() + $this->inovasi_prestasi_daerah;
        if ($total > 100) {
            $total = 100;
        }
        return $total;
    }
    public function totalAkhirPredikat()
    {
        if ($this->totalAkhir() >= 90) {
            return [
                'name' => 'ISTIMEWA',
                'color' => 'success'
            ];
        } elseif ($this->totalAkhir() >= 80) {
            return [
                'name' => 'BAIK',
                'color' => 'primary'
            ];
        } elseif ($this->totalAkhir() >= 70) {
            return [
                'name' => 'BUTUH PERBAIKAN',
                'color' => 'info'
            ];
        } elseif ($this->totalAkhir() >= 60) {
            return [
                'name' => 'KURANG',
                'color' => 'warning'
            ];
        } else {
            return [
                'name' => 'SANGAT KURANG',
                'color' => 'danger'
            ];
        }
    }
}
