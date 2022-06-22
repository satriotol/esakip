<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PerencanaanKinerjaCascadingKinerja extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'name', 'file'];

    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['file']);
    }
}
