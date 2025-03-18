<?php

namespace App\Repositories;

use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Support\Facades\Auth;

class OpdPerjanjianKinerjaRepository
{
    public function get($request, $opd_id = null)
    {
        $query = OpdPerjanjianKinerja::query();
        $year = $request->year;
        $tahun = $request->tahun;
        $type = $request->type;
        if ($opd_id) {
            $query->where('opd_id', $opd_id);
        }
        if (Auth::user()->opd_id) {
            $query->where('opd_id', Auth::user()->opd_id);
        }
        if ($year) {
            $query->where('year', $year);
        }
        if ($tahun) {
            $query->where('year', $tahun);
        }
        if ($type) {
            $query->where('type', $type);
        }
        return $query;
    }
}
