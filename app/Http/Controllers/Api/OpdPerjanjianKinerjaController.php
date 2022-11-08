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
        $id = $request->input('id');
        $nama_opd = $request->input('nama_opd');
        $limit = $request->input('limit');

        if ($id) {
            $perjanjian_kinerja = OpdPerjanjianKinerja::find($id);
            if ($perjanjian_kinerja == null) {
                return $this->failedResponse([], 'Oops, Data Tidak Ditemukan');
            }
            return $this->successResponse(['perjanjian_kinerja' => new OpdPerjanjianKinerjaResource($perjanjian_kinerja)]);
        }
        $perjanjian_kinerja = OpdPerjanjianKinerja::query();


        if ($nama_opd) {
            $perjanjian_kinerja->whereHas('opd', function ($q) use ($nama_opd) {
                $q->where('nama_opd', 'like', '%' . $nama_opd . '%');
            });
        }
        if ($perjanjian_kinerja == null) {
            return $this->failedResponse([], 'Oops, ada yang salah, Pastikan Nama OPD Yang Anda Masukkan Benar');
        }
        return $this->successResponse(['perjanjian_kinerja' => OpdPerjanjianKinerjaResource::collection($perjanjian_kinerja->paginate($limit))]);
    }
}
