<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];
    const TRIWULAN = 'TRIWULAN';
    const TAHUNAN = 'TAHUNAN';
    const STATUSES = [
        self::TRIWULAN, self::TAHUNAN
    ];
}
