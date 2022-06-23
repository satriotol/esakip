<?php

namespace App\Models\PerencanaanKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RenjaOpd extends Model
{
    use HasFactory;
    const TYPE = [
        'INDUK', 'PERUBAHAN'
    ];
    protected $fillable = ['year', 'opd_id', 'type', 'file', 'name'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
}
