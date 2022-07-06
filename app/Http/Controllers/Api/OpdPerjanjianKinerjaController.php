<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpdPerjanjianKinerjaResource;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Http\Request;

class OpdPerjanjianKinerjaController extends Controller
{
    public function index(Request $request)
    {
        $perjanjian_kinerjas = OpdPerjanjianKinerja::whereHas('opd', function ($q) use ($request) {
            $q->where('nama_opd', $request->nama_opd);
        })->latest()->first();
        if ($request->nama_opd == null) {
            return $this->failedResponse([], 'Oops, ada yang salah, Pastikan Anda Sudah Mengisi Form Pencarian');
        }
        if ($perjanjian_kinerjas == null) {
            return $this->failedResponse([], 'Oops, ada yang salah, Pastikan Nama Opd Yang Anda Masukkan Benar');
        }
        return $this->successResponse(['perjanjian_kinerja' => new OpdPerjanjianKinerjaResource($perjanjian_kinerjas)]);
    }
}
