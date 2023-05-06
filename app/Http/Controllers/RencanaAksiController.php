<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use App\Models\RencanaAksi;
use App\Models\RencanaAksiTarget;
use App\Rules\RencanaAksiExist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RencanaAksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $this->middleware('permission:rencanaAksi-list|rencanaAksi-create|rencanaAksi-edit|rencanaAksi-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:rencanaAksi-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rencanaAksi-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rencanaAksi-delete', ['only' => ['destroy']]);
        $name = "Rencana Aksi";
        view()->share('name', $name);
    }
    public function index(Request $request)
    {
        $rencanaAksis = RencanaAksi::getByOpd();
        $opdWithoutRencanaAksis = Opd::opdWithoutRencanaAksis($request);
        if ($request->opd_id) {
            $rencanaAksis->whereHas('opd_perjanjian_kinerja', function ($q) use ($request) {
                $q->where('opd_id', $request->opd_id);
            });
        }
        if ($request->triwulan) {
            $rencanaAksis->where('name', $request->triwulan);
        }
        if ($request->year) {
            $rencanaAksis->whereHas('opd_perjanjian_kinerja', function ($q) use ($request) {
                $q->where('year', $request->year);
            });
        }
        if ($request->status) {
            $status = $request->status;
            if ($status == 'PROSES PENGISIAN RENCANA AKSI OPD') {
                $rencanaAksis->where('status', 'DIAJUKAN')->orWhere('status', null);
            }
            if ($status == 'PROSES PENGISIAN REALISASI OPD') {
                $rencanaAksis->where('status', 'DISETUJUI')->where('status_penilaian', null);
            }
            if ($status == 'PROSES VERIFIKASI') {
                $rencanaAksis->where('status_penilaian', 'SELESAI')->where('status_verifikator', null);
            }
            if ($status == 'SELESAI') {
                $rencanaAksis->where('status_verifikator', 'SELESAI');
            }
        }
        $rencanaAksis =  $rencanaAksis->paginate();
        $statuses = RencanaAksi::STATUSES;
        $opds = Opd::getOpd();
        $request->flash();
        return view('rencanaAksi.index', compact('rencanaAksis', 'statuses', 'opds', 'opdWithoutRencanaAksis'));
    }

    public function updateStatus(RencanaAksi $rencanaAksi, Request $request)
    {
        $data = $request->validate([
            'status' => 'nullable',
            'status_penilaian' => 'nullable',
            'status_verifikator' => 'nullable',
            'note' => 'nullable',
        ]);
        if ($request->status == 'DISETUJUI') {
            if ($rencanaAksi->rencana_aksi_targets->count() == 0) {
                session()->flash('bug', 'Pastikan Sasaran Sudah Terisi');
                return back();
            }
        }
        if ($request->status_penilaian == 'SELESAI') {
            foreach ($rencanaAksi->rencana_aksi_targets as $rencana_aksi_target) {
                if ($rencana_aksi_target->realisasi == null || $rencana_aksi_target->file == null) {
                    session()->flash('bug', 'Lengkapi realisasi / data dukung pada indikator : ' . $rencana_aksi_target->indikator_kinerja_note);
                    return back();
                }
            }
        }
        if ($request->status_verifikator == 'SELESAI') {
            foreach ($rencanaAksi->rencana_aksi_targets as $rencana_aksi_target) {
                if ($rencana_aksi_target->status_verifikator == null) {
                    session()->flash('bug', 'Pastikan Anda Sudah Melakukan Verifikasi Pada : ' . $rencana_aksi_target->indikator_kinerja_note);
                    return back();
                }
            }
        }
        $rencanaAksi->update($data);
        session()->flash('success');
        return back();
    }
    public function updateStatusSelesai($rencanaAksi, Request $request)
    {
        $rencanaAksi = RencanaAksi::where('id', $rencanaAksi)->first();
        $data = $request->validate([
            'status_penilaian' => 'nullable',
            'nilai' => 'nullable',
        ]);
        if ($request->nilai) {
            $data['status_penilaian'] = RencanaAksi::PENILAIAN2;
        } else {
            $data['status_penilaian'] = RencanaAksi::PENILAIAN1;
        }
        $rencanaAksi->update($data);
        session()->flash('success');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $opdPerjanjianKinerjas = OpdPerjanjianKinerja::getPerjanjianKinerjas($request);
        $triwulans = RencanaAksi::TRIWULANS;
        return view('rencanaAksi.create', compact('triwulans', 'opdPerjanjianKinerjas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'opd_perjanjian_kinerja_id' => 'required',
            'slug' => 'nullable',
        ]);
        $rencanaAksi = RencanaAksi::where('name', $request->name)->where('opd_perjanjian_kinerja_id', $request->opd_perjanjian_kinerja_id)->get();
        if ($rencanaAksi->count() == null) {
            $newData = RencanaAksi::create($data);
            session()->flash('success');
            return redirect(route('rencanaAksi.show', $newData->id));
        }
        session()->flash('bug', 'Data Sudah Ada');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function show(RencanaAksi $rencanaAksi)
    {
        $types = RencanaAksiTarget::TYPES;
        $statuses = RencanaAksi::STATUSES;
        $penilaians = RencanaAksi::PENILAIANS;
        return view('rencanaAksi.show', compact('rencanaAksi', 'types', 'statuses', 'penilaians'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function edit(RencanaAksi $rencanaAksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RencanaAksi $rencanaAksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(RencanaAksi $rencanaAksi)
    {
        $rencanaAksi->delete();
        session()->flash('success');
        return back();
    }
}
