<?php

namespace App\Models\PelaporanKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class LkjipOpd extends Model
{
    use HasFactory;
    protected $fillable = ['opd_id', 'year', 'file'];
    protected $appends = ['file_url', 'opd_name'];


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
        return URL::to('uploads/' . $this->file);
    }
    public function getOpdNameAttribute()
    {
        return $this->opd->nama_opd ?? "";
    }
}
