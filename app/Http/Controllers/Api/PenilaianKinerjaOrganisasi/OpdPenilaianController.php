<?php

namespace App\Http\Controllers\Api\PenilaianKinerjaOrganisasi;

use App\Http\Controllers\Controller;
use App\Models\OpdPenilaian;
use Illuminate\Http\Request;

class OpdPenilaianController extends Controller
{
    public function opdPenilaian(Request $request)
    {
        $data = $request->validate([
            'year' => 'required',
            'opd_id' => 'nullable',
            'data_unit_id' => 'nullable',
            'kode_opd' => 'nullable',
        ]);

        $opdPenilaian = OpdPenilaian::where('year', $data['year']);

        if ($request->opd_id) {
            $opdPenilaian->where('opd_id', $data['opd_id']);
        } elseif ($request->data_unit_id) {
            $opdPenilaian->whereHas('opd', function ($q) use ($data) {
                $q->where('data_unit_id', $data['data_unit_id']);
            });
        } elseif ($request->kode_opd) {
            $opdPenilaian->whereHas('opd', function ($q) use ($data) {
                $q->where('kode_opd', $data['kode_opd']);
            });
        } else {
            return $this->failedResponse([], 'Pastikan anda sudah mengisi antara (opd_id,data_unit_id,master_unit_kerja_id,kode_opd)');
        }
        $opdPenilaianTw1 = clone ($opdPenilaian);
        $opdPenilaianTw2 = clone ($opdPenilaian);
        $opdPenilaianTw3 = clone ($opdPenilaian);
        $opdPenilaianTw4 = clone ($opdPenilaian);
        $opdPenilaianTahunan = clone ($opdPenilaian);
        $nilai_tw_1 = $opdPenilaianTw1->where('name', 'TRIWULAN 1')->where('status', 'SELESAI')->first();
        $nilai_tw_2 = $opdPenilaianTw2->where('name', 'TRIWULAN 2')->where('status', 'SELESAI')->first();
        $nilai_tw_3 = $opdPenilaianTw3->where('name', 'TRIWULAN 3')->where('status', 'SELESAI')->first();
        $nilai_tw_4 = $opdPenilaianTw4->where('name', 'TRIWULAN 4')->where('status', 'SELESAI')->first();
        $nilai_tw_tahunan = $opdPenilaianTahunan->whereNull('name')->where('status', 'SELESAI')->first();

        $triwulanData = [
            'triwulan_satu' => $nilai_tw_1 ? round($nilai_tw_1->totalAkhir(), 2) : null,
            'triwulan_satu_predikat' => $nilai_tw_1 ? $nilai_tw_1->totalAkhirPredikat() : null,
            'triwulan_dua' => $nilai_tw_2 ? $nilai_tw_2->totalAkhir() : null,
            'triwulan_dua_predikat' => $nilai_tw_2 ? $nilai_tw_2->totalAkhirPredikat() : null,
            'triwulan_tiga' => $nilai_tw_3 ? $nilai_tw_3->totalAkhir() : null,
            'triwulan_tiga_predikat' => $nilai_tw_3 ? $nilai_tw_3->totalAkhirPredikat() : null,
            'triwulan_empat' => $nilai_tw_4 ? $nilai_tw_4->totalAkhir() : null,
            'triwulan_empat_predikat' => $nilai_tw_4 ? $nilai_tw_4->totalAkhirPredikat() : null,
            'triwulan_tahunan' => $nilai_tw_tahunan ? $nilai_tw_tahunan->totalAkhir() : null,
            'triwulan_tahunan_predikat' => $nilai_tw_tahunan ? $nilai_tw_tahunan->totalAkhirPredikat() : null,
        ];
        if ($opdPenilaian->get()->count() == 0) {
            return $this->failedResponse([], 'Data Penilaian Kinerja Organisasi Belum Ada');
        }
        $data = [
            'tahun' => $data['year'],
            'opd' => $opdPenilaian->first()->opd->nama_opd,
        ];
        return $this->successResponse(['data' => array_merge($data, $triwulanData)]);
        // return array_merge($data, $triwulanData);
    }
}
