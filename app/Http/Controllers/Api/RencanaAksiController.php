<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use App\Models\RencanaAksi;
use Illuminate\Http\Request;

class RencanaAksiController extends Controller
{
    public function index(Request $request)
    {
        $rencanaAksis = OpdPerjanjianKinerja::getRencanaAksiApi($request);

        return $this->successResponse(['data' => $rencanaAksis]);
    }
}
