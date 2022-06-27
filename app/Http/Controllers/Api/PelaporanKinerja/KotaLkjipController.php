<?php

namespace App\Http\Controllers\Api\PelaporanKinerja;

use App\Http\Controllers\Controller;
use App\Models\PelaporanKinerja\LkjipKota;
use Illuminate\Http\Request;

class KotaLkjipController extends Controller
{
    public function index()
    {
        $lkjips = LkjipKota::paginate(1);
        return $this->successResponse(['lkjips_data' => $lkjips]);
    }
}
