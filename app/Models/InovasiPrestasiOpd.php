<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InovasiPrestasiOpd extends Model
{
    use HasFactory;

    protected $fillable = ['opd_id', 'inovasi_prestasi_tingkat_id', 'date', 'year', 'name', 'instansi_pemberi', 'description', 'file', 'is_verified'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
    public function inovasi_prestasi_tingkat()
    {
        return $this->belongsTo(InovasiPrestasiTingkat::class, 'inovasi_prestasi_tingkat_id', 'id');
    }
    public static function getByOpdStatus()
    {
        if (Auth::user()->opd_id) {
            $data = InovasiPrestasiOpd::where('opd_id', Auth::user()->opd_id)->where('is_verified', 1)->get();
        } else {
            $data = InovasiPrestasiOpd::where('is_verified', 1)->get();
        }
        return $data;
    }
    public function getStatus()
    {
        if ($this->is_verified == null) {
            return [
                'name' => 'Proses Verifikasi',
                'color' => 'warning',
                'enabled' => true,
            ];
        } elseif ($this->is_verified == 1) {
            return [
                'name' => 'Sudah Verifikasi',
                'color' => 'success',
                'enabled' => false,
            ];
        } else {
            return [
                'name' => 'Ditolak',
                'color' => 'danger',
                'enabled' => false,
            ];
        }
    }
}
