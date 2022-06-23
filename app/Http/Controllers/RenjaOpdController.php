<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerja\CreateRenjaOpdRequest;
use App\Http\Requests\PerencanaanKinerja\UpdateRenjaOpdRequest;
use App\Models\Opd;
use App\Models\PerencanaanKinerja\RenjaOpd;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RenjaOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $name = "Perencanaan Kinerja RENJA OPD";
        view()->share('name', $name);
    }

    public function index()
    {
        return view('perencanaan_kinerja.opd.renja.index');
    }

    public function getRenjaOpd(Request $request)
    {
        if ($request->ajax()) {
            $renjaOpd = RenjaOpd::with('opd')->get();
            return DataTables::of($renjaOpd)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('renjaOpd.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('renjaOpd.destroy', $row->id) . '" method="POST"
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::all();
        $types = RenjaOpd::TYPE;
        return view('perencanaan_kinerja.opd.renja.create', compact('opds', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRenjaOpdRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $data['file'] = $file;
        };
        RenjaOpd::create($data);
        session()->flash('success');
        return redirect(route('renjaOpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\RenjaOpd  $renjaOpd
     * @return \Illuminate\Http\Response
     */
    public function show(RenjaOpd $renjaOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\RenjaOpd  $renjaOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(RenjaOpd $renjaOpd)
    {
        $types = RenjaOpd::TYPE;
        $opds = Opd::all();
        return view('perencanaan_kinerja.opd.renja.create', compact('renjaOpd', 'types', 'opds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerja\RenjaOpd  $renjaOpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRenjaOpdRequest $request, RenjaOpd $renjaOpd)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $renjaOpd->deleteFile();
            $data['file'] = $file;
        };
        $renjaOpd->update($data);
        session()->flash('success');
        return redirect(route('renjaOpd.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerencanaanKinerja\RenjaOpd  $renjaOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(RenjaOpd $renjaOpd)
    {
        $renjaOpd->delete();
        $renjaOpd->deleteFile();
        session()->flash('success');
        return redirect(route('renjaOpd.index'));
    }
}
