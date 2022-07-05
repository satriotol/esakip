<?php

namespace App\Models;

use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPerjanjianKinerjaSasaran extends Model
{
    use HasFactory;
    protected $fillable = ['opd_perjanjian_kinerja_id', 'sasaran'];

    public function opd_perjanjian_kinerja()
    {
        return $this->belongsTo(OpdPerjanjianKinerja::class, 'opd_perjanjian_kinerja_id', 'id');
    }
    public function opd_perjanjian_kinerja_indikators()
    {
        return $this->hasMany(OpdPerjanjianKinerjaIndikator::class, 'opd_perjanjian_kinerja_id', 'id');
    }
}
