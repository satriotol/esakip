<?php

namespace App\Http\Controllers;

use App\Models\PerencanaanKinerja\PeriodeRenstraOpd;
use App\Models\PerencanaanKinerja\RenstraOpd;
use Illuminate\Http\Request;

class RenstraOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PeriodeRenstraOpd $periodeRenstraOpd)
    {
        $renstraOpds = RenstraOpd::where('periode_renstra_opd_id', $periodeRenstraOpd)->get();
        return view('perencanaan_kinerja.opd.renstra.renstra_detail.index', compact('renstraOpds', 'periodeRenstraOpd'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\RenstraOpd  $renstraOpd
     * @return \Illuminate\Http\Response
     */
    public function show(RenstraOpd $renstraOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\RenstraOpd  $renstraOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(RenstraOpd $renstraOpd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerja\RenstraOpd  $renstraOpd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RenstraOpd $renstraOpd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerencanaanKinerja\RenstraOpd  $renstraOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(RenstraOpd $renstraOpd)
    {
        //
    }
}
