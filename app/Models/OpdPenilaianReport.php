<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPenilaianReport extends Model
{
    use HasFactory;
    protected $fillable = ['opd_penilaian_kinerja_id', 'catatan', 'rekomendasi', 'user_id'];
    public function opd_penilaian_kinerja()
    {
        return $this->belongsTo(OpdPenilaianKinerja::class, 'opd_penilaian_kinerja_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
