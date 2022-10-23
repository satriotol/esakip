<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OpdPenilaian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }

    public static function getOpdPenilaian()
    {
        if (Auth::user()->opd_id) {
            $opdPenialaians = OpdPenilaian::where('opd_id', Auth::user()->opd_id)->paginate();
        } else {
            $opdPenialaians = OpdPenilaian::paginate();
        }
        return $opdPenialaians;
    }
}
