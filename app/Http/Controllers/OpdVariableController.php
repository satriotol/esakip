<?php

namespace App\Http\Controllers;

use App\Models\OpdVariable;
use Illuminate\Http\Request;

class OpdVariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:opdVariable-list|opdVariable-create|opdVariable-edit|opdVariable-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdVariable-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdVariable-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdVariable-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $opdVariables = OpdVariable::all();
        return view('opdVariable.index', compact('opdVariables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pics = OpdVariable::PICS;
        return view('opdVariable.create', compact('pics'));
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
            'bobot' => 'required',
            'pic' => 'required',
            'is_efisiensi' => 'nullable',
            'is_range' => 'nullable',
        ]);
        OpdVariable::create($data);
        session()->flash('success');
        return redirect(route('opdVariable.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdVariable  $opdVariable
     * @return \Illuminate\Http\Response
     */
    public function show(OpdVariable $opdVariable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdVariable  $opdVariable
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdVariable $opdVariable)
    {
        $pics = OpdVariable::PICS;
        return view('opdVariable.create', compact('opdVariable', 'pics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdVariable  $opdVariable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdVariable $opdVariable)
    {
        $data = $request->validate([
            'name' => 'required',
            'bobot' => 'required',
            'pic' => 'required',
            'is_efisiensi' => 'nullable',
            'is_range' => 'nullable',

        ]);
        $opdVariable->update($data);
        session()->flash('success');
        return redirect(route('opdVariable.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdVariable  $opdVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdVariable $opdVariable)
    {
        $opdVariable->delete();
        session()->flash('success');
        return back();
    }
}
