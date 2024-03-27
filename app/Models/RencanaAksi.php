<?php

namespace App\Models;

use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class RencanaAksi extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = ['name', 'opd_perjanjian_kinerja_id', 'slug', 'status', 'note', 'status_penilaian', 'nilai', 'status_verifikator', 'verifikator_id'];
    const STATUS1 = 'DIAJUKAN';
    const STATUS2 = 'DISETUJUI';
    const STATUS3 = 'DITOLAK';
    const STATUSES = [
        self::STATUS1, self::STATUS2, self::STATUS3
    ];
    const PENILAIAN1 = 'PROSES';
    const PENILAIAN2 = 'SELESAI';
    const PENILAIANS = [
        self::PENILAIAN2
    ];

    const TRIWULAN1 = 'TRIWULAN 1';
    const TRIWULAN2 = 'TRIWULAN 2';
    const TRIWULAN3 = 'TRIWULAN 3';
    const TRIWULAN4 = 'TRIWULAN 4';
    const TRIWULANS = [
        self::TRIWULAN1, self::TRIWULAN2, self::TRIWULAN3, self::TRIWULAN4,
    ];

    const PREDIKAT1 = 'ISTIMEWA';
    const PREDIKAT2 = 'BAIK';
    const PREDIKAT3 = 'BUTUH PERBAIKAN';
    const PREDIKAT4 = 'KURANG';
    const PREDIKAT5 = 'SANGAT KURANG';
    const PREDIKATS = [
        self::PREDIKAT1, self::PREDIKAT2, self::PREDIKAT3, self::PREDIKAT4, self::PREDIKAT5
    ];
    public function opd_perjanjian_kinerja()
    {
        return $this->belongsTo(OpdPerjanjianKinerja::class, 'opd_perjanjian_kinerja_id', 'id');
    }
    public function verifikator()
    {
        return $this->belongsTo(Verifikator::class, 'verifikator_id', 'id');
    }
    public function rencana_aksi_targets()
    {
        return $this->hasMany(RencanaAksiTarget::class, 'rencana_aksi_id', 'id');
    }
    public function getStatusNow()
    {
        if ($this->status == null) {
            return 'BELUM MENGISI KOMPONEN';
        } elseif($this->status == self::STATUS1){
            return 'PROSES PENGISIAN RENCANA AKSI OPD';
        } elseif ($this->status_penilaian == null) {
            return 'PROSES PENGISIAN REALISASI OPD';
        } elseif ($this->status_verifikator == null) {
            return 'PROSES VERIFIKASI';
        } else {
            return 'SELESAI';
        }
    }
    public function getStatus()
    {
        if ($this->status == null) {
            return 'STATUS PENGAJUAN : ' . $this->status = self::STATUS1;
        }
        return 'STATUS PENGAJUAN : ' . $this->status;
    }
    public function getStatusPenilaian()
    {
        $name = 'STATUS PENGISIAN : ';
        if ($this->status == self::STATUS2) {
            if ($this->status_penilaian == null) {
                return $name . $this->status_penilaian = self::PENILAIAN1;
            }
            return $name . $this->status_penilaian;
        }
        return $name . 'MENUNGGU PENGAJUAN RENCANA AKSI';
    }
    public function getStatusVerifikasi()
    {
        $name = 'STATUS VERIFIKASI : ';
        if ($this->status_penilaian == null) {
            return 'STATUS VERIFIKASI : MENUNGGU PENGISIAN';
        }
        if ($this->status_verifikator == null) {
            return 'STATUS VERIFIKASI : PROSES PENILAIAN VERIFIKATOR';
        }
        return $name . $this->status_verifikator;
    }
    public static function getTotalCapaian($rencana_aksi_id)
    {
        $data = RencanaAksiTarget::where('rencana_aksi_id', $rencana_aksi_id)->get();
        $totalRecord = $data->count();
        $totalCapaian = $data->sum('capaian');
        if ($totalRecord == 0) {
            $data = 0;
            return round($data, 2);
        }
        $data = $totalCapaian / $totalRecord;
        if ($data > 100) {
            $data = 100;
        } elseif ($data < 0) {
            $data = 0;
        }
        return round($data, 2);
    }
    public static function getByOpd()
    {
        $opd_id = Auth::user()->opd_id;
        if (Auth::user()->opd_id) {
            return static::whereHas('opd_perjanjian_kinerja', function ($q) use ($opd_id) {
                $q->where('opd_id', $opd_id);
            });
        } else {
            return static::query();
        }
    }
    public function getTotalCapaianPredikat($rencana_aksi_id)
    {
        if ($this->getTotalCapaian($rencana_aksi_id) >= 90) {
            return [
                'name' => 'ISTIMEWA',
                'color' => 'success'
            ];
        } elseif ($this->getTotalCapaian($rencana_aksi_id) >= 80) {
            return [
                'name' => 'BAIK',
                'color' => 'primary'
            ];
        } elseif ($this->getTotalCapaian($rencana_aksi_id) >= 70) {
            return [
                'name' => 'BUTUH PERBAIKAN',
                'color' => 'info'
            ];
        } elseif ($this->getTotalCapaian($rencana_aksi_id) >= 60) {
            return [
                'name' => 'KURANG',
                'color' => 'warning'
            ];
        } else {
            return [
                'name' => 'SANGAT KURANG',
                'color' => 'danger'
            ];
        }
    }
}
