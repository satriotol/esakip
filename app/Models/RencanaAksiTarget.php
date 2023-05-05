<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAksiTarget extends Model
{
    use HasFactory;
    protected $fillable = ['opd_perjanjian_kinerja_sasaran_id', 'file', 'rencana_aksi_id', 'target', 'realisasi', 'status', 'note', 'rencana_aksi_note', 'indikator_kinerja_note', 'satuan', 'type', 'note_verifikator', 'status_verifikator'];

    protected $appends = ['opd_perjanjian_kinerja_sasaran_name', 'capaian'];

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

    const UMUM = 'UMUM';
    const KHUSUS = 'KHUSUS';
    const TYPES = [
        self::UMUM, self::KHUSUS
    ];
    public function rencana_aksi()
    {
        return $this->belongsTo(RencanaAksi::class, 'rencana_aksi_id', 'id');
    }
    public function opd_perjanjian_kinerja_sasaran()
    {
        return $this->belongsTo(OpdPerjanjianKinerjaSasaran::class, 'opd_perjanjian_kinerja_sasaran_id', 'id');
    }
    public function getOpdPerjanjianKinerjaSasaranNameAttribute()
    {
        return $this->opd_perjanjian_kinerja_sasaran->sasaran ?? "";
    }
    public function getCapaianAttribute()
    {
        if ($this->realisasi == null) {
            return round(0, 2);
        }
        if ($this->type == self::UMUM) {
            $data = $this->realisasi / $this->target * 100;
        } else {
            $data = (1 - (($this->realisasi - $this->target)) / $this->target) * 100;
        }
        if ($data > 100) {
            $data = 100;
        } elseif ($data < 0 || $this->status_verifikator != 'DITERIMA') {
            $data = 0;
        }
        return round($data, 2);
    }
}
