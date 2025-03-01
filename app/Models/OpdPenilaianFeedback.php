<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPenilaianFeedback extends Model
{
    use HasFactory;
    protected $table = 'opd_penilaian_feedbacks';

    protected $fillable = [
        'opd_penilaian_id',
        'user_id',
        'feedback',
    ];

    public function opd_penilaian()
    {
        return $this->belongsTo(OpdPenilaian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
