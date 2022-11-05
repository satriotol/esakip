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
    public function getIkuRealisasi($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $data = $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->realisasi ?? "";
        return $data;
    }
    public function getIkuType($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $data = $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->type ?? "";
        return $data;
    }
    public function getIkuCapaian($opdPenilaian, $getOpdPerjanjianKinerjaIndikator)
    {
        $data = $this->opd_penilaian_kinerjas->where('opd_penilaian_id', $opdPenilaian)->first()->opd_penilaian_ikus->where('opd_perjanjian_kinerja_indikator_id', $getOpdPerjanjianKinerjaIndikator)->first()->capaian ?? "";
        return $data;
    }
}
