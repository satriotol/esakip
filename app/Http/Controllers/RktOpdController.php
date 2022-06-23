<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerja\CreateRktOpdRequest;
use App\Http\Requests\PerencanaanKinerja\UpdateRktOpdRequest;
use App\Models\Opd;
use App\Models\PerencanaanKinerja\RktOpd;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RktOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // Fetch the Site Settings object
        $name = "Perencanaan Kinerja RKT OPD";
        view()->share('name', $name);
    }

    public function index()
    {

        return view('perencanaan_kinerja.opd.rkt.index');
    }

    public function getRktOpd(Request $request)
    {
        if ($request->ajax()) {
            $rktOpd = RktOpd::all();
            return DataTables::of($rktOpd)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('rktOpd.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('rktOpd.destroy', $row->id) . '" method="POST"
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
        return view('perencanaan_kinerja.opd.rkt.create', compact('opds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRktOpdRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $data['file'] = $file;
        };
        RktOpd::create($data);
        session()->flash('success');
        return redirect(route('rktOpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\RktOpd  $rktOpd
     * @return \Illuminate\Http\Response
     */
    public function show(RktOpd $rktOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\RktOpd  $rktOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(RktOpd $rktOpd)
    {
        $opds = Opd::all();
        return view('perencanaan_kinerja.opd.rkt.create', compact('rktOpd', 'opds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerja\RktOpd  $rktOpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRktOpdRequest $request, RktOpd $rktOpd)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $rktOpd->deleteFile();
            $data['file'] = $file;
        };
        $rktOpd->update($data);
        session()->flash('success');
        return redirect(route('rktOpd.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerencanaanKinerja\RktOpd  $rktOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(RktOpd $rktOpd)
    {
        //
    }
}
