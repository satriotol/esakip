<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerja\CreateRenstraOpdRequest;
use App\Http\Requests\PerencanaanKinerja\UpdateRenstraOpdRequest;
use App\Models\Opd;
use App\Models\PerencanaanKinerja\PeriodeRenstraOpd;
use App\Models\PerencanaanKinerja\RenstraOpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RenstraOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PeriodeRenstraOpd $periodeRenstraOpd)
    {
        if (Auth::user()->opd_id) {
            $renstraOpds = RenstraOpd::where('periode_renstra_opd_id', $periodeRenstraOpd->id)->where('opd_id', Auth::user()->opd_id)->get();
        }else{
            $renstraOpds = RenstraOpd::where('periode_renstra_opd_id', $periodeRenstraOpd->id)->get();
            
        }
        return view('perencanaan_kinerja.opd.renstra.renstra_detail.index', compact('renstraOpds', 'periodeRenstraOpd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PeriodeRenstraOpd $periodeRenstraOpd)
    {
        $opds = Opd::getOpd();
        return view('perencanaan_kinerja.opd.renstra.renstra_detail.create', compact('periodeRenstraOpd', 'opds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($periodeRenstraOpd, CreateRenstraOpdRequest $request)
    {
        $data = $request->all();
        $data['periode_renstra_opd_id'] = $periodeRenstraOpd;
        $data['file'] = $request->file;
        RenstraOpd::create($data);
        session()->flash('success');
        return redirect(route('renstraOpd.index', $periodeRenstraOpd));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\RenstraOpd  $renstraOpd
     * @return \Illuminate\Http\Response
     */
    public function show(RenstraOpd $renstraOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerja\RenstraOpd  $renstraOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(PeriodeRenstraOpd $periodeRenstraOpd, RenstraOpd $renstraOpd)
    {
        $opds = Opd::getOpd();
        return view('perencanaan_kinerja.opd.renstra.renstra_detail.create', compact('renstraOpd', 'periodeRenstraOpd', 'opds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerja\RenstraOpd  $renstraOpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRenstraOpdRequest $request, $periodeRenstraOpd, RenstraOpd $renstraOpd)
    {
        $data = $request->all();
        $data['periode_renstra_opd_id'] = $periodeRenstraOpd;
        if ($request->file) {
            $data['file'] = $request->file;
            $renstraOpd->deleteFile();
        };
        $renstraOpd->update($data);
        session()->flash('success');
        return redirect(route('renstraOpd.index', $periodeRenstraOpd));
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
     * @param  \App\Models\PerencanaanKinerja\RenstraOpd  $renstraOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(RenstraOpd $renstraOpd)
    {
        $renstraOpd->delete();
        $renstraOpd->deleteFile();
        session()->flash('success');
        return redirect(route('renstraOpd.index', $renstraOpd->periode_renstra_opd_id));
    }
}
