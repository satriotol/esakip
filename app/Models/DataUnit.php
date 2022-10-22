<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public static function getApbdAnggaran($year, $id_skpd)
    {
        $dataUnit = DataUnit::whereHas('apbd_anggarans', function ($q) use ($year, $id_skpd) {
            $q->where('tahun', $year)->when($id_skpd, function ($sq) use ($id_skpd) {
                $sq->where('id_skpd', $id_skpd);
            });
        })->orderBy('nama_skpd')->get();
        return $dataUnit;
    }
}
