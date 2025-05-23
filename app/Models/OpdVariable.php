<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdVariable extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bobot', 'pic', 'is_efisiensi', 'is_reformasi_birokrasi', 'is_sakip', 'is_iku', 'is_iku_triwulan'];
    protected $casts = [
        'is_efisiensi' => 'boolean',
    ];

    const OPD = 'OPD';
    const INSPEKTORAT = 'INSPEKTORAT';
    const BAPPEDA = 'BAPPEDA';
    const BAPENDA = 'BAPENDA';
    const SIPD = 'SIPD';
    const P3DN = 'P3DN';
    const ELEKTRONIFIKASI = 'ELEKTRONIFIKASI';
    const PICS = [
        self::OPD,
        self::INSPEKTORAT,
        self::BAPPEDA,
        self::BAPENDA,
        self::SIPD,
        self::P3DN,
        self::ELEKTRONIFIKASI
    ];

    public function opd_category_variables()
    {
        return $this->hasMany(OpdCategoryVariable::class, 'opd_variable_id', 'id');
    }
}
