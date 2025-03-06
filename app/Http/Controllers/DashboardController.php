<?php

namespace App\Http\Controllers;

use App\Models\OpdPenilaian;
use App\Repositories\OpdPenilaianRepository;
use App\Repositories\OpdRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    protected $opdPenilaianRepository;
    protected $opdRepository;

    public function __construct()
    {
        $this->opdPenilaianRepository = new OpdPenilaianRepository();
        $this->opdRepository = new OpdRepository();
    }
    public function index(Request $request)
    {
        $opds = $this->opdRepository->get($request)->get();
        $opd_penilaians = $this->opdPenilaianRepository->get($request)
            ->orderBy('year', 'desc')
            ->where('status', OpdPenilaian::STATUS3)->paginate(10);
        $request->flash();
        return view('dashboard', compact('opd_penilaians', 'opds'));
    }
    public function getPenyerapanAnggaran(Request $request)
    {
        $year = $request->year;
        $opd_id = $request->opd_id;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => env('PENYERAPAN_ANGGARAN_X_API_KEY')
        ])->get(env('PENYERAPAN_ANGGARAN_ENDPOINT') . "v2/issp/getTahunan", [
            'opd_id' => $opd_id,
            'year' => $year
        ]);
        return $response->json();
    }
    public function change_password(Request $request)
    {
        return view('reset_password');
    }
}
