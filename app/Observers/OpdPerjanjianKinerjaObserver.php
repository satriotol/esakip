<?php

namespace App\Observers;

use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Support\Facades\Auth;

class OpdPerjanjianKinerjaObserver
{
    public function creating(OpdPerjanjianKinerja $opd_perjanjian_kinerja)
    {
        $opd_perjanjian_kinerja->created_by = Auth::user()->id;
        $opd_perjanjian_kinerja->updated_by = Auth::user()->id;
    }

    public function updating(OpdPerjanjianKinerja $opd_perjanjian_kinerja)
    {
        $opd_perjanjian_kinerja->updated_by = Auth::user()->id;
    }
}
