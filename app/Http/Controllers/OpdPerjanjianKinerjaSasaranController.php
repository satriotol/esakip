<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpdPerjanjianKinerjaSasaran\CreateOpdPerjanjianKinerjaSasaranRequest;
use App\Http\Requests\OpdPerjanjianKinerjaSasaran\UpdateOpdPerjanjianKinerjaSasaranRequest;
use App\Models\OpdPerjanjianKinerjaSasaran;
use Illuminate\Http\Request;

class OpdPerjanjianKinerjaSasaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $name = "Sasaran Perjanjian Kinerja OPD";
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
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.sasaran.create', compact('opdPerjanjianKinerja'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOpdPerjanjianKinerjaSasaranRequest $request, $opdPerjanjianKinerja)
    {
        $data = $request->all();
        foreach ($data['sasaran'] as $key => $value) {
            OpdPerjanjianKinerjaSasaran::create([
                'opd_perjanjian_kinerja_id' => $opdPerjanjianKinerja,
                'sasaran' => $value,
            ]);
        }
        session()->flash('success');
        return redirect(route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaSasaran  $opdPerjanjianKinerjaSasaran
     * @return \Illuminate\Http\Response
     */
    public function show(CreateOpdPerjanjianKinerjaSasaranRequest $opdPerjanjianKinerjaSasaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaSasaran  $opdPerjanjianKinerjaSasaran
     * @return \Illuminate\Http\Response
     */
    public function edit($opdPerjanjianKinerja, OpdPerjanjianKinerjaSasaran $opdPerjanjianKinerjaSasaran)
    {
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.sasaran.edit', compact('opdPerjanjianKinerja', 'opdPerjanjianKinerjaSasaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPerjanjianKinerjaSasaran  $opdPerjanjianKinerjaSasaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOpdPerjanjianKinerjaSasaranRequest $request, $opdPerjanjianKinerja, OpdPerjanjianKinerjaSasaran $opdPerjanjianKinerjaSasaran)
    {
        $data = $request->all();
        $data['opd_perjanjian_kinerja_id'] = $opdPerjanjianKinerja;
        $opdPerjanjianKinerjaSasaran->update($data);
        session()->flash('success');
        return redirect(route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaSasaran  $opdPerjanjianKinerjaSasaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPerjanjianKinerjaSasaran $opdPerjanjianKinerjaSasaran)
    {
        $opdPerjanjianKinerjaSasaran->delete();
        session()->flash('success');
        return back();
    }
}
