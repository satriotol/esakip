<?php

namespace App\Http\Controllers;

use App\Models\InovasiPrestasiDaerah;
use Illuminate\Http\Request;

class InovasiPrestasiDaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:inovasiPrestasiDaerah-list|inovasiPrestasiDaerah-create|inovasiPrestasiDaerah-edit|inovasiPrestasiDaerah-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:inovasiPrestasiDaerah-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:inovasiPrestasiDaerah-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:inovasiPrestasiDaerah-delete', ['only' => ['destroy']]);
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
    public function create()
    {
        $inovasiPrestasiDaerah = InovasiPrestasiDaerah::first();
        if ($inovasiPrestasiDaerah) {
            return view('inovasiPrestasiDaerah.create', compact('inovasiPrestasiDaerah'));
        }
        return view('inovasiPrestasiDaerah.create');
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
            'nilai' => 'required',
        ]);
        InovasiPrestasiDaerah::create($data);
        session()->flash('success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InovasiPrestasiDaerah  $inovasiPrestasiDaerah
     * @return \Illuminate\Http\Response
     */
    public function show(InovasiPrestasiDaerah $inovasiPrestasiDaerah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InovasiPrestasiDaerah  $inovasiPrestasiDaerah
     * @return \Illuminate\Http\Response
     */
    public function edit(InovasiPrestasiDaerah $inovasiPrestasiDaerah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InovasiPrestasiDaerah  $inovasiPrestasiDaerah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InovasiPrestasiDaerah $inovasiPrestasiDaerah)
    {
        $data = $request->validate([
            'nilai' => 'required'
        ]);
        $inovasiPrestasiDaerah->update($data);
        session()->flash('success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InovasiPrestasiDaerah  $inovasiPrestasiDaerah
     * @return \Illuminate\Http\Response
     */
    public function destroy(InovasiPrestasiDaerah $inovasiPrestasiDaerah)
    {
        //
    }
}
