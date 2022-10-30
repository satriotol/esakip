<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OpdPenilaian extends Model
{
    use HasFactory;
    protected $fillable = ['opd_id', 'opd_category_id', 'year', 'name', 'inovasi_prestasi_daerah'];

    protected $appends = ['capaian'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
    public function opd_category()
    {
        return $this->belongsTo(OpdCategory::class, 'opd_category_id', 'id');
    }
    public static function getOpdPenilaian()
    {
        $opd_id = Auth::user()->opd_id;
        if ($opd_id) {
            $getOpdPenilaian = OpdPenilaian::where('opd_id', $opd_id)->paginate();
        } else {
            $getOpdPenilaian = OpdPenilaian::paginate();
        }
        return $getOpdPenilaian;
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
        if ($opdCategoryVariable->opd_variable->pic == 'BAPENDA') {
            return 'Rp ' .(number_format((float)$this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->realisasi ?? ''));
        } else {
            return $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->realisasi ?? '';
        }
    }
    public function target($opd_category_variable_id)
    {
        $opdCategoryVariable = OpdCategoryVariable::find($opd_category_variable_id);
        if ($opdCategoryVariable->opd_variable->pic == 'BAPENDA') {
            return 'Rp ' . (number_format((float)$this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->target ?? ''));
        } else {
            return $this->opd_penilaian_kinerjas->where('opd_category_variable_id', $opd_category_variable_id)->last()->target ?? '';
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
    public function totalNilaiAkhir()
    {
        return $this->opd_penilaian_kinerjas->sum('nilai_akhir');
    }
    public function totalAkhir()
    {
        return $this->totalNilaiAkhir() + $this->inovasi_prestasi_daerah;
    }
}
