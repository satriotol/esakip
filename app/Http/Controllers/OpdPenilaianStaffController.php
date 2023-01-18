<?php

namespace App\Http\Controllers;

use App\Models\OpdPenilaianKinerja;
use App\Models\OpdPenilaianStaff;
use Illuminate\Http\Request;

class OpdPenilaianStaffController extends Controller
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
        $data = $request->validate([
            'opd_penilaian_id' => 'required',
            'opd_penilaian_staff_type_id' => 'required',
            'month_id' => 'required',
            'judul' => 'required',
            'file' => 'nullable',
        ]);
        $data['file'] = $request->file;
        OpdPenilaianStaff::create($data);
        session()->flash('success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateKinerja($opdPenilaianStaff)
    {
        OpdPenilaianKinerja::updateOrCreate([
            'opd_penilaian_id' => $opdPenilaianStaff->opd_penilaian->id,
            'opd_category_variable_id' => 65,
        ], [
            'target' => $opdPenilaianStaff->opd_penilaian->capaianStaff()['batasStatus'],
            'realisasi' => $opdPenilaianStaff->opd_penilaian->capaianStaff()['totalStatus'],
            'capaian' => $opdPenilaianStaff->opd_penilaian->capaianStaff()['totalCapaianStatus'],
            'nilai_akhir' => $opdPenilaianStaff->opd_penilaian->capaianStaff()['totalNilaiAkhirStatus'],
        ]);
        OpdPenilaianKinerja::updateOrCreate([
            'opd_penilaian_id' => $opdPenilaianStaff->opd_penilaian->id,
            'opd_category_variable_id' => 66,
        ], [
            'target' => $opdPenilaianStaff->opd_penilaian->capaianStaff()['batasKualitas'],
            'realisasi' => $opdPenilaianStaff->opd_penilaian->capaianStaff()['totalKualitas'],
            'capaian' => $opdPenilaianStaff->opd_penilaian->capaianStaff()['totalCapaianKualitas'],
            'nilai_akhir' => $opdPenilaianStaff->opd_penilaian->capaianStaff()['totalNilaiAkhirKualitas'],
        ]);
    }
    public function update(Request $request, OpdPenilaianStaff $opdPenilaianStaff)
    {
        $data = $request->validate([
            'status' => 'required',
            'kualitas' => 'required'
        ]);
        if ($request->status != 'TERIMA') {
            $data['kualitas'] = 0;
        }
        $opdPenilaianStaff->update($data);
        $this->updateKinerja($opdPenilaianStaff);
        session()->flash('success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaianStaff $opdPenilaianStaff)
    {
        $opdPenilaianStaff->delete();
        $this->updateKinerja($opdPenilaianStaff);
        session()->flash('success');
        return back();
    }
}
