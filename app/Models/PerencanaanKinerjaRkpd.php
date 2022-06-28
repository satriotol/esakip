<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class PerencanaanKinerjaRkpd extends Model
{
    use HasFactory;
    protected $fillable = ['year', 'name', 'file'];
    protected $appends = ['file_url'];

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
    public function getFileUrlAttribute()
    {
        return URL::to('uploads/' . $this->file);
    }
}
