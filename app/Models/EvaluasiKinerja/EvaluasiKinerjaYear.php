<?php

namespace App\Models\EvaluasiKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiKinerjaYear extends Model
{
    use HasFactory;
    protected $fillable = ['year'];

    public function evaluasi_kinerja()
    {
        return $this->hasMany(EvaluasiKinerja::class, 'evaluasi_kinerja_year_id', 'id');
    }
}
