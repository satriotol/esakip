<?php

namespace App\Http\Controllers;

use App\Models\InovasiPrestasiOpd;
use App\Models\Opd;
use Illuminate\Http\Request;

class InovasiPrestasiOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:inovasiPrestasiOpd-list|inovasiPrestasiOpd-create|inovasiPrestasiOpd-edit|inovasiPrestasiOpd-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:inovasiPrestasiOpd-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:inovasiPrestasiOpd-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:inovasiPrestasiOpd-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $inovasiPrestasiOpds = InovasiPrestasiOpd::all();
        return view('inovasiPrestasiOpd.index', compact('inovasiPrestasiOpds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
        return view('inovasiPrestasiOpd.create', compact('opds'));
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
            'opd_id' => 'required',
            'date' => 'required|date',
            'year' => 'required',
            'instansi_pemberi' => 'nullable',
            'description' => 'nullable',
            'file' => 'nullable'
        ]);
        $data['file'] = $request->file;
        InovasiPrestasiOpd::create($data);
        session()->flash('success');
        return redirect(route('inovasiPrestasiOpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InovasiPrestasiOpd  $inovasiPrestasiOpd
     * @return \Illuminate\Http\Response
     */
    public function show(InovasiPrestasiOpd $inovasiPrestasiOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InovasiPrestasiOpd  $inovasiPrestasiOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(InovasiPrestasiOpd $inovasiPrestasiOpd)
    {
        $opds = Opd::getOpd();
        return view('inovasiPrestasiOpd.create', compact('inovasiPrestasiOpd', 'opds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InovasiPrestasiOpd  $inovasiPrestasiOpd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InovasiPrestasiOpd $inovasiPrestasiOpd)
    {
        $data = $request->validate([
            'name' => 'required',
            'opd_id' => 'required',
            'date' => 'required|date',
            'year' => 'required',
            'instansi_pemberi' => 'nullable',
            'description' => 'nullable',
            'file' => 'nullable'
        ]);
        if ($request->file) {
            $data['file'] = $request->file;
        }
        $inovasiPrestasiOpd->update($data);
        session()->flash('success');
        return redirect(route('inovasiPrestasiOpd.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InovasiPrestasiOpd  $inovasiPrestasiOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(InovasiPrestasiOpd $inovasiPrestasiOpd)
    {
        $inovasiPrestasiOpd->delete();
        session()->flash('success');
        return back();
    }
}