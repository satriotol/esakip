<?php

namespace App\Models\PerencanaanKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CascadingKinerjaOpd extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'opd_id', 'file', 'type'];

    const TYPE = [
        'INDUK', 'PERUBAHAN'
    ];
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
}
