<?php

namespace App\Models\EvaluasiKinerja;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiKinerja extends Model
{
    use HasFactory;

    protected $fillable = ['evaluasi_kinerja_year_id', 'value', 'opd_id'];

    protected $appends = ['category_name', 'opd_name'];

    public function getCategoryNameAttribute()
    {
        if ($this->value == null) {
            $data = [
                'name' => '-',
                'color' => '-',
                'font_color' => '-'
            ];
        } else if ($this->value <= 60) {
            $data = [
                'name' => 'CC',
                'color' => '#F7FF00',
                'font_color' => 'black'
            ];
        } else if ($this->value <= 70) {
            $data = [
                'name' => 'B',
                'color' => '#41bd19',
                'font_color' => 'white'
            ];
        } else if ($this->value <= 80) {
            $data = [
                'name' => 'BB',
                'color' => '#238b01',
                'font_color' => 'white'
            ];
        } else if ($this->value <= 90) {
            $data = [
                'name' => 'A',
                'color' => '#1fb8e5',
                'font_color' => 'white'
            ];
        }
        return $data;
    }

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }
    public function evaluasi_kinerja_year()
    {
        return $this->belongsTo(EvaluasiKinerjaYear::class, 'evaluasi_kinerja_year_id');
    }
    public function getOpdNameAttribute()
    {
        return $this->opd->nama_opd;
    }
}
