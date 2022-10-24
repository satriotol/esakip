<?php

namespace App\Http\Controllers;

use App\Models\OpdCategoryVariable;
use Illuminate\Http\Request;

class OpdCategoryVariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data = $request->validate([
            'opd_category_id' => 'required',
            'opd_variable_id' => 'required',
        ]);

        OpdCategoryVariable::updateOrCreate([
            'opd_category_id' => $data['opd_category_id'],
            'opd_variable_id' => $data['opd_variable_id'],
        ]);
        session()->flash('success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdCategoryVariable  $opdCategoryVariable
     * @return \Illuminate\Http\Response
     */
    public function show(OpdCategoryVariable $opdCategoryVariable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdCategoryVariable  $opdCategoryVariable
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdCategoryVariable $opdCategoryVariable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdCategoryVariable  $opdCategoryVariable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdCategoryVariable $opdCategoryVariable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdCategoryVariable  $opdCategoryVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdCategoryVariable $opdCategoryVariable)
    {
        $opdCategoryVariable->delete();
        session()->flash('success');
        return back();
    }
}
