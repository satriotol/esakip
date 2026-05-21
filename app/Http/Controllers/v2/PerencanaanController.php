<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;

class PerencanaanController extends Controller
{
    public function index()
    {
        $apiUrl = env('ESAKIPV2_URL');
        $apiKey = env('ESAKIPV2_KEY');
        $categoryId = 1;
        $pageTitle = 'Dokumen Perencanaan Kinerja';
        return view('v2.perencanaan.index', compact('apiUrl', 'apiKey', 'categoryId', 'pageTitle'));
    }

    public function pengukuran()
    {
        $apiUrl = env('ESAKIPV2_URL');
        $apiKey = env('ESAKIPV2_KEY');
        $categoryId = 2;
        $pageTitle = 'Dokumen Pengukuran Kinerja';
        return view('v2.perencanaan.index', compact('apiUrl', 'apiKey', 'categoryId', 'pageTitle'));
    }

    public function pelaporan()
    {
        $apiUrl = env('ESAKIPV2_URL');
        $apiKey = env('ESAKIPV2_KEY');
        $categoryId = 3;
        $pageTitle = 'Dokumen Pelaporan Kinerja';
        return view('v2.perencanaan.index', compact('apiUrl', 'apiKey', 'categoryId', 'pageTitle'));
    }
}
