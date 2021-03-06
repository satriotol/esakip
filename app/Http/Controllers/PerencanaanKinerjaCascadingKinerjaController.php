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
    public function __construct()
    {
        $this->middleware('permission:kotaCascadingKinerja-list|kotaCascadingKinerja-create|kotaCascadingKinerja-edit|kotaCascadingKinerja-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kotaCascadingKinerja-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kotaCascadingKinerja-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kotaCascadingKinerja-delete', ['only' => ['destroy']]);
    }
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
        $data['file'] = $request->file;
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
        if ($request->file) {
            $data['file'] = $request->file;
            $cascading_kinerja->deleteFile();
        };
        $cascading_kinerja->update($data);
        session()->flash('success');
        return redirect(route('cascading_kinerja.index'));
    }

    public function store_file(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = date('Ymd_His') . '-' . $file->getClientOriginalName();
            $data['file'] = $file->storeAs('file', $filename, 'public_uploads');
            return $data['file'];
        };
        return 'success';
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
