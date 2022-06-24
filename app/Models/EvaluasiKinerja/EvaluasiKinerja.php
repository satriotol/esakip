<?php

namespace App\Models\EvaluasiKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiKinerja extends Model
{
    use HasFactory;

    protected $fillable = ['evaluasi_kinerja_year_id', 'value', 'opd_id'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }
    public function evaluasi_kinerja_year()
    {
        return $this->belongsTo(EvaluasiKinerjaYear::class, 'evaluasi_kinerja_year_id');
    }
}
