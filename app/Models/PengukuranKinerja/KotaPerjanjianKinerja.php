<?php

namespace App\Models\PengukuranKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class KotaPerjanjianKinerja extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'name', 'file'];

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
}
