<?php

namespace App\Models\PerencanaanKinerja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenstraOpd extends Model
{
    use HasFactory;
    protected $fillable = ['opd_id', 'periode_renstra_opd_id', 'file'];
}
