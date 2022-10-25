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
    const BAPENDA = 'BAPENDA';
    const SIPD = 'SIPD';
    const PICS = [
        self::OPD, self::INSPEKTORAT, self::BAPPEDA, self::BAPENDA, self::SIPD
    ];

    public function opd_category_variables()
    {
        return $this->hasMany(OpdCategoryVariable::class, 'opd_variable_id', 'id');
    }
}
