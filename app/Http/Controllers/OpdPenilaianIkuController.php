<?php

namespace App\Http\Controllers;

use App\Models\OpdCategoryVariable;
use App\Models\OpdPenilaian;
use App\Models\OpdPenilaianIku;
use App\Models\OpdPenilaianKinerja;
use App\Models\OpdPerjanjianKinerjaIndikator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OpdPenilaianIkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'iku.type.*' => 'required',
            'iku.realisasi.*' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $opdPenilaianKinerja = OpdPenilaianKinerja::updateOrCreate([
                'opd_penilaian_id' => $request->opd_penilaian_id,
                'opd_category_variable_id' => $request->opd_category_variable_id,
            ]);
            foreach ($request->iku as $i) {
                $opdPerjanjianKinerjaIndikator = OpdPerjanjianKinerjaIndikator::find($i['opd_perjanjian_kinerja_indikator_id']);
                // OpdPenilaianIku::where('opd_penilaian_kinerja_id', $opdPenilaianKinerja->id)->where('opd_perjanjian_kinerja_indikator_id', $i['opd_perjanjian_kinerja_indikator_id'])->delete();
                if ($i['type'] == OpdPenilaianIku::TYPE1) {
                    OpdPenilaianIku::updateOrCreate(
                        [
                            'opd_penilaian_kinerja_id' => $opdPenilaianKinerja->id,
                            'opd_perjanjian_kinerja_indikator_id' => $i['opd_perjanjian_kinerja_indikator_id'],
                        ],
                        [
                            'type' => $i['type'],
                            'realisasi' => $i['realisasi'],
                            'capaian' => round((float)$i['realisasi'] / (float)$opdPerjanjianKinerjaIndikator->target * 100, 2),
                        ]
                    );
                } else {
                    OpdPenilaianIku::updateOrCreate(
                        [
                            'opd_penilaian_kinerja_id' => $opdPenilaianKinerja->id,
                            'opd_perjanjian_kinerja_indikator_id' => $i['opd_perjanjian_kinerja_indikator_id'],
                        ],
                        [
                            'type' => $i['type'],
                            'realisasi' => $i['realisasi'],
                            'capaian' => round(((float)$opdPerjanjianKinerjaIndikator->target - (float)$i['realisasi']) / (float)$opdPerjanjianKinerjaIndikator->target * 100, 2),
                        ]
                    );
                }
            }
            $opdCategoryVariable = OpdCategoryVariable::where('id', $request->opd_category_variable_id)->first();
            $target = OpdPenilaian::getOpdPerjanjianKinerjaIndikator(OpdPenilaian::find($request->opd_penilaian_id))->sum('target');
            $realisasi = $opdPenilaianKinerja->opd_penilaian_ikus->sum('realisasi');
            $capaian = round($opdPenilaianKinerja->opd_penilaian_ikus->sum('capaian') / $opdPenilaianKinerja->opd_penilaian_ikus->count(), 2);
            if ($capaian > 100) {
                $capaian = 100;
            }
            $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
            $opdPenilaianKinerja->update([
                'target' => $target,
                'realisasi' => $realisasi,
                'capaian' => $capaian,
                'nilai_akhir' => round($capaian * $bobot, 2),
                'user_id' => Auth::user()->id

            ]);
            DB::commit();
        } catch (\Throwable $th) {
            return $th;
            DB::rollback();
        }


        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaianIku  $opdPenilaianIku
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaianIku $opdPenilaianIku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPenilaianIku  $opdPenilaianIku
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPenilaianIku $opdPenilaianIku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPenilaianIku  $opdPenilaianIku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdPenilaianIku $opdPenilaianIku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPenilaianIku  $opdPenilaianIku
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaianIku $opdPenilaianIku)
    {
        //
    }
}