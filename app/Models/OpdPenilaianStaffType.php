<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPenilaianStaffType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function opd_penilaian_staffs()
    {
        return $this->hasMany(OpdPenilaianStaff::class, 'month_id', 'id');
    }
}
