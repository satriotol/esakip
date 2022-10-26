<?php

namespace App\Http\Controllers;

use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use App\Models\RencanaAksi;
use App\Models\RencanaAksiTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RencanaAksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $this->middleware('permission:opdPerjanjianKinerja-list|opdPerjanjianKinerja-create|opdPerjanjianKinerja-edit|opdPerjanjianKinerja-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdPerjanjianKinerja-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdPerjanjianKinerja-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdPerjanjianKinerja-delete', ['only' => ['destroy']]);
        $name = "Rencana Aksi";
        view()->share('name', $name);
    }
    public function index()
    {
        $datas = OpdPerjanjianKinerja::getRencanaAksi();
        $statuses = RencanaAksi::STATUSES;
        $opdPerjanjianKinerjas = $datas->paginate();
        return view('rencanaAksi.index', compact('opdPerjanjianKinerjas', 'statuses'));
    }

    public function updateStatus($rencanaAksi, Request $request)
    {
        $rencanaAksi = RencanaAksi::where('id', $rencanaAksi)->first();
        $data = $request->validate([
            'status' => 'required',
            'note' => 'nullable',
        ]);
        $rencanaAksi->update($data);
        session()->flash('success');
        return back();
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
     * @param  \App\Models\RencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function show($opdPerjanjianKinerja)
    {
        $opdPerjanjianKinerja = OpdPerjanjianKinerja::find($opdPerjanjianKinerja);
        $statuses = RencanaAksiTarget::STATUSES;
        $realisasis = RencanaAksiTarget::REALISASIS;
        return view('rencanaAksi.show', compact('opdPerjanjianKinerja', 'statuses', 'realisasis'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaAksi $rencanaAksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaAksi $rencanaAksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(RencanaAksi $rencanaAksi)
    {
        //
    }
}
