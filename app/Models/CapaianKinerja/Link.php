<?php

namespace App\Models\CapaianKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'title', 'image', 'description', 'type'];
    protected $appends = ['image_url'];
    const TYPE1 = 'LINK CAPAIAN KINERJA';
    const TYPE2 = 'LINK CAPAIAN IKU';
    const TYPE3 = 'LINK CAPAIAN IKD';
    const TYPE4 = 'LINK CAPAIAN PROGRAM';
    const TYPES = [
        self::TYPE1, self::TYPE2, self::TYPE3, self::TYPE4
    ];
    public function deleteFile()
    {
        Storage::disk('public_uploads')->delete($this->attributes['image']);
    }
    public function getImageUrlAttribute()
    {
        $image = env('ASSET_URL') . '/uploads/' . $this->image;
        return $image;
    }
}
