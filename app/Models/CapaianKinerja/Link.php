<?php

namespace App\Models\CapaianKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'title', 'image', 'description'];
    protected $appends = ['image_url'];
    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['image']);
    }
    public function getImageUrlAttribute()
    {
        $image = env('ASSET_URL') .'/uploads/' . $this->image;
        return $image;
    }
}
