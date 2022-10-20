<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAksiTarget extends Model
{
    use HasFactory;
    protected $fillable = ['opd_perjanjian_kinerja_sasaran_id', 'rencana_aksi_id', 'target', 'realisasi', 'status', 'note', 'rencana_aksi_note'];

    protected $appends = ['opd_perjanjian_kinerja_sasaran_name'];

    const STATUS1 = 'DIAJUKAN';
    const STATUS2 = 'DIATAS';
    const STATUS3 = 'DIBAWAH';
    const STATUSES = [
        self::STATUS1, self::STATUS2, self::STATUS3
    ];
    const REALISASI1 = 'KUANTITATIF';
    const REALISASI2 = 'KUALITATIF';
    const REALISASIS = [
        self::REALISASI1, self::REALISASI2
    ];
    public function rencana_aksi()
    {
        return $this->belongsTo(RencanaAksi::class, 'rencana_aksi_id', 'id');
    }
    public function opd_perjanjian_kinerja_sasaran()
    {
        return $this->belongsTo(OpdPerjanjianKinerjaSasaran::class, 'opd_perjanjian_kinerja_sasaran_id', 'id');
    }
    public function getOpdPerjanjianKinerjaSasaranNameAttribute(){
        return $this->opd_perjanjian_kinerja_sasaran->sasaran;
    }
}
