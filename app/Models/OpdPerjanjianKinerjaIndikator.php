<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPerjanjianKinerjaIndikator extends Model
{
    use HasFactory;
    protected $fillable = ['opd_perjanjian_kinerja_sasaran_id', 'indikator', 'target', 'satuan'];
    public function opd_perjanjian_kinerja_sasaran()
    {
        return $this->belongsTo(OpdPerjanjianKinerjaSasaran::class, 'opd_perjanjian_kinerja_sasaran_id', 'id');
    }
}
