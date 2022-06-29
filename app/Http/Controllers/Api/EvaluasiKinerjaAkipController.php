<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EvaluasiKinerja\EvaluasiKinerja;
use App\Models\EvaluasiKinerja\EvaluasiKinerjaYear;
use App\Models\Opd;
use Illuminate\Http\Request;

class EvaluasiKinerjaAkipController extends Controller
{
    public function index()
    {
        $EvaluasiKinerjaAkipYears = EvaluasiKinerjaYear::with('evaluasi_kinerja')->orderBy('year', 'asc')->get();
        // $EvaluasiKinerjaAkipYears = Opd::with();
        return $this->successResponse(['EvaluasiKinerjaAkip' => $EvaluasiKinerjaAkipYears]);
    }
}
