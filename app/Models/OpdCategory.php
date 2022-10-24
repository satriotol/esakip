<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];
    protected $appends = ['total_bobot'];
    const TRIWULAN = 'TRIWULAN';
    const TAHUNAN = 'TAHUNAN';
    const TYPES = [
        self::TRIWULAN, self::TAHUNAN
    ];
    public function opd_category_variables()
    {
        return $this->hasMany(OpdCategoryVariable::class, 'opd_category_id', 'id');
    }
    public function getTotalBobotAttribute()
    {
        return $this->opd_category_variables->sum('opd_variable.bobot');
    }
}
