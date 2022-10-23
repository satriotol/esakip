<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelaporanKinerja\Opd\CreateLkjipOpdRequest;
use App\Http\Requests\PelaporanKinerja\Opd\UpdateLkjipOpdRequest;
use App\Models\Opd;
use App\Models\PelaporanKinerja\LkjipOpd;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LkjipOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:opdLkjip-list|opdLkjip-create|opdLkjip-edit|opdLkjip-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdLkjip-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdLkjip-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdLkjip-delete', ['only' => ['destroy']]);
    }
    public function getLkjipOpd(Request $request)
    {
        if ($request->ajax()) {
            $lkjip_opd = LkjipOpd::with('opd')->get();
            return DataTables::of($lkjip_opd)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('lkjip_opd.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('lkjip_opd.destroy', $row->id) . '" method="POST"
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
        return view('pelaporan_kinerja.lkjip_opd.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
        return view('pelaporan_kinerja.lkjip_opd.create', compact('opds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLkjipOpdRequest $request)
    {
        $data = $request->all();
        $data['file'] = $request->file;

        LkjipOpd::create($data);
        session()->flash('success');
        return redirect(route('lkjip_opd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelaporanKinerja\LkjipOpd  $lkjipOpd
     * @return \Illuminate\Http\Response
     */
    public function show(LkjipOpd $lkjipOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelaporanKinerja\LkjipOpd  $lkjipOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(LkjipOpd $lkjip_opd)
    {
        $opds = Opd::getOpd();
        return view('pelaporan_kinerja.lkjip_opd.create', compact('lkjip_opd', 'opds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelaporanKinerja\LkjipOpd  $lkjipOpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLkjipOpdRequest $request, LkjipOpd $lkjip_opd)
    {
        $data = $request->all();
        if ($request->file) {
            $data['file'] = $request->file;
            $lkjip_opd->deleteFile();
        };
        $lkjip_opd->update($data);
        session()->flash('success');
        return redirect(route('lkjip_opd.index'));
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
     * @param  \App\Models\PelaporanKinerja\LkjipOpd  $lkjipOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(LkjipOpd $lkjip_opd)
    {
        $lkjip_opd->deleteFile();
        $lkjip_opd->delete();
        session()->flash('success');
        return redirect(route('lkjip_opd.index'));
    }
}
