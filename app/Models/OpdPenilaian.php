<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OpdPenilaian extends Model
{
    use HasFactory;
    protected $fillable = ['opd_id', 'opd_category_id', 'year', 'name', 'inovasi_prestasi_daerah', 'status', 'note'];


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
    const STATUSALL = [
        self::STATUS1,
        self::STATUS2,
        self::STATUS4,
        self::STATUS3,
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
    public function opd_category()
    {
        return $this->belongsTo(OpdCategory::class, 'opd_category_id', 'id');
    }
    public static function getOpdPenilaian($request)
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
        return $getOpdPenilaian->orderBy('year', 'desc')->paginate();
    }
    public static function ifTahunan($opd_category_id)
    {
        $ifTahunan =  OpdCategory::where('id', $opd_category_id)->first()->type == 'TAHUNAN';
        return $ifTahunan;
    }
    public function opd_penilaian_kinerjas()
    {
        return $this->hasMany(OpdPenilaianKinerja::class, 'opd_penilaian_id', 'id');
    }
    public function realisasi($opd_category_variable_id)
    {
        $opdCategoryVariable = OpdCategoryVariable::find($opd_category_variable_id);
        $data = $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->realisasi ?? '';
        if ($opdCategoryVariable->opd_variable->pic == 'BAPENDA' && $data) {
            return 'Rp ' . (number_format((float)$data));
        } else {
            return $data;
        }
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
        } elseif ($opdCategoryVariable->opd_variable->is_reformasi_birokrasi) {
            $data = [
                $master->reformasi_birokrasi,
                'disabled'
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
    public function totalNilaiAkhir()
    {
        return $this->opd_penilaian_kinerjas->sum('nilai_akhir');
    }
    public function totalAkhir()
    {
        return $this->totalNilaiAkhir() + $this->inovasi_prestasi_daerah;
    }
}
