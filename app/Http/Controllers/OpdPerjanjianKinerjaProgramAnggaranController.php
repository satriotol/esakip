<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpdPerjanjianKinerjaProgramAnggaran\CreateOpdPerjanjianKinerjaProgramAnggaranRequest;
use App\Models\OpdPerjanjianKinerjaProgramAnggaran;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OpdPerjanjianKinerjaProgramAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $name = "Perjanjian Kinerja OPD Program Anggaran";
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
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.program_anggaran.create', compact('opdPerjanjianKinerja'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $query = Http::accept('application/json')->get(route('getProgramAnggaran', [
            'year' => $opdPerjanjianKinerja->year,
            'id_skpd' => $opdPerjanjianKinerja->opd->data_unit_id,
        ]));
        foreach ($query['programAnggarans'] as $q) {
            if ($opdPerjanjianKinerja->type == 'INDUK') {
                $data['anggaran'] = (int)str_replace(',', '', $q['anggaran_induk']);
            } else {
                $data['anggaran'] = (int)str_replace(',', '', $q['anggaran_perubahan']);
            }
            OpdPerjanjianKinerjaProgramAnggaran::updateOrCreate([
                'opd_perjanjian_kinerja_id' => $opdPerjanjianKinerja->id,
                'program' => $q['program'],
                'keterangan' => 'APBD',
            ], [
                'anggaran' => $data['anggaran'],
            ]);
        }
        session()->flash('success');
        return redirect(route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaProgramAnggaran  $opdPerjanjianKinerjaProgramAnggaran
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPerjanjianKinerjaProgramAnggaran $opdPerjanjianKinerjaProgramAnggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaProgramAnggaran  $opdPerjanjianKinerjaProgramAnggaran
     * @return \Illuminate\Http\Response
     */
    public function edit($opdPerjanjianKinerja, OpdPerjanjianKinerjaProgramAnggaran $opd_program_anggaran)
    {
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.program_anggaran.create', compact('opd_program_anggaran', 'opdPerjanjianKinerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPerjanjianKinerjaProgramAnggaran  $opdPerjanjianKinerjaProgramAnggaran
     * @return \Illuminate\Http\Response
     */
    public function update(CreateOpdPerjanjianKinerjaProgramAnggaranRequest $request, $opdPerjanjianKinerja, OpdPerjanjianKinerjaProgramAnggaran $opd_program_anggaran)
    {
        $data = $request->all();
        $data['opd_perjanjian_kinerja_id'] = $opdPerjanjianKinerja;
        $data['anggaran'] = (int)str_replace(',', '', $data['anggaran']);
        $opd_program_anggaran->update($data);
        session()->flash('success');
        return redirect(route('opdPerjanjianKinerja.show', $opdPerjanjianKinerja));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPerjanjianKinerjaProgramAnggaran  $opdPerjanjianKinerjaProgramAnggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPerjanjianKinerjaProgramAnggaran $opd_program_anggaran)
    {
        $opd_program_anggaran->delete();
        session()->flash('success');
        return back();
    }
}
