<?php

namespace App\Models\EvaluasiKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Eval_;

class EvaluasiKinerjaYear extends Model
{
    use HasFactory;
    protected $fillable = ['year'];

    public function evaluasi_kinerja()
    {
        return $this->hasMany(EvaluasiKinerja::class, 'evaluasi_kinerja_year_id', 'id');
    }

    public static function getEvaluasiKinerjaExcept()
    {
        return EvaluasiKinerjaYear::whereHas('evaluasi_kinerja.opd', function ($q) {
            $q->where('master_unit_kerja_id', '!=', 0)->where('kode_opd', '!=', 052);
        });
    }
}
