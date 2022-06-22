<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerjaRkpd\CreatePerencanaanKinerjaRkpd;
use App\Http\Requests\PerencanaanKinerjaRkpd\UpdatePerencanaanKinerjaRkpd;
use App\Models\PerencanaanKinerjaRkpd;
use Illuminate\Http\Request;

class PerencanaanKinerjaRkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perencanaan_kinerja_rkpds = PerencanaanKinerjaRkpd::all();
        return view('perencanaan_kinerja_rkpd.index', compact('perencanaan_kinerja_rkpds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perencanaan_kinerja_rkpd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePerencanaanKinerjaRkpd $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $data['file'] = $file;
        };
        PerencanaanKinerjaRkpd::create($data);
        session()->flash('success');
        return redirect(route('perencanaan_kinerja_rkpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerjaRkpd  $perencanaanKinerjaRkpd
     * @return \Illuminate\Http\Response
     */
    public function show(PerencanaanKinerjaRkpd $perencanaanKinerjaRkpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerjaRkpd  $perencanaanKinerjaRkpd
     * @return \Illuminate\Http\Response
     */
    public function edit(PerencanaanKinerjaRkpd $perencanaan_kinerja_rkpd)
    {
        return view('perencanaan_kinerja_rkpd.create', compact('perencanaan_kinerja_rkpd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerjaRkpd  $perencanaanKinerjaRkpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerencanaanKinerjaRkpd $request, PerencanaanKinerjaRkpd $perencanaan_kinerja_rkpd)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $perencanaan_kinerja_rkpd->deleteFile();
            $data['file'] = $file;
        };
        $perencanaan_kinerja_rkpd->update($data);
        session()->flash('success');
        return redirect(route('perencanaan_kinerja_rkpd.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerencanaanKinerjaRkpd  $perencanaanKinerjaRkpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerencanaanKinerjaRkpd $perencanaan_kinerja_rkpd)
    {
        $perencanaan_kinerja_rkpd->deleteFile();
        $perencanaan_kinerja_rkpd->delete();

        session()->flash('success');
        return redirect(route('perencanaan_kinerja_rkpd.index'));
    }
}
