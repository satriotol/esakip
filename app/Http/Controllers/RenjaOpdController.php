<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerja\CreateRenjaOpdRequest;
use App\Http\Requests\PerencanaanKinerja\UpdateRenjaOpdRequest;
use App\Models\Opd;
use App\Models\PerencanaanKinerja\RenjaOpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('permission:opdRenja-list|opdRenja-create|opdRenja-edit|opdRenja-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdRenja-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdRenja-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdRenja-delete', ['only' => ['destroy']]);
        $name = "Perencanaan Kinerja RENJA OPD";
        view()->share('name', $name);
    }

    public function index()
    {
        if (Auth::user()->opd_id) {
            $renja_opds = RenjaOpd::with('opd')->where('opd_id', Auth::user()->opd_id)->orderBy('year', 'desc')->paginate();
        } else {
            $renja_opds = RenjaOpd::with('opd')->orderBy('year', 'desc')->paginate();
        }
        return view('perencanaan_kinerja.opd.renja.index', compact('renja_opds'));
    }

    public function getRenjaOpd(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->opd_id) {
                $renjaOpd = RenjaOpd::with('opd')->where('opd_id', Auth::user()->opd_id)->get();
            } else {
                $renjaOpd = RenjaOpd::with('opd')->get();
            }
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
        $opds = Opd::getOpd();
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
        $data = $request->validate([
            'opd_id' => 'required',
            'file' => 'required|max:10000|mimes:pdf',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $nama_file = "RENJA_OPD_" . $data['opd_id'];
            $fileName = 'RENJA_OPD/' . date('mdYHis') . '-' . $nama_file . '.' . $fileExtension;
            $file->storeAs('', $fileName, 'public_uploads');
            $data['file'] = $fileName;
        }
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
        $opds = Opd::getOpd();
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
        $data = $request->validate([
            'opd_id' => 'required',
            'file' => 'required|max:10000|mimes:pdf',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required'
        ]);
        if ($request->hasFile('file')) {
            $renjaOpd->deleteFile();
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $nama_file = "RENJA_OPD_" . $data['opd_id'];
            $fileName = 'RENJA_OPD/' . date('mdYHis') . '-' . $nama_file . '.' . $fileExtension;
            $file->storeAs('', $fileName, 'public_uploads');
            $data['file'] = $fileName;
        }
        $renjaOpd->update($data);
        session()->flash('success');
        return redirect(route('renjaOpd.index'));
    }
    public function store_file(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $data['file'] = $file;
            return $file;
        };
        return abort(422, "Maksimal 2MB");
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
