<?php

namespace App\Models\PerencanaanKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RktOpd extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'name', 'opd_id', 'file'];

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
}
