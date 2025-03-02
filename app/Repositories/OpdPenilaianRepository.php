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
        $year = $request->year;
        $opd_category_id = $request->opd_category_id;
        $status = $request->status;
        $triwulan = $request->triwulan;

        if (Auth::user()->opd_id) {
            $query = $query->where('opd_id', Auth::user()->opd_id);
        } elseif ($opd_id) {
            $query = $query->where('opd_id', $opd_id);
        }
        if ($opd_category_id) {
            $query->where('opd_category_id', $opd_category_id);
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($triwulan && $triwulan != 'TAHUNAN') {
            $query->where('name', $triwulan);
        } elseif ($triwulan == 'TAHUNAN') {
            $query->where('name', null);
        }


        if ($year) {
            $query = $query->where('year', $year);
        }
        return $query;
    }
}
