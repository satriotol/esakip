<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerjaRkpd\CreatePerencanaanKinerjaRkpd;
use App\Http\Requests\PerencanaanKinerjaRkpd\UpdatePerencanaanKinerjaRkpd;
use App\Models\PerencanaanKinerjaRkpd;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PerencanaanKinerjaRkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:kotaRkpd-list|kotaRkpd-create|kotaRkpd-edit|kotaRkpd-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kotaRkpd-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kotaRkpd-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kotaRkpd-delete', ['only' => ['destroy']]);
    }
    public function getRkpds(Request $request)
    {
        if ($request->ajax()) {
            $rkpds = PerencanaanKinerjaRkpd::all();
            return DataTables::of($rkpds)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('perencanaan_kinerja_rkpd.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('perencanaan_kinerja_rkpd.destroy', $row->id) . '" method="POST"
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
        $perencanaan_kinerja_rkpds = PerencanaanKinerjaRkpd::all();
        return view('perencanaan_kinerja_rkpd.index', compact('perencanaan_kinerja_rkpds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perencanaan_kinerja_rkpd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePerencanaanKinerjaRkpd $request)
    {
        $data = $request->all();
        $data['file'] = $request->file;
        PerencanaanKinerjaRkpd::create($data);
        session()->flash('success');
        return redirect(route('perencanaan_kinerja_rkpd.index'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerjaRkpd  $perencanaanKinerjaRkpd
     * @return \Illuminate\Http\Response
     */
    public function show(PerencanaanKinerjaRkpd $perencanaanKinerjaRkpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerjaRkpd  $perencanaanKinerjaRkpd
     * @return \Illuminate\Http\Response
     */
    public function edit(PerencanaanKinerjaRkpd $perencanaan_kinerja_rkpd)
    {
        return view('perencanaan_kinerja_rkpd.create', compact('perencanaan_kinerja_rkpd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerjaRkpd  $perencanaanKinerjaRkpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerencanaanKinerjaRkpd $request, PerencanaanKinerjaRkpd $perencanaan_kinerja_rkpd)
    {
        $data = $request->all();
        if ($request->file) {
            $data['file'] = $request->file;
            $perencanaan_kinerja_rkpd->deleteFile();
        };
        $perencanaan_kinerja_rkpd->update($data);
        session()->flash('success');
        return redirect(route('perencanaan_kinerja_rkpd.index'));
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
     * @param  \App\Models\PerencanaanKinerjaRkpd  $perencanaanKinerjaRkpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerencanaanKinerjaRkpd $perencanaan_kinerja_rkpd)
    {
        $perencanaan_kinerja_rkpd->deleteFile();
        $perencanaan_kinerja_rkpd->delete();

        session()->flash('success');
        return redirect(route('perencanaan_kinerja_rkpd.index'));
    }
}
