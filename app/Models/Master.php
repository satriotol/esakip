<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $fillable = ['reformasi_birokrasi', 'sakip', 'tahun_awal', 'tahun_awal_p3dn'];
}
