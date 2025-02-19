<?php

namespace App\Repositories;

use App\Models\Opd;
use Illuminate\Support\Facades\Auth;

class OpdRepository
{
    public function get($request)
    {
        $query = Opd::query();
        $opd_id = $request->opd_id;
        if (Auth::user()->opd_id) {
            $query = $query->where('id', Auth::user()->opd_id);
        }

        $query->where('master_unit_kerja_id', '!=', 0)->orderBy('nama_opd', 'asc');
        return $query;
    }
}
