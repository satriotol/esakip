<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataUnit;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function getSkpd()
    {
        $skpds = DataUnit::orderBy('nama_skpd')->get(['id_skpd', 'nama_skpd']);
        return $this->successResponse(['skpds' => $skpds]);
    }
}
