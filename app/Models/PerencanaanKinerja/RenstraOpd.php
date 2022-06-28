<?php

namespace App\Models\PerencanaanKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class RenstraOpd extends Model
{
    use HasFactory;
    protected $fillable = ['opd_id', 'periode_renstra_opd_id', 'file'];
    protected $appends = ['file_url', 'opd_name', 'year'];

    public function periode_renstra_opd()
    {
        return $this->belongsTo(PeriodeRenstraOpd::class, 'periode_renstra_opd_id', 'id');
    }
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
    public function getFileUrlAttribute()
    {
        $file = env('ASSET_URL') . 'uploads/' . $this->file;
        return $file;
    }
    public function getOpdNameAttribute()
    {
        return $this->opd->nama_opd ?? "";
    }
    public function getYearAttribute()
    {
        $start_year = $this->periode_renstra_opd->start_year;
        $end_year = $this->periode_renstra_opd->end_year;
        $period_year = $start_year . '-' . $end_year;
        return $period_year;
    }
}
