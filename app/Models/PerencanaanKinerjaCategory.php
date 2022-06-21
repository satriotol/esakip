<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerencanaanKinerjaCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'title', 'type', 'show', 'download'];
}
