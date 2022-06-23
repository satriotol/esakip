<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengukuranKinerja\CreateIkuOpdRequest;
use App\Http\Requests\PengukuranKinerja\UpdateIkuOpdRequest;
use App\Models\Opd;
use App\Models\PengukuranKinerja\IkuOpd;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IkuOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $name = "Pengukuran Kinerja IKU OPD";
        view()->share('name', $name);
    }
    public function getIkuOpd(Request $request)
    {
        if ($request->ajax()) {
            $ikuOpd = IkuOpd::with('opd')->get();
            return DataTables::of($ikuOpd)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('ikuOpd.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('ikuOpd.destroy', $row->id) . '" method="POST"
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
        return view('pengukuran_kinerja.opd.iku.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::all();
        return view('pengukuran_kinerja.opd.iku.create', compact('opds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIkuOpdRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $data['file'] = $file;
        };
        IkuOpd::create($data);
        session()->flash('success');
        return redirect(route('ikuOpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengukuranKinerja\IkuOpd  $ikuOpd
     * @return \Illuminate\Http\Response
     */
    public function show(IkuOpd $ikuOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengukuranKinerja\IkuOpd  $ikuOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(IkuOpd $ikuOpd)
    {
        $opds = Opd::all();
        return view('pengukuran_kinerja.opd.iku.create', compact('opds', 'ikuOpd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengukuranKinerja\IkuOpd  $ikuOpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIkuOpdRequest $request, IkuOpd $ikuOpd)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $ikuOpd->deleteFile();
            $data['file'] = $file;
        };
        $ikuOpd->update($data);
        session()->flash('success');
        return redirect(route('ikuOpd.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengukuranKinerja\IkuOpd  $ikuOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(IkuOpd $ikuOpd)
    {
        $ikuOpd->delete();
        $ikuOpd->deleteFile();
        session()->flash('success');
        return redirect(route('ikuOpd.index'));
    }
}
