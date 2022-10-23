<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPenilaian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
}
