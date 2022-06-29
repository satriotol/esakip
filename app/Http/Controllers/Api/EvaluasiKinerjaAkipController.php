<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EvaluasiResource;
use App\Models\EvaluasiKinerja\EvaluasiKinerja;
use App\Models\EvaluasiKinerja\EvaluasiKinerjaYear;
use App\Models\Opd;
use Illuminate\Http\Request;

class EvaluasiKinerjaAkipController extends Controller
{
    public function index()
    {
        $EvaluasiKinerjaAkipYears = Opd::all();
        $years = EvaluasiKinerjaYear::take(5)->orderBy('year', 'asc')->get();
        return $this->successResponse(['EvaluasiKinerjaAkip' => EvaluasiResource::collection($EvaluasiKinerjaAkipYears), 'years' => $years]);
    }
}
