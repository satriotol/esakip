<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPenilaianKinerja extends Model
{
    use HasFactory;

    protected $fillable = ['opd_penilaian_id', 'opd_category_variable_id', 'target', 'realisasi', 'capaian', 'nilai_akhir', 'status', 'user_id'];


    public function opd_penilaian()
    {
        return $this->belongsTo(OpdPenilaian::class, 'opd_penilaian_id', 'id');
    }
    public function opd_category_variable()
    {
        return $this->belongsTo(OpdCategoryVariable::class, 'opd_category_variable_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
