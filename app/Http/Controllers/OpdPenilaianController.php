<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\OpdPenilaian;
use Illuminate\Http\Request;

class OpdPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:opdPenilaian-list|opdPenilaian-create|opdPenilaian-edit|opdPenilaian-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdPenilaian-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdPenilaian-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdPenilaian-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $opdPenilaians = OpdPenilaian::getOpdPenilaian();
        return view('opdPenilaian.index', compact('opdPenilaians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
        return view('opdPenilaian.create', compact('opds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'opd_id' => 'required',
            'year' => 'required',
        ]);
        OpdPenilaian::create($request->all());
        session()->flash('success');
        return redirect(route('opdPenilaian.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaian $opdPenilaian)
    {
        //
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
        return view('opdPenilaian.create', compact('opdPenilaian', 'opds'));
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
        $request->validate([
            'opd_id' => 'required',
            'year' => 'required',
        ]);
        $opdPenilaian->update($request->all());
        session()->flash('success');
        return redirect(route('opdPenilaian.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaian $opdPenilaian)
    {
        //
    }
}
