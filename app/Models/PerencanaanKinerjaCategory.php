<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerencanaanKinerjaCategory extends Model
{
    use HasFactory;

    const TYPE = ['LIST', 'SINGLE_FILE_PDF'];

    protected $fillable = ['name', 'perencanaan_kinerja_id', 'title', 'type', 'show', 'download'];
}
