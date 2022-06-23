<?php

namespace App\Models\PerencanaanKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RenstraOpd extends Model
{
    use HasFactory;
    protected $fillable = ['opd_id', 'periode_renstra_opd_id', 'file'];

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
}
