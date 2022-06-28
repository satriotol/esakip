<?php

namespace App\Models\PerencanaanKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class RktOpd extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'name', 'opd_id', 'file'];
    protected $appends = ['file_url', 'opd_name'];

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }
    public function getFileUrlAttribute()
    {
        $file = env('ASSET_URL') .'/uploads/' . $this->file;
        return $file;
    }
    public function getOpdNameAttribute()
    {
        return $this->opd->nama_opd ?? "";
    }
}
