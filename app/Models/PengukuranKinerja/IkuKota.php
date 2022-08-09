<?php

namespace App\Models\PengukuranKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class IkuKota extends Model
{
    use HasFactory;

    protected $fillable = ['file', 'year'];
    protected $appends = ['file_url'];
    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
    public function getFileUrlAttribute()
    {
        $file = env('ASSET_URL') . '/uploads/' . $this->file;
        return $file;
    }
}
