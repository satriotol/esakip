<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpdPerjanjianKinerjaProgramAnggaran\CreateOpdPerjanjianKinerjaProgramAnggaranRequest;
use App\Models\OpdPerjanjianKinerjaProgramAnggaran;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(CreateOpdPerjanjianKinerjaProgramAnggaranRequest $request, OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $query = DB::connection('mysql2')->select("select e.kode as kode_program, e.uraian as nama_program , sum(a.anggaran) as total_anggaran
        from a_realisasi_keuangan a 
        left join tampung_exel_subkegiatan b on b.id=a.id_subkegiatan 
        left join tampung_exel_kegiatan d on d.id=b.id_kegiatan
        left join tampung_exel_program e on e.id=d.id_program
        left join data_unit c on c.id_skpd=a.id_sub_skpd and status='br' 
        where a.tahun=" . $opdPerjanjianKinerja->year . " and a.id_skpd=" . $opdPerjanjianKinerja->opd->data_unit->id_skpd . "
        group by e.kode");
        foreach ($query as $q) {
            $data = $request->all();
            $data['opd_perjanjian_kinerja_id'] = $opdPerjanjianKinerja->id;
            $data['anggaran'] = (int)str_replace(',', '', $q->total_anggaran);
            $data['keterangan'] = 'APBD';
            $data['program'] = $q->nama_program;
            OpdPerjanjianKinerjaProgramAnggaran::updateOrCreate([
                'opd_perjanjian_kinerja_id' => $data['opd_perjanjian_kinerja_id'],
                'anggaran' => $data['anggaran'],
                'program' => $data['program'],
                'keterangan' => $data['keterangan'],
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
