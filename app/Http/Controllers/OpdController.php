<?php

namespace App\Http\Controllers;

use App\Models\DataUnit;
use App\Models\MasterUnitKerja;
use App\Models\Opd;
use App\Models\OpdCategory;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:opd-list|opd-create|opd-edit|opd-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:opd-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opd-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opd-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $opds = Opd::getOpd();
        return view('opds.index', compact('opds'));
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
    public function edit(Opd $opd)
    {
        $dataUnits = DataUnit::all();
        $masterUnitKerjas = MasterUnitKerja::all();
        return view('opds.create', compact('opd', 'dataUnits', 'masterUnitKerjas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opd $opd)
    {
        $data = $request->validate([
            'nama_opd' => 'nullable',
            'data_unit_id' => 'nullable',
            'master_unit_kerja_id' => 'nullable',
            'inovasi_prestasi_daerah' => 'required|numeric'
        ]);
        $opd->update($data);
        session()->flash('success');
        return redirect(route('opds.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
