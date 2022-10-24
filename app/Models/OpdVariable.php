<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdVariable extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bobot', 'pic'];

    const OPD = 'OPD';
    const INSPEKTORAT = 'INSPEKTORAT';
    const BAPPEDA = 'BAPPEDA';
    const STATUSES = [
        self::OPD, self::INSPEKTORAT, self::BAPPEDA
    ];

    public function opd_category_variables()
    {
        return $this->hasMany(OpdCategoryVariable::class, 'opd_variable_id', 'id');
    }
}
