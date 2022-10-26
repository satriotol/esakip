<?php

namespace App\Http\Controllers;

use App\Http\Resources\RencanaAksiTargetCollection;
use App\Models\RencanaAksi;
use App\Models\RencanaAksiTarget;
use Illuminate\Http\Request;

class RencanaAksiTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        // $this->middleware('permission:opdPerjanjianKinerja-list|opdPerjanjianKinerja-create|opdPerjanjianKinerja-edit|opdPerjanjianKinerja-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:opdPerjanjianKinerja-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:opdPerjanjianKinerja-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:opdPerjanjianKinerja-delete', ['only' => ['destroy']]);
        $name = "Rencana Aksi Target";
        view()->share('name', $name);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RencanaAksi $rencanaAksi)
    {
        $realisasis = RencanaAksiTarget::REALISASIS;
        return view('rencanaAksiTarget.create', compact('rencanaAksi', 'realisasis'));
    }

    public function getRencanaAksiTarget($rencana_aksi_id)
    {
        $rencanaAksiTargets = RencanaAksiTarget::where('rencana_aksi_id', $rencana_aksi_id)->get();
        return $rencanaAksiTargets;
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
            'opd_perjanjian_kinerja_sasaran_id' => 'required',
            'rencana_aksi_id' => 'required',
            'target' => 'required',
            'rencana_aksi_note' => 'required',
        ]);
        RencanaAksiTarget::create(
            [

                'opd_perjanjian_kinerja_sasaran_id' => $request->opd_perjanjian_kinerja_sasaran_id,
                'rencana_aksi_id' => $request->rencana_aksi_id,
                'target' => $request->target,
                'realisasi' => $request->realisasi,
                'status' => RencanaAksiTarget::STATUS1,
                'rencana_aksi_note' => $request->rencana_aksi_note
            ]
        );
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
        $rencanaAksiTarget->update(
            [
                'opd_perjanjian_kinerja_sasaran_id' => $request->opd_perjanjian_kinerja_sasaran_id,
                'realisasi' => $request->realisasi,
                'target' => $request->target,
                'rencana_aksi_note' => $request->rencana_aksi_note,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaAksiTarget  $rencanaAksiTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(RencanaAksiTarget $rencanaAksiTarget)
    {
        $rencanaAksiTarget->delete();
        session()->flash('success');
    }
}
