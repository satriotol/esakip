<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
