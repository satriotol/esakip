<?php

namespace App\Models;

use App\Models\EvaluasiKinerja\EvaluasiKinerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Opd extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['nama_opd', 'opd_category_id', 'inovasi_prestasi_daerah'];

    public function evaluasi_kinerjas()
    {
        return $this->hasMany(EvaluasiKinerja::class, 'opd_id', 'id');
    }
    public function data_unit()
    {
        return $this->hasOne(DataUnit::class, 'nama_skpd', 'nama_opd');
    }
    public static function getOpd()
    {
        if (Auth::user()->opd_id) {
            return Opd::where('id', Auth::user()->opd_id)->get();
        } else {
            return Opd::all();
        }
    }
}
