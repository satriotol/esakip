<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdCategoryVariable extends Model
{
    use HasFactory;

    protected $fillable = ['opd_category_id', 'opd_variable_id'];

    public function opd_category()
    {
        return $this->belongsTo(OpdCategory::class, 'opd_category_id', 'id');
    }
    public function opd_variable()
    {
        return $this->belongsTo(OpdVariable::class, 'opd_variable_id', 'id');
    }
}
