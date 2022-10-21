<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'reformasi_birokrasi', 'sakip', 'penyerapan_anggaran_belanja', 'realisasi_target_pendapatan', 'p3dn', 'inovasi_prestasi_daerah'];

    public function opds()
    {
        return $this->hasMany(Opd::class, 'opd_id', 'id');
    }
}
