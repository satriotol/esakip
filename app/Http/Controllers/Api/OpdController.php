<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function index()
    {
        $opds = Opd::all(['id', 'nama_opd']);
        return $this->successResponse(['opds' => $opds]);
    }
}
