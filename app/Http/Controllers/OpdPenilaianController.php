<?php

namespace App\Http\Controllers;

use App\Models\InovasiPrestasiDaerah;
use App\Models\Opd;
use App\Models\OpdCategory;
use App\Models\OpdPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpdPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $opds = Opd::getOpd();
        $opdPenilaians = OpdPenilaian::getOpdPenilaian($request);
        $opdCategories = OpdCategory::all();
        $request->flash();
        return view('opdPenilaian.index', compact('opdPenilaians', 'opds', 'opdCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
        $opdCategories = OpdCategory::all();
        return view('opdPenilaian.create', compact('opds', 'opdCategories'));
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
            'opd_id' => 'required',
            'opd_category_id' => 'required',
            'year' => 'required',
            'inovasi_prestasi_daerah' => 'nullable',
        ]);
        if (OpdPenilaian::ifTahunan($request->opd_category_id)) {
            $data['inovasi_prestasi_daerah'] = InovasiPrestasiDaerah::first()->nilai;
            OpdPenilaian::create($data);
        } else {
            $triwulans = ['TRIWULAN 1', 'TRIWULAN 2', 'TRIWULAN 3', 'TRIWULAN 4'];
            foreach ($triwulans as $triwulan) {
                OpdPenilaian::create([
                    'name' => $triwulan,
                    'opd_id' => $data['opd_id'],
                    'opd_category_id' => $data['opd_category_id'],
                    'year' => $data['year'],
                ]);
            }
        }
        session()->flash('success');
        return redirect(route('opdPenilaian.index'));
    }

    public function updateStatus(Request $request, OpdPenilaian $opdPenilaian)
    {
        $data = $request->validate([
            'status' => 'required',
            'note' => 'nullable',
        ]);
        $opdPenilaian->update($data);
        session()->flash('success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaian $opdPenilaian)
    {
        $statuses = OpdPenilaian::STATUSES;
        return view('opdPenilaian.show', compact('opdPenilaian', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPenilaian $opdPenilaian)
    {
        $opds = Opd::getOpd();
        $opdCategories = OpdCategory::all();
        return view('opdPenilaian.create', compact('opdPenilaian', 'opds', 'opdCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdPenilaian $opdPenilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaian $opdPenilaian)
    {
        $opdPenilaian->delete();
        session()->flash('success');
        return back();
    }
}
