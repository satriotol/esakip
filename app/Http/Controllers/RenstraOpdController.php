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
        } else {
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
        $data = $request->validate([
            'opd_id' => 'required',
            'file' => 'required|max:10000|mimes:pdf',
            'periode_renstra_opd_id' => 'nullable',
        ]);

        $data['periode_renstra_opd_id'] = $periodeRenstraOpd;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $nama_file = "RENSTRA_OPD_" . $data['opd_id'];
            $fileName = 'RENSTRA_OPD/' . date('mdYHis') . '-' . $nama_file . '.' . $fileExtension;
            $file->storeAs('', $fileName, 'public_uploads');
            $data['file'] = $fileName;
        }

        RenstraOpd::create($data);

        session()->flash('success', 'Data berhasil disimpan.');

        return redirect()->route('renstraOpd.index', $periodeRenstraOpd);
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
        $data = $request->validate([
            'opd_id' => 'required',
            'file' => 'nullable|max:10000|mimes:pdf',
            'periode_renstra_opd_id' => 'nullable',
        ]);
        $data['periode_renstra_opd_id'] = $periodeRenstraOpd;
        if ($request->hasFile('file')) {
            $renstraOpd->deleteFile();
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $nama_file = "RENSTRA_OPD_" . $data['opd_id'];
            $fileName = 'RENSTRA_OPD/' . date('mdYHis') . '-' . $nama_file . '.' . $fileExtension;
            $file->storeAs('', $fileName, 'public_uploads');
            $data['file'] = $fileName;
        }
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
