<?php

namespace App\Http\Controllers;

use App\Models\OpdCategory;
use App\Models\OpdCategoryVariable;
use App\Models\OpdPenilaianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpdPenilaianKinerjaController extends Controller
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
    public function getRealisasiTargetPendapatan(Request $request, $name, $opd_penilaian_id, $opd_category_variable_id)
    {
        $request->name = $name;
        $data = Http::get('http://103.101.52.67:13000/api/bapenda/realtime/getDataRealtimePad')['data']['pad'][1]['rincian'];
        $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
        $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
        if ($request->name) {
            foreach ($data as $d) {
                if ($request->name == strtoupper($d['pendapatan'])) {
                    if ((float)$d['persenRealisasi'] > 100) {
                        $d['persenRealisasi'] = 100;
                    }
                    OpdPenilaianKinerja::updateOrCreate(
                        [
                            'opd_penilaian_id' => $opd_penilaian_id,
                            'opd_category_variable_id' => $opd_category_variable_id,
                        ],
                        [
                            'target' => $d['target'],
                            'realisasi' => $d['realisasi'],
                            'capaian' => $d['persenRealisasi'],
                            'nilai_akhir' => (float)$d['persenRealisasi'] * $bobot
                        ]
                    );
                    session()->flash('success');
                    return back();
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'target' => 'required',
            'realisasi' => 'required',
        ]);
        $opdCategoryVariable = OpdCategoryVariable::where('id', $request->opd_category_variable_id)->first();
        $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
        $capaian = $request->realisasi / $request->target * 100;
        if ($capaian > 100) {
            $capaian = 100;
        }
        OpdPenilaianKinerja::updateOrCreate([
            'opd_penilaian_id' => $request->opd_penilaian_id,
            'opd_category_variable_id' => $request->opd_category_variable_id,
        ],
        [
            'target' => $request->target,
            'realisasi' => $request->realisasi,
            'capaian' => $capaian,
            'nilai_akhir' => $capaian * $bobot
        ]);
        session()->flash('success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaianKinerja  $opdPenilaianKinerja
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaianKinerja $opdPenilaianKinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPenilaianKinerja  $opdPenilaianKinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPenilaianKinerja $opdPenilaianKinerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPenilaianKinerja  $opdPenilaianKinerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdPenilaianKinerja $opdPenilaianKinerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPenilaianKinerja  $opdPenilaianKinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaianKinerja $opdPenilaianKinerja)
    {
        //
    }
}