<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InovasiPrestasiOpd extends Model
{
    use HasFactory;

    protected $fillable = ['opd_id', 'inovasi_prestasi_tingkat_id', 'date', 'year', 'name', 'instansi_pemberi', 'description', 'file', 'is_verfied'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
}
