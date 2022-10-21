<?php

namespace App\Http\Controllers;

use App\Models\OpdCategory;
use Illuminate\Http\Request;

class OpdCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opdCategories = OpdCategory::all();
        return view('opdCategories.index', compact('opdCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('opdCategories.create');
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
            'name' => 'required',
            'reformasi_birokrasi' => 'required',
            'sakip' => 'required',
            'iku' => 'required',
            'penyerapan_anggaran_belanja' => 'required',
            'realisasi_target_pendapatan' => 'required',
            'p3dn' => 'required',
            'inovasi_prestasi_daerah' => 'required',
        ]);

        OpdCategory::create($data);
        session()->flash('success');
        return redirect(route('opdCategories.index'));
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
    public function edit(OpdCategory $opdCategory)
    {
        return view('opdCategories.create', compact('opdCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdCategory $opdCategory)
    {
        $data = $request->validate([
            'name' => 'required',
            'reformasi_birokrasi' => 'required',
            'sakip' => 'required',
            'iku' => 'required',
            'penyerapan_anggaran_belanja' => 'required',
            'realisasi_target_pendapatan' => 'required',
            'p3dn' => 'required',
            'inovasi_prestasi_daerah' => 'required',
        ]);

        $opdCategory->update($data);
        session()->flash('success');
        return redirect(route('opdCategories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdCategory $opdCategory)
    {
        $opdCategory->delete();
        session()->flash('success');
        return back();
    }
}
