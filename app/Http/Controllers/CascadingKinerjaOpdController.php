<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerancanaanKinerja\CreateCascadingKinerjaOpdRequest;
use App\Http\Requests\PerancanaanKinerja\UpdateCascadingKinerjaOpdRequest;
use App\Models\Opd;
use App\Models\PerencanaanKinerja\CascadingKinerjaOpd;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CascadingKinerjaOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $name = "Cascading Kinerja OPD";
        view()->share('name', $name);
    }
    public function getCascadingKinerjaOpd(Request $request)
    {
        if ($request->ajax()) {
            $cascadingKinerjaOpd = CascadingKinerjaOpd::with('opd')->get();
            return DataTables::of($cascadingKinerjaOpd)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('cascadingKinerjaOpd.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('cascadingKinerjaOpd.destroy', $row->id) . '" method="POST"
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
    public function index(Request $request)
    {
        return view('perencanaan_kinerja.opd.cascading_kinerja.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::all();
        $types = CascadingKinerjaOpd::TYPE;
        return view('perencanaan_kinerja.opd.cascading_kinerja.create', compact('opds', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCascadingKinerjaOpdRequest $request)
    {
        $data = $request->all();
        $data['file'] = $request->file;
        CascadingKinerjaOpd::create($data);
        session()->flash('success');
        return redirect(route('cascadingKinerjaOpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\CascadingKinerjaOpd  $cascadingKinerjaOpd
     * @return \Illuminate\Http\Response
     */
    public function show(CascadingKinerjaOpd $cascadingKinerjaOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\CascadingKinerjaOpd  $cascadingKinerjaOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(CascadingKinerjaOpd $cascadingKinerjaOpd)
    {
        $types = CascadingKinerjaOpd::TYPE;
        $opds = Opd::all();
        return view('perencanaan_kinerja.opd.cascading_kinerja.create', compact('cascadingKinerjaOpd', 'types', 'opds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerja\CascadingKinerjaOpd  $cascadingKinerjaOpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCascadingKinerjaOpdRequest $request, CascadingKinerjaOpd $cascadingKinerjaOpd)
    {
        $data = $request->all();
        if ($request->file) {
            $data['file'] = $request->file;
            $cascadingKinerjaOpd->deleteFile();
        };
        $cascadingKinerjaOpd->update($data);
        session()->flash('success');
        return redirect(route('cascadingKinerjaOpd.index'));
    }
    public function store_file(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $data['file'] = $file;
            return $file;
        };
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerencanaanKinerja\CascadingKinerjaOpd  $cascadingKinerjaOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(CascadingKinerjaOpd $cascadingKinerjaOpd)
    {
        $cascadingKinerjaOpd->delete();
        $cascadingKinerjaOpd->deleteFile();
        session()->flash('success');
        return redirect(route('cascadingKinerjaOpd.index'));
    }
}
