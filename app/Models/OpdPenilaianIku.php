<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPenilaianIku extends Model
{
    use HasFactory;

    protected $fillable = ['opd_penilaian_kinerja_id', 'opd_perjanjian_kinerja_indikator_id', 'type', 'capaian', 'realisasi'];
    const TYPE1 = 'UMUM';
    const TYPE2 = 'KHUSUS';
    const TYPES = [
        self::TYPE1,
        self::TYPE2,
    ];
    protected $cast = [
        'capaian' => 'float'
    ];
    public function opd_penilaian_kinerja()
    {
        return $this->belongsTo(OpdPenilaianKinerja::class, 'opd_penilaian_kinerja_id', 'id');
    }
    public function opd_perjanjian_kinerja_indikator()
    {
        return $this->belongsTo(OpdPerjanjianKinerjaIndikator::class, 'opd_perjanjian_kinerja_indikator_id', 'id');
    }
}
