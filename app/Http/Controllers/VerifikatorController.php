<?php

namespace App\Http\Controllers;

use App\Models\Verifikator;
use Illuminate\Http\Request;

class VerifikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:verifikator-list|verifikator-create|verifikator-edit|verifikator-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:verifikator-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:verifikator-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:verifikator-delete', ['only' => ['destroy']]);
        $name = "Verifikator";
        view()->share('name', $name);
    }
    public function index()
    {
        $verifikators = Verifikator::all();
        return view('verifikator.index', compact('verifikators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('verifikator.create');
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
            'phone' => 'required',
            'jabatan' => 'required',
        ]);
        Verifikator::create($data);
        session()->flash('success');
        return redirect(route('verifikator.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verifikator  $verifikator
     * @return \Illuminate\Http\Response
     */
    public function show(Verifikator $verifikator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Verifikator  $verifikator
     * @return \Illuminate\Http\Response
     */
    public function edit(Verifikator $verifikator)
    {
        return view('verifikator.create', compact('verifikator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Verifikator  $verifikator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verifikator $verifikator)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'jabatan' => 'required',
        ]);
        $verifikator->update($data);
        session()->flash('success');
        return redirect(route('verifikator.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Verifikator  $verifikator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verifikator $verifikator)
    {
        $verifikator->delete();
        session()->flash('success');
        return back();
    }
}
