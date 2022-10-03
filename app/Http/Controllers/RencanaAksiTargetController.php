<?php

namespace App\Http\Controllers;

use App\Models\RencanaAksiTarget;
use Illuminate\Http\Request;

class RencanaAksiTargetController extends Controller
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
        $data = $this->validate($request, [
            'realisasiAksiTarget.*.opd_perjanjian_kinerja_sasaran_id' => 'required',
            'realisasiAksiTarget.*.rencana_aksi_id' => 'required',
            'realisasiAksiTarget.*.target' => 'required',
            'realisasiAksiTarget.*.realisasi' => 'required',
        ]);
        foreach ($request->realisasiAksiTarget as $key) {
            RencanaAksiTarget::updateOrCreate(
                [
                    'opd_perjanjian_kinerja_sasaran_id' => $key['opd_perjanjian_kinerja_sasaran_id'],
                    'rencana_aksi_id' => $key['rencana_aksi_id']
                ],
                [
                    'target' => $key['target'],
                    'realisasi' => $key['realisasi'],
                    'status' => RencanaAksiTarget::STATUS1,
                ]
            );
        }
        session()->flash('success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RencanaAksiTarget  $rencanaAksiTarget
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaAksiTarget $rencanaAksiTarget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RencanaAksiTarget  $rencanaAksiTarget
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaAksiTarget $rencanaAksiTarget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RencanaAksiTarget  $rencanaAksiTarget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaAksiTarget $rencanaAksiTarget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaAksiTarget  $rencanaAksiTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(RencanaAksiTarget $rencanaAksiTarget)
    {
        //
    }
}
