<?php

namespace App\Http\Controllers;

use App\Repositories\OpdPenilaianRepository;
use App\Repositories\OpdRepository;
use Illuminate\Http\Request;

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
        $opd_penilaians = $this->opdPenilaianRepository->get($request)->paginate(10);
        $request->flash();
        return view('dashboard', compact('opd_penilaians', 'opds'));
    }
    public function change_password(Request $request)
    {
        return view('reset_password');
    }
}
