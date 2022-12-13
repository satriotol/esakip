<?php

namespace App\Http\Controllers;

use App\Models\DataUnit;
use App\Models\Error;
use App\Models\Opd;
use App\Models\OpdCategory;
use App\Models\OpdCategoryVariable;
use App\Models\OpdPenilaian;
use App\Models\OpdPenilaianKinerja;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $data2 = null;
        $data = null;
        $url = 'http://103.101.52.67:13000/api/bapenda/realtime/getDataRealtimePad';
        try {
            if ($name == 'BADAN PENDAPATAN DAERAH') {
                $data2 = Http::get($url)['data']['pad'][0]['subtotal'];
            } else {
                $data = Http::get($url)['data']['pad'][1]['rincian'];
            }
            $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
            $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
            $opdPenilaian = OpdPenilaian::find($request->opd_penilaian_id);
            if ($data2) {
                if ($request->name) {
                    if ((float)$data2['persenRealisasi'] > 100) {
                        $data2['persenRealisasi'] = 100;
                    }
                    DB::beginTransaction();
                    try {
                        OpdPenilaianKinerja::updateOrCreate(
                            [
                                'opd_penilaian_id' => $opd_penilaian_id,
                                'opd_category_variable_id' => $opd_category_variable_id,
                            ],
                            [
                                'target' => $data2['target'],
                                'realisasi' => $data2['realisasi'],
                                'capaian' => $data2['persenRealisasi'],
                                'nilai_akhir' => (float)$data2['persenRealisasi'] * $bobot
                            ]
                        );
                        $opdPenilaian->update([
                            'status' => OpdPenilaian::STATUS1
                        ]);
                        DB::commit();
                    } catch (Exception $exception) {
                        Error::createError($exception);
                    }

                    session()->flash('success');
                    return back();
                }
            } else {
                if ($request->name) {
                    foreach ($data as $d) {
                        if ($request->name == strtoupper($d['pendapatan'])) {
                            if ((float)$d['persenRealisasi'] > 100) {
                                $d['persenRealisasi'] = 100;
                            }
                            DB::beginTransaction();
                            try {
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
                                $opdPenilaian->update([
                                    'status' => OpdPenilaian::STATUS1
                                ]);
                                DB::commit();
                            } catch (Exception $exception) {
                                Error::createError($exception);
                            }

                            session()->flash('success');
                            return back();
                        }
                    }
                }
            }
        } catch (Exception $exception) {
            Error::createError($exception);
        }

        return back();
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
            'target' => 'required|numeric',
            'realisasi' => 'required|numeric',
        ]);
        $opdCategoryVariable = OpdCategoryVariable::where('id', $request->opd_category_variable_id)->first();
        $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
        $capaian = $request->realisasi / $request->target * 100;
        if ($capaian > 100) {
            $capaian = 100;
        }
        if ($opdCategoryVariable->opd_variable->is_efisiensi) {
            $capaian = 100;
        }
        $opdPenilaian = OpdPenilaian::find($request->opd_penilaian_id);
        DB::beginTransaction();
        try {
            OpdPenilaianKinerja::updateOrCreate(
                [
                    'opd_penilaian_id' => $request->opd_penilaian_id,
                    'opd_category_variable_id' => $request->opd_category_variable_id,
                ],
                [
                    'target' => $request->target,
                    'realisasi' => $request->realisasi,
                    'capaian' => round($capaian, 2),
                    'nilai_akhir' => round($capaian * $bobot, 2),
                    'user_id' => Auth::user()->id
                ]
            );
            $opdPenilaian->update([
                'status' => OpdPenilaian::STATUS1
            ]);
            DB::commit();
        } catch (Exception $exception) {
            Error::createError($exception);
        }

        session()->flash('success');
        return back();
    }

    public function storeSipd(Request $request)
    {
        $data = Http::get(route('getPenyerapanAnggaranBelanja'))->json();
        dd($data);
        $request->validate([
            'tahap' => 'required'
        ]);
        $opd = Opd::find($request->opd_id);
        $data = Http::withHeaders(['x-api-key' => 'FD59804809A3DFD300C1E49F6E6FD23D'])
            ->get(
                'http://ekontrak.semarangkota.go.id/ekontrak/api/ekontrak/monitoring_kegiatan',
                [
                    'idskpd' => $opd->data_unit_id,
                    'tahap' => $request->tahap
                ]
            )->json();
        $opdCategoryVariable = OpdCategoryVariable::where('id', $request->opd_category_variable_id)->first();
        $dataPersen = str_replace(',', '', $data['data']['persenRealisasi']);
        $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
        $capaian = round($dataPersen, 2);
        if ($capaian > 100) {
            $capaian = 100;
        }
        $nilaiAkhir = round($capaian * $bobot, 2);
        OpdPenilaianKinerja::updateOrCreate(
            [
                'opd_penilaian_id' => $request->opd_penilaian_id,
                'opd_category_variable_id' => $request->opd_category_variable_id,
            ],
            [
                'target' => $data['data']['target'],
                'realisasi' => $data['data']['realisasi'],
                'capaian' => $capaian,
                'nilai_akhir' => $nilaiAkhir,
                'user_id' => Auth::user()->id
            ]
        );
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
