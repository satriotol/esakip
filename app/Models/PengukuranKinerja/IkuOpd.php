<?php

namespace App\Models\PengukuranKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class IkuOpd extends Model
{
    use HasFactory;
    protected $fillable = ['year', 'opd_id', 'file'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
}
