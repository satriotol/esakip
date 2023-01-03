<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpdPerjanjianKinerjaSasaran\CreateOpdPerjanjianKinerjaSasaranRequest;
use App\Http\Requests\OpdPerjanjianKinerjaSasaran\UpdateOpdPerjanjianKinerjaSasaranRequest;
use App\Models\OpdPerjanjianKinerjaSasaran;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class OpdPerjanjianKinerjaSasaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:opdPerjanjianKinerjaSasaran-list|opdPerjanjianKinerjaSasaran-create|opdPerjanjianKinerjaSasaran-edit|opdPerjanjianKinerjaSasaran-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdPerjanjianKinerjaSasaran-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdPerjanjianKinerjaSasaran-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdPerjanjianKinerjaSasaran-delete', ['only' => ['destroy']]);
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
    public function create(OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.sasaran.create', compact('opdPerjanjianKinerja'));
    }
    public function createData(OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $query = DB::connection('mysql2')->select("SELECT * FROM sasaran_ranakhir_renstra WHERE id_skpd=" . $opdPerjanjianKinerja->opd->data_unit->id_skpd . ";");
        foreach ($query as $q) {
            OpdPerjanjianKinerjaSasaran::updateOrCreate(
                [
                    'opd_perjanjian_kinerja_id' => $opdPerjanjianKinerja->id,
                    'sasaran_lama_id' => $q->id,
                ],
                [
                    'sasaran' => $q->uraian,
                ]
            );
        }
        session()->flash('success');
        return back();
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
