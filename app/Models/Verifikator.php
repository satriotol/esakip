<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Verifikator extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = ['name', 'phone', 'opd_id', 'jabatan'];
    protected $appends = ['name_jabatan'];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }
    public function getPhoneAttribute($value)
    {
        // Memeriksa apakah nomor telepon diawali dengan 0
        if (substr($value, 0, 1) === '0') {
            // Mengganti awalan 0 dengan +62
            $value = preg_replace('/^0/', '+62', $value);
        }

        return $value;
    }
    public function getNameJabatanAttribute()
    {
        return $this->name . ' | ' . $this->jabatan;
    }
}
