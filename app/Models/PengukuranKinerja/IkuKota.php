<?php

namespace App\Models\PengukuranKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class IkuKota extends Model
{
    use HasFactory;

    protected $fillable = ['file'];
    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
}
