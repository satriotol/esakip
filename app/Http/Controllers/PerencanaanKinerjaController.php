<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerja\CreatePerencanaanKinerja;
use App\Models\PerencanaanKinerja;
use App\Models\PerencanaanKinerjaCategory;
use Illuminate\Http\Request;

class PerencanaanKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perencanaan_kinerjas = PerencanaanKinerja::all();
        return view('perencanaan_kinerja.index', compact('perencanaan_kinerjas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perencanaan_kinerja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePerencanaanKinerja $request)
    {
        $data = $request->all();
        PerencanaanKinerja::create($data);

        session()->flash('success');
        return redirect(route('perencanaan_kinerja.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja  $perencanaanKinerja
     * @return \Illuminate\Http\Response
     */
    public function show(PerencanaanKinerja $perencanaan_kinerja)
    {
        $perencanaan_kinerja_categories = PerencanaanKinerjaCategory::where('perencanaan_kinerja_id', $perencanaan_kinerja->id)->get();
        return view('perencanaan_kinerja.show', compact('perencanaan_kinerja', 'perencanaan_kinerja_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja  $perencanaanKinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(PerencanaanKinerja $perencanaan_kinerja)
    {
        return view('perencanaan_kinerja.create', compact('perencanaan_kinerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerja  $perencanaanKinerja
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePerencanaanKinerja $request, PerencanaanKinerja $perencanaan_kinerja)
    {
        $data = $request->all();
        $perencanaan_kinerja->update($data);

        session()->flash('success');
        return redirect(route('perencanaan_kinerja.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerencanaanKinerja  $perencanaanKinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerencanaanKinerja $perencanaan_kinerja)
    {
        $perencanaan_kinerja->delete();
        session()->flash('success');
        return redirect(route('perencanaan_kinerja.index'));
    }
}
