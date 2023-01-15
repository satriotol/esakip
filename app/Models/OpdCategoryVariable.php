<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdCategoryVariable extends Model
{
    use HasFactory;

    protected $fillable = ['opd_category_id', 'opd_variable_id'];

    public function opd_category()
    {
        return $this->belongsTo(OpdCategory::class, 'opd_category_id', 'id');
    }
    public function opd_variable()
    {
        return $this->belongsTo(OpdVariable::class, 'opd_variable_id', 'id');
    }
    public function opd_penilaian_kinerjas()
    {
        return $this->hasMany(OpdPenilaianKinerja::class, 'opd_category_variable_id', 'id');
    }
    public function getOpdPenilaian($opdPenilaian)
    {
        $opdPenilaianKinerja = $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first() ?? '';
        return $opdPenilaianKinerja;
    }
    public function getIkuRealisasi($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $opdPenilaianIku =  $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus ?? "";
        if ($opdPenilaianIku) {
            $data = $opdPenilaianIku->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->realisasi ?? "";
            return $data;
        }
        return $opdPenilaianIku;
    }
    public function getIkuType($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $opdPenilaianIku =  $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus ?? "";
        if ($opdPenilaianIku) {
            $data = $opdPenilaianIku->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->type ?? "";
            return $data;
        }
        return $opdPenilaianIku;
    }
    public function getIkuCapaian($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $opdPenilaianIku =  $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus ?? "";
        if ($opdPenilaianIku) {
            $data = $opdPenilaianIku->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->capaian ?? "";
            return $data;
        }
        return $opdPenilaianIku;
    }
    public function getIkuNote($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $opdPenilaianIku =  $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus ?? "";
        if ($opdPenilaianIku) {
            $data = $opdPenilaianIku->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->note ?? "";
            return $data;
        }
        return $opdPenilaianIku;
    }
    public function getIkuIsVerified($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $opdPenilaianIku =  $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus ?? "";
        if ($opdPenilaianIku) {
            $data = $opdPenilaianIku->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->is_verified ?? "";
            return $data;
        }
        return $opdPenilaianIku;
    }
    public function getIkuFile($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $opdPenilaianIku =  $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus ?? "";
        if ($opdPenilaianIku) {
            $data = $opdPenilaianIku->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->file ?? "";
            return $data;
        }
        return $opdPenilaianIku;
    }
}
