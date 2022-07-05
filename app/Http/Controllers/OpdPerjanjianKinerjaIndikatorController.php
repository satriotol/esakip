<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpdPerjanjianKinerjaIndikator\CreateOpdPerjanjianKinerjaIndikatorRequest;
use App\Http\Requests\OpdPerjanjianKinerjaIndikator\UpdateOpdPerjanjianKinerjaIndikatorRequest;
use App\Models\OpdPerjanjianKinerjaIndikator;
use App\Models\OpdPerjanjianKinerjaSasaran;
use Illuminate\Http\Request;

class OpdPerjanjianKinerjaIndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $name = "Perjanjian Kinerja OPD Indikator";
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
    public function create($opdPerjanjianKinerja)
    {
        $opd_perjanjian_kinerja_sasarans = OpdPerjanjianKinerjaSasaran::where('opd_perjanjian_kinerja_id', $opdPerjanjianKinerja)->get();
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.indikator.create', compact('opdPerjanjianKinerja', 'opd_perjanjian_kinerja_sasarans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOpdPerjanjianKinerjaIndikatorRequest $request, $opdPerjanjianKinerja)
    {
        $data = $request->all();
        foreach ($data['addMoreInputFields'] as $key => $value) {
            OpdPerjanjianKinerjaIndikator::create($value);
        }
        return redirect(route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaIndikator  $opdPerjanjianKinerjaIndikator
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPerjanjianKinerjaIndikator $opdPerjanjianKinerjaIndikator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaIndikator  $opdPerjanjianKinerjaIndikator
     * @return \Illuminate\Http\Response
     */
    public function edit($opdPerjanjianKinerja, OpdPerjanjianKinerjaIndikator $opd_perjanjian_kinerja_indikator)
    {
        $opd_perjanjian_kinerja_sasarans = OpdPerjanjianKinerjaSasaran::where('opd_perjanjian_kinerja_id', $opdPerjanjianKinerja)->get();
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.indikator.edit', compact('opd_perjanjian_kinerja_indikator', 'opdPerjanjianKinerja', 'opd_perjanjian_kinerja_sasarans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPerjanjianKinerjaIndikator  $opdPerjanjianKinerjaIndikator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOpdPerjanjianKinerjaIndikatorRequest $request, $opdPerjanjianKinerja, OpdPerjanjianKinerjaIndikator $opdPerjanjianKinerjaIndikator)
    {
        $data = $request->all();
        $opdPerjanjianKinerjaIndikator->update($data);
        session()->flash('success');
        return redirect(route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaIndikator  $opdPerjanjianKinerjaIndikator
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPerjanjianKinerjaIndikator $opdPerjanjianKinerjaIndikator)
    {
        $opdPerjanjianKinerjaIndikator->delete();
        session()->flash('success');
        return back();
    }
}
