<?php

namespace App\Http\Controllers;

use App\Models\OpdCategory;
use App\Models\OpdCategoryVariable;
use App\Models\OpdVariable;
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
        $opdVariables = OpdVariable::orderBy('name', 'asc')->get();
        $types = OpdCategory::TYPES;
        return view('opdCategories.create', compact('opdVariables', 'types'));
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
            'type' => 'required',
            'opd_variable_id' => 'required',
        ]);
        $opdCategory = OpdCategory::create($data);
        foreach ($request->opd_variable_id as $opd_variable_id) {
            OpdCategoryVariable::create([
                'opd_variable_id' => $opd_variable_id,
                'opd_category_id' => $opdCategory->id
            ]);
        }

        session()->flash('success');
        return redirect(route('opdCategories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(OpdCategory $opdCategory)
    {
        $opdVariables = OpdVariable::orderBy('name', 'asc')->get();
        $types = OpdCategory::TYPES;
        return view('opdCategories.show', compact('opdCategory', 'opdVariables', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdCategory $opdCategory)
    {
        $types = OpdCategory::TYPES;
        $opdVariables = OpdVariable::orderBy('name', 'asc')->get();
        return view('opdCategories.create', compact('opdCategory', 'types', 'opdVariables'));
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
            'type' => 'required',
        ]);

        $opdCategory->update($data);
        session()->flash('success');
        return back();
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
