<?php

namespace App\Models\PerngukuranKinerja;

use App\Blameable;
use App\Models\Master;
use App\Models\Opd;
use App\Models\OpdPenilaian;
use App\Models\OpdPerjanjianKinerjaProgramAnggaran;
use App\Models\OpdPerjanjianKinerjaSasaran;
use App\Models\RencanaAksi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OpdPerjanjianKinerja extends Model
{
    use HasFactory, Blameable;

    protected $fillable = ['year', 'opd_id', 'file', 'type', 'status', 'note'];
    protected $appends = ['file_url', 'opd_name', 'total_anggaran'];

    const TYPE = [
        'INDUK', 'PERUBAHAN'
    ];
    const STATUS1 = 'DIAJUKAN';
    const STATUS2 = 'DITERIMA';
    const STATUS3 = 'DITOLAK';
    const STATUSES = [
        self::STATUS1, self::STATUS2, self::STATUS3
    ];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('year', 'desc')->orderBy('opd_id', 'asc');
        });
    }
    public function opd_penilaians()
    {
        return $this->hasMany(OpdPenilaian::class, 'opd_perjanjian_kinerja_id', 'id');
    }
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }
    public function opd_perjanjian_kinerja_sasarans()
    {
        return $this->hasMany(OpdPerjanjianKinerjaSasaran::class, 'opd_perjanjian_kinerja_id', 'id');
    }
    public function opd_perjanjian_kinerja_program_anggarans()
    {
        return $this->hasMany(OpdPerjanjianKinerjaProgramAnggaran::class, 'opd_perjanjian_kinerja_id', 'id');
    }

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
    public function getFileUrlAttribute()
    {
        $file = env('ASSET_URL') . '/uploads/' . $this->file;
        return $file;
    }
    public function getOpdNameAttribute()
    {
        return $this->opd->nama_opd ?? "";
    }
    public function getTotalAnggaranAttribute()
    {
        return $this->opd_perjanjian_kinerja_program_anggarans->sum('anggaran') ?? 0;
    }
    public function rencana_aksis()
    {
        return $this->hasMany(RencanaAksi::class, 'opd_perjanjian_kinerja_id', 'id');
    }
    public static function getPerjanjianKinerjas()
    {
        if (Auth::user()->opd_id) {
            return OpdPerjanjianKinerja::where('opd_id', Auth::user()->opd_id)->get();
        } else {
            return OpdPerjanjianKinerja::all();
        }
    }
    public static function getRencanaAksi($request)
    {
        $opd_id = $request->opd_id;
        $year = $request->year;

        if (Auth::user()->opd_id) {
            $opdPerjanjianKinerjas = OpdPerjanjianKinerja::has('rencana_aksis')->where('status', OpdPerjanjianKinerja::STATUS2)->where('opd_id', Auth::user()->opd_id);
            if ($year) {
                $opdPerjanjianKinerjas->where('year', $year);
            }
            return $opdPerjanjianKinerjas;
        } else {
            $opdPerjanjianKinerjas = OpdPerjanjianKinerja::has('rencana_aksis')->where('status', OpdPerjanjianKinerja::STATUS2);
            if ($opd_id) {
                $opdPerjanjianKinerjas->where('opd_id', $opd_id);
            }
            if ($year) {
                $opdPerjanjianKinerjas->where('year', $year);
            }
            return $opdPerjanjianKinerjas;
        }
    }
    public static function getRencanaAksiApi($request)
    {
        $opd_id = $request->opd_id;
        $year = (int)$request->year;
        $paginate = $request->paginate;
        $opdPerjanjianKinerjas = OpdPerjanjianKinerja::with('rencana_aksis.rencana_aksi_targets')->where('status', OpdPerjanjianKinerja::STATUS2);
        if ($opd_id) {
            $opdPerjanjianKinerjas->where('opd_id', $opd_id);
        }
        if ($year) {
            $opdPerjanjianKinerjas->where('year', $year);
        }
        if ($paginate) {
            return $opdPerjanjianKinerjas->paginate($paginate);
        }
        return $opdPerjanjianKinerjas->get();
    }
    public static function getTotalTahun($opdPerjanjianKinerja)
    {
        $tahun_awal = Master::first()->tahun_awal;
        $yearNow = $opdPerjanjianKinerja->year;
        $totalTahun = $yearNow - $tahun_awal;
        return $totalTahun;
    }
}
