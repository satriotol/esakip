<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUnit extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'data_unit';
    protected $appends = ['total_anggaran','total_anggaran_pergeseran','total_anggaran_perubahan'];
    protected $hidden = ['apbd_anggarans'];


    public function apbd_anggarans()
    {
        return $this->hasMany(ApbdAnggaran::class, 'id_skpd', 'id_skpd');
    }
    public function getTotalAnggaranAttribute()
    {
        return $this->apbd_anggarans->where('tahun', 2022)->sum('anggaran');
    }
    public function getTotalAnggaranPergeseranAttribute()
    {
        return $this->apbd_anggarans->where('tahun', 2022)->sum('anggaran_pergeseran');
    }
    public function getTotalAnggaranPerubahanAttribute()
    {
        return $this->apbd_anggarans->where('tahun', 2022)->sum('anggaran_perubahan ');
    }
}
