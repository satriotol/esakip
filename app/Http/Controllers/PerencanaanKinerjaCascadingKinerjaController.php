<?php

namespace App\Http\Controllers;

use App\Http\Requests\CascadingKinerja\CreateCascadingKinerja;
use App\Http\Requests\CascadingKinerja\UpdateCascadingKinerja;
use App\Models\PerencanaanKinerjaCascadingKinerja;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PerencanaanKinerjaCascadingKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCascadingKinerjas(Request $request)
    {
        if ($request->ajax()) {
            $cascading_kinerjas = PerencanaanKinerjaCascadingKinerja::all();
            return DataTables::of($cascading_kinerjas)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('cascading_kinerja.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('cascading_kinerja.destroy', $row->id) . '" method="POST"
                            class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">
                            Delete
                            </button>
                        </form>';
                    return $btn;
                })
                ->rawColumns(['pdf', 'action'])
                ->make(true);
        }
    }
    public function index()
    {
        return view('cascading_kinerja.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cascading_kinerja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCascadingKinerja $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $data['file'] = $file;
        };
        PerencanaanKinerjaCascadingKinerja::create($data);
        session()->flash('success');
        return redirect(route('cascading_kinerja.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerjaCascadingKinerja  $perencanaanKinerjaCascadingKinerja
     * @return \Illuminate\Http\Response
     */
    public function show(PerencanaanKinerjaCascadingKinerja $perencanaanKinerjaCascadingKinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerjaCascadingKinerja  $perencanaanKinerjaCascadingKinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(PerencanaanKinerjaCascadingKinerja $cascading_kinerja)
    {
        return view('cascading_kinerja.create', compact('cascading_kinerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerjaCascadingKinerja  $perencanaanKinerjaCascadingKinerja
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCascadingKinerja $request, PerencanaanKinerjaCascadingKinerja $cascading_kinerja)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $cascading_kinerja->deleteFile();
            $data['file'] = $file;
        };
        $cascading_kinerja->update($data);
        session()->flash('success');
        return redirect(route('cascading_kinerja.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerencanaanKinerjaCascadingKinerja  $perencanaanKinerjaCascadingKinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerencanaanKinerjaCascadingKinerja $cascading_kinerja)
    {
        $cascading_kinerja->delete();
        $cascading_kinerja->deleteFile();
        session()->flash('success');
        return redirect(route('cascading_kinerja.index'));
    }
}
