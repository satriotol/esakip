<?php

namespace App\Repositories;

use App\Models\OpdPenilaian;
use Illuminate\Support\Facades\Auth;

class OpdPenilaianRepository
{
    public function get($request)
    {
        $query = OpdPenilaian::query();
        $opd_id = $request->opd_id;
        $year = $request->year ?? date('Y');
        if (Auth::user()->opd_id) {
            $query = $query->where('opd_id', Auth::user()->opd_id);
        } elseif ($opd_id) {
            $query = $query->where('opd_id', $opd_id);
        }

        if ($year) {
            $query = $query->where('year', $year);
        }
        return $query;
    }
}
