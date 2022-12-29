<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpdPerjanjianKinerjaIndikator\CreateOpdPerjanjianKinerjaIndikatorRequest;
use App\Http\Requests\OpdPerjanjianKinerjaIndikator\UpdateOpdPerjanjianKinerjaIndikatorRequest;
use App\Models\Master;
use App\Models\OpdPerjanjianKinerjaIndikator;
use App\Models\OpdPerjanjianKinerjaSasaran;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function createView($opdPerjanjianKinerja)
    {
        $opd_perjanjian_kinerja_sasarans = OpdPerjanjianKinerjaSasaran::where('opd_perjanjian_kinerja_id', $opdPerjanjianKinerja)->get();
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.indikator.create', compact('opdPerjanjianKinerja', 'opd_perjanjian_kinerja_sasarans'));
    }
    public function create(OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $totalTahun = OpdPerjanjianKinerja::getTotalTahun($opdPerjanjianKinerja);
        $query = DB::connection('mysql2')->select("select a.*, b.uraian as sasaran from indikator_sasaran_ranakhir_renstra a left join sasaran_ranakhir_renstra b on b.id=a.id_sasaran left join data_unit c on c.id_skpd=b.id_skpd where c.id_unit=" . $opdPerjanjianKinerja->opd->data_unit->id_skpd . ";");
        foreach ($query as $q) {
            $tahun = Master::first()->tahun_awal + $totalTahun;
            $opdPerjanjianKinerjaSasaran = OpdPerjanjianKinerjaSasaran::where('sasaran_lama_id', $q->id_sasaran)->whereHas('opd_perjanjian_kinerja', function ($q) use ($tahun, $opdPerjanjianKinerja) {
                $q->where('year', $tahun)->where('type', $opdPerjanjianKinerja->type);
            })->first();
            if ($totalTahun == 0) {
                OpdPerjanjianKinerjaIndikator::updateOrCreate([
                    'opd_perjanjian_kinerja_sasaran_id' => $opdPerjanjianKinerjaSasaran->id,
                    'sasaran_lama_id' => $q->id_sasaran,
                    'type' => $opdPerjanjianKinerja->type,
                ], [
                    'indikator' => $q->uraian,
                    'target' => $q->awal,
                    'satuan' => $q->satuan,

                ]);
            } elseif ($totalTahun == 1) {
                OpdPerjanjianKinerjaIndikator::updateOrCreate([
                    'sasaran_lama_id' => $q->id_sasaran,
                    'opd_perjanjian_kinerja_sasaran_id' => $opdPerjanjianKinerjaSasaran->id,
                    'type' => $opdPerjanjianKinerja->type,
                ], [
                    'indikator' => $q->uraian,
                    'target' => $q->target1,
                    'satuan' => $q->satuan,

                ]);
            } elseif ($totalTahun == 2) {
                OpdPerjanjianKinerjaIndikator::updateOrCreate([
                    'sasaran_lama_id' => $q->id_sasaran,
                    'opd_perjanjian_kinerja_sasaran_id' => $opdPerjanjianKinerjaSasaran->id,
                    'type' => $opdPerjanjianKinerja->type,
                ], [
                    'indikator' => $q->uraian,
                    'target' => $q->target2,
                    'satuan' => $q->satuan,

                ]);
            } elseif ($totalTahun == 3) {
                OpdPerjanjianKinerjaIndikator::updateOrCreate([
                    'sasaran_lama_id' => $q->id_sasaran,
                    'opd_perjanjian_kinerja_sasaran_id' => $opdPerjanjianKinerjaSasaran->id,
                    'type' => $opdPerjanjianKinerja->type,
                ], [
                    'indikator' => $q->uraian,
                    'target' => $q->target3,
                    'satuan' => $q->satuan,

                ]);
            } elseif ($totalTahun == 4) {
                OpdPerjanjianKinerjaIndikator::updateOrCreate([
                    'sasaran_lama_id' => $q->id_sasaran,
                    'opd_perjanjian_kinerja_sasaran_id' => $opdPerjanjianKinerjaSasaran->id,
                    'type' => $opdPerjanjianKinerja->type,
                ], [
                    'indikator' => $q->uraian,
                    'target' => $q->target4,
                    'satuan' => $q->satuan,

                ]);
            } elseif ($totalTahun == 5) {
                OpdPerjanjianKinerjaIndikator::updateOrCreate([
                    'sasaran_lama_id' => $q->id_sasaran,
                    'opd_perjanjian_kinerja_sasaran_id' => $opdPerjanjianKinerjaSasaran->id,
                    'type' => $opdPerjanjianKinerja->type,
                ], [
                    'indikator' => $q->uraian,
                    'target' => $q->target5,
                    'satuan' => $q->satuan,

                ]);
            }
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
