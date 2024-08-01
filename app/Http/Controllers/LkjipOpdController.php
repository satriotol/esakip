<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelaporanKinerja\Opd\CreateLkjipOpdRequest;
use App\Http\Requests\PelaporanKinerja\Opd\UpdateLkjipOpdRequest;
use App\Models\Opd;
use App\Models\PelaporanKinerja\LkjipOpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function index()
    {
        if (Auth::user()->opd_id) {
            $lkjipOpds = LkjipOpd::where('opd_id', Auth::user()->opd_id)->orderBy('year', 'desc')->paginate();
        } else {
            $lkjipOpds = LkjipOpd::orderBy('year', 'desc')->paginate();
        }
        return view('pelaporan_kinerja.lkjip_opd.index', compact('lkjipOpds'));
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
