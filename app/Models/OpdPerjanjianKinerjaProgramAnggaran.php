<?php

namespace App\Models;

use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPerjanjianKinerjaProgramAnggaran extends Model
{
    use HasFactory;

    protected $fillable = ['opd_perjanjian_kinerja_id', 'program', 'anggaran', 'keterangan'];

    public function opd_perjanjian_kinerja()
    {
        return $this->belongsTo(OpdPerjanjianKinerja::class, 'opd_perjanjian_kinerja_id', 'id');
    }
}
