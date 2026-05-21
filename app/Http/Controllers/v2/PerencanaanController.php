<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerencanaanController extends Controller
{
    public function index(Request $request)
    {
        $apiUrl = env('ESAKIPV2_URL');
        $apiKey = env('ESAKIPV2_KEY');
        return view('v2.perencanaan.index', compact('apiUrl', 'apiKey'));
    }
}
