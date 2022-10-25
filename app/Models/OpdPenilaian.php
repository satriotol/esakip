<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OpdPenilaian extends Model
{
    use HasFactory;
    protected $fillable = ['opd_id', 'opd_category_id', 'year', 'name', 'inovasi_prestasi_daerah'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
    public function opd_category()
    {
        return $this->belongsTo(OpdCategory::class, 'opd_category_id', 'id');
    }
    public static function getOpdPenilaian()
    {
        $opd_id = Auth::user()->opd_id;
        if ($opd_id) {
            $getOpdPenilaian = OpdPenilaian::where('opd_id', $opd_id)->paginate();
        }else{
            $getOpdPenilaian = OpdPenilaian::paginate();
        }
        return $getOpdPenilaian;
    }
    public static function ifTahunan($opd_category_id)
    {
        $ifTahunan =  OpdCategory::where('id', $opd_category_id)->first()->type == 'TAHUNAN';
        return $ifTahunan;

    }
}
