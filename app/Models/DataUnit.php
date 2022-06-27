<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUnit extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'data_unit';

    public function apbd_anggarans()
    {
        return $this->hasMany(ApbdAnggaran::class, 'id_skpd', 'id_skpd');
    }
    public function a_realisasi_keuangans()
    {
        return $this->hasMany(ARealisasiKeuangan::class, 'id_skpd', 'id_skpd');
    }
}
