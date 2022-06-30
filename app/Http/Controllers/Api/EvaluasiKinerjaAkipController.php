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
        $count = EvaluasiKinerjaYear::count();
        $years = EvaluasiKinerjaYear::offset($count - 5)->take(5)->orderBy('year')->get();
        $EvaluasiKinerjaAkipYears = Opd::all();
        
        return $this->successResponse(['EvaluasiKinerjaAkip' => EvaluasiResource::collection($EvaluasiKinerjaAkipYears), 'years' => $years]);
    }
}
