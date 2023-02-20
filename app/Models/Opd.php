<?php

namespace App\Models;

use App\Models\EvaluasiKinerja\EvaluasiKinerja;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class Opd extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['nama_opd', 'kode_opd', 'opd_category_id', 'inovasi_prestasi_daerah', 'data_unit_id', 'master_unit_kerja_id'];

    public function evaluasi_kinerjas()
    {
        return $this->hasMany(EvaluasiKinerja::class, 'opd_id', 'id');
    }
    public function data_unit()
    {
        return $this->belongsTo(DataUnit::class, 'data_unit_id', 'id_skpd');
    }
    public static function getOpd()
    {
        if (Auth::user()->opd_id) {
            return Opd::where('id', Auth::user()->opd_id)->get();
        } else {
            return Opd::all();
        }
    }
    public static function getOpdExcept()
    {
        return Opd::where('master_unit_kerja_id', '!=', 0)->get();
    }
    public function inovasi_prestasi_opds()
    {
        return $this->hasMany(InovasiPrestasiOpd::class, 'inovasi_prestasi_opd_id', 'id');
    }
    public static function opdWithoutPerjanjianKinerjas($request)
    {
        $opdWithoutPerjanjianKinerjas = Opd::where('master_unit_kerja_id', '!=', 0);
        $year = $request->year;
        $type = $request->type;
        if ($type && $year) {
            $opdWithoutPerjanjianKinerjas->whereDoesntHave('opd_perjanjian_kinerjas', function ($q) use ($type, $year) {
                $q->where('type', $type)->where('year', $year);
            });
        } elseif ($year) {
            $opdWithoutPerjanjianKinerjas->whereDoesntHave('opd_perjanjian_kinerjas', function ($q) use ($year) {
                $q->where('year', $year);
            });
        } else {
            $opdWithoutPerjanjianKinerjas->whereDoesntHave('opd_perjanjian_kinerjas', function ($q) use ($year) {
                $q->where('year', Date::now());
            });
        }

        return $opdWithoutPerjanjianKinerjas->get();
    }
    public function opd_perjanjian_kinerjas()
    {
        return $this->hasMany(OpdPerjanjianKinerja::class, 'opd_id', 'id');
    }
}
