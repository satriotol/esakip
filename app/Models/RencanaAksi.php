<?php

namespace App\Models;

use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAksi extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'opd_perjanjian_kinerja_id', 'slug', 'status', 'note'];
    const STATUS1 = 'DIAJUKAN';
    const STATUS2 = 'DISETUJUI';
    const STATUS3 = 'DITOLAK';
    const STATUS4 = 'PENILAIAN';
    const STATUSES = [
        self::STATUS1, self::STATUS2, self::STATUS3, self::STATUS4
    ];
    public function opd_perjanjian_kinerja()
    {
        return $this->belongsTo(OpdPerjanjianKinerja::class, 'opd_perjanjian_kinerja_id', 'id');
    }
    public function rencana_aksi_targets()
    {
        return $this->hasMany(RencanaAksiTarget::class, 'rencana_aksi_id', 'id');
    }
}
