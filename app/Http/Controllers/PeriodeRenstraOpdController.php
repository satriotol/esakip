<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerja\CreatePeriodeRenstraOpdRequest;
use App\Models\PerencanaanKinerja\PeriodeRenstraOpd;
use Illuminate\Http\Request;

class PeriodeRenstraOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:opdPeriodRenstra-list|opdPeriodRenstra-create|opdPeriodRenstra-edit|opdPeriodRenstra-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdPeriodRenstra-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdPeriodRenstra-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdPeriodRenstra-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $periodeRenstraOpds = PeriodeRenstraOpd::all();
        return view('perencanaan_kinerja.opd.renstra.index', compact('periodeRenstraOpds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perencanaan_kinerja.opd.renstra.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePeriodeRenstraOpdRequest $request)
    {
        $data = $request->all();
        PeriodeRenstraOpd::create($data);
        session()->flash('success');
        return redirect(route('periodeRenstraOpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\PeriodeRenstraOpd  $periodeRenstraOpd
     * @return \Illuminate\Http\Response
     */
    public function show(PeriodeRenstraOpd $periodeRenstraOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\PeriodeRenstraOpd  $periodeRenstraOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(PeriodeRenstraOpd $periodeRenstraOpd)
    {
        return view('perencanaan_kinerja.opd.renstra.create', compact('periodeRenstraOpd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerja\PeriodeRenstraOpd  $periodeRenstraOpd
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePeriodeRenstraOpdRequest $request, PeriodeRenstraOpd $periodeRenstraOpd)
    {
        $data = $request->all();
        $periodeRenstraOpd->update($data);
        session()->flash('success');
        return redirect(route('periodeRenstraOpd.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerencanaanKinerja\PeriodeRenstraOpd  $periodeRenstraOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeriodeRenstraOpd $periodeRenstraOpd)
    {
        $periodeRenstraOpd->delete();
        session()->flash('success');
        return redirect(route('periodeRenstraOpd.index'));
    }
}
