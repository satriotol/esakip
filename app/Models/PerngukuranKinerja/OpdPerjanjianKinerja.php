<?php

namespace App\Models\PerngukuranKinerja;

use App\Blameable;
use App\Models\Opd;
use App\Models\OpdPerjanjianKinerjaProgramAnggaran;
use App\Models\OpdPerjanjianKinerjaSasaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class OpdPerjanjianKinerja extends Model
{
    use HasFactory, Blameable;

    protected $fillable = ['year', 'opd_id', 'file', 'type'];
    protected $appends = ['file_url', 'opd_name', 'total_anggaran'];

    const TYPE = [
        'INDUK', 'PERUBAHAN'
    ];
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
}
