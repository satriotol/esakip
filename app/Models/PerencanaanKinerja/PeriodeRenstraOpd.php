<?php

namespace App\Models\PerencanaanKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeRenstraOpd extends Model
{
    use HasFactory;

    protected $fillable = ['start_year', 'end_year'];

    public function renstra_opds()
    {
        return $this->hasMany(RenstraOpd::class, 'periode_renstra_opd_id', 'id');
    }
}
