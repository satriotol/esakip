<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerja\CreateRktOpdRequest;
use App\Http\Requests\PerencanaanKinerja\UpdateRktOpdRequest;
use App\Models\Opd;
use App\Models\PerencanaanKinerja\RktOpd;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('permission:opdRkt-list|opdRkt-create|opdRkt-edit|opdRkt-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdRkt-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdRkt-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdRkt-delete', ['only' => ['destroy']]);
        $name = "Perencanaan Kinerja RKT OPD";
        view()->share('name', $name);
    }

    public function index()
    {
        if (Auth::user()->opd_id) {
            $rkt_opds = RktOpd::orderBy('year', 'desc')->where('opd_id', Auth::user()->opd_id)->paginate();
        } else {
            $rkt_opds = RktOpd::orderBy('year', 'desc')->paginate();
        }
        return view('perencanaan_kinerja.opd.rkt.index', compact('rkt_opds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
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
        $data = $request->validate([
            'opd_id' => 'required',
            'file' => 'required|max:10000|mimes:pdf',
            'name' => 'required',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $nama_file = "RKT_OPD_" . $data['opd_id'];
            $fileName = 'RKT_OPD/' . date('mdYHis') . '-' . $nama_file . '.' . $fileExtension;
            $file->storeAs('', $fileName, 'public_uploads');
            $data['file'] = $fileName;
        }
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
        $opds = Opd::getOpd();
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
        $data = $request->validate([
            'opd_id' => 'required',
            'file' => 'nullable|max:10000|mimes:pdf',
            'name' => 'required',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $nama_file = "RKT_OPD_" . $data['opd_id'];
            $fileName = 'RKT_OPD/' . date('mdYHis') . '-' . $nama_file . '.' . $fileExtension;
            $file->storeAs('', $fileName, 'public_uploads');
            $data['file'] = $fileName;
            $rktOpd->deleteFile();
        }
        $rktOpd->update($data);
        session()->flash('success');
        return redirect(route('rktOpd.index'));
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
     * @param  \App\Models\PerencanaanKinerja\RktOpd  $rktOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(RktOpd $rktOpd)
    {
        $rktOpd->delete();
        $rktOpd->deleteFile();
        session()->flash('success');
        return redirect(route('rktOpd.index'));
    }
}
