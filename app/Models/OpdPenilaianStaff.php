<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPenilaianStaff extends Model
{
    use HasFactory;

    protected $fillable = ['opd_penilaian_id', 'opd_penilaian_staff_type_id', 'month_id', 'judul', 'description', 'file', 'status', 'kualitas'];

    public function opd_penilaian()
    {
        return $this->belongsTo(OpdPenilaian::class, 'opd_penilaian_id', 'id');
    }

    public function opd_penilaian_staff_type()
    {
        return $this->belongsTo(OpdPenilaianStaffType::class, 'opd_penilaian_staff_type_id', 'id');
    }

    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id', 'id');
    }
}
