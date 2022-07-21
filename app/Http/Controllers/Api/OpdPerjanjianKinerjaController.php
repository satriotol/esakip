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
        $id = $request->id;
        $nama_opd = $request->nama_opd;
        // $perjanjian_kinerjas = OpdPerjanjianKinerja::whereHas('opd', function ($q) use ($request) {
        //     $q->where('nama_opd', $request->nama_opd);
        // })->latest()->first();
        $perjanjian_kinerja = OpdPerjanjianKinerja::query();
        if ($id) {
            $data = $perjanjian_kinerja->where('id', $id)->latest()->first();
            if ($data == null) {
                return $this->failedResponse([], 'Oops, Data Tidak Ditemukan');
            }
            return $this->successResponse(['perjanjian_kinerja' => new OpdPerjanjianKinerjaResource($data)]);
        }
        if ($nama_opd) {
            $data = $perjanjian_kinerja->whereHas('opd', function ($q) use ($request) {
                $q->where('nama_opd', $request->nama_opd);
            })->get();
        }
        if ($request->nama_opd == null) {
            return $this->failedResponse([], 'Oops, ada yang salah, Pastikan Anda Sudah Mengisi Form Pencarian');
        }
        if ($data == null) {
            return $this->failedResponse([], 'Oops, ada yang salah, Pastikan Nama Opd Yang Anda Masukkan Benar');
        }
        return $this->successResponse(['perjanjian_kinerja' => OpdPerjanjianKinerjaResource::collection($data)]);
    }
}
