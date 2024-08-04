<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerancanaanKinerja\CreateCascadingKinerjaOpdRequest;
use App\Http\Requests\PerancanaanKinerja\UpdateCascadingKinerjaOpdRequest;
use App\Models\Opd;
use App\Models\PerencanaanKinerja\CascadingKinerjaOpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('permission:opdCascadingKinerja-list|opdCascadingKinerja-create|opdCascadingKinerja-edit|opdCascadingKinerja-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdCascadingKinerja-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdCascadingKinerja-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdCascadingKinerja-delete', ['only' => ['destroy']]);
        $name = "Pohon Kinerja OPD";
        view()->share('name', $name);
    }
    public function index(Request $request)
    {

        if (Auth::user()->opd_id) {
            $cascadingKinerjaOpds = CascadingKinerjaOpd::where('opd_id', Auth::user()->opd_id)->orderBy('year', 'desc')->paginate();
        } else {
            $cascadingKinerjaOpds = CascadingKinerjaOpd::orderBy('year', 'desc')->paginate();
        }
        return view('perencanaan_kinerja.opd.cascading_kinerja.index', compact('cascadingKinerjaOpds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
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
        $data = $request->validate([
            'opd_id' => 'required',
            'file' => 'required|max:100000|mimes:pdf',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $nama_file = "POHON_KINERJA_OPD_" . $data['opd_id'];
            $fileName = 'POHON_KINERJA_OPD/' . date('mdYHis') . '-' . $nama_file . '.' . $fileExtension;
            $file->storeAs('', $fileName, 'public_uploads');
            $data['file'] = $fileName;
        }
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
        $opds = Opd::getOpd();
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
        $data = $request->validate([
            'opd_id' => 'required',
            'file' => 'required|max:100000|mimes:pdf',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $nama_file = "POHON_KINERJA_OPD_" . $data['opd_id'];
            $fileName = 'POHON_KINERJA_OPD/' . date('mdYHis') . '-' . $nama_file . '.' . $fileExtension;
            $file->storeAs('', $fileName, 'public_uploads');
            $data['file'] = $fileName;
        }
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
