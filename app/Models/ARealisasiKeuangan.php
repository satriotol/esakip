<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ARealisasiKeuangan extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'a_realisasi_keuangan';
}
