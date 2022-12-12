<?php

namespace App\Http\Controllers;

use App\Models\Error;
use App\Models\InovasiPrestasiOpd;
use App\Models\Opd;
use App\Models\OpdCategory;
use App\Models\OpdPenilaian;
use App\Models\OpdPenilaianIku;
use App\Models\OpdPenilaianKinerja;
use App\Models\OpdPenilaianReport;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OpdPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:opdPenilaian-list|opdPenilaian-create|opdPenilaian-edit|opdPenilaian-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:opdPenilaian-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdPenilaian-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdPenilaian-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $opds = Opd::getOpd();
        $opdPenilaians = OpdPenilaian::getOpdPenilaian($request, '');
        $opdCategories = OpdCategory::all();
        $statuses = OpdPenilaian::STATUSALL;
        $request->flash();
        return view('opdPenilaian.index', compact('opdPenilaians', 'opds', 'opdCategories', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
        $opdCategories = OpdCategory::all();
        $opdPerjanjianKinerjas = OpdPerjanjianKinerja::getPerjanjianKinerjas();
        $inovasiPrestasiOpds = InovasiPrestasiOpd::getByOpdStatus();
        return view('opdPenilaian.create', compact('opds', 'opdCategories', 'opdPerjanjianKinerjas', 'inovasiPrestasiOpds'));
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
            'opd_id' => 'required',
            'opd_category_id' => 'required',
            'year' => 'required',
            'inovasi_prestasi_daerah' => 'nullable',
            'opd_perjanjian_kinerja_id' => 'nullable',
            'inovasi_prestasi_opd_id' => 'nullable',
        ]);
        $data['status'] = OpdPenilaian::STATUS1;
        if (OpdPenilaian::ifTahunan($request->opd_category_id)) {
            $data['inovasi_prestasi_daerah'] = InovasiPrestasiOpd::where('id', $request->inovasi_prestasi_opd_id)->first()->inovasi_prestasi_tingkat->value;
            OpdPenilaian::create($data);
        } else {
            $triwulans = ['TRIWULAN 1', 'TRIWULAN 2', 'TRIWULAN 3', 'TRIWULAN 4'];
            foreach ($triwulans as $triwulan) {
                OpdPenilaian::create([
                    'name' => $triwulan,
                    'opd_id' => $data['opd_id'],
                    'opd_category_id' => $data['opd_category_id'],
                    'year' => $data['year'],
                    'status' => $data['status'],
                    'opd_perjanjian_kinerja_id' => $data['opd_perjanjian_kinerja_id'],
                ]);
            }
        }
        session()->flash('success');
        return redirect(route('opdPenilaian.index'));
    }
    public function storeReport(Request $request)
    {
        $data = $request->validate([
            'data.*.catatan' => 'nullable',
            'data.*.rekomendasi' => 'nullable',
            'data.*.opd_penilaian_kinerja' => 'required',
        ]);
        DB::beginTransaction();
        try {
            foreach ($request->data as $d) {
                OpdPenilaianReport::updateOrCreate([
                    'opd_penilaian_kinerja_id' => $d['opd_penilaian_kinerja'],
                    'user_id' => Auth::user()->id,
                ], [
                    'catatan' => $d['catatan'],
                    'rekomendasi' => $d['rekomendasi'],
                ]);
            }
            DB::commit();
        } catch (Exception $exception) {
            Error::createError($exception);
        }

        session()->flash('success');
        return back();
    }

    public function updateStatus(Request $request, OpdPenilaian $opdPenilaian)
    {
        $data = $request->validate([
            'status' => 'required',
            'note' => 'nullable',
        ]);
        $opdPenilaian->update($data);
        session()->flash('success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaian $opdPenilaian)
    {
        $getOpdPerjanjianKinerjaIndikators = OpdPenilaian::getOpdPerjanjianKinerjaIndikator($opdPenilaian);
        $checkStatus = OpdPenilaianKinerja::checkStatus($opdPenilaian);
        $statuses = OpdPenilaian::STATUSESVERIF;
        $ikuTypes = OpdPenilaianIku::TYPES;
        if ($opdPenilaian->checkStatusReport()) {
            return redirect(route('opdPenilaian.showReport', $opdPenilaian->id));
        } else {
            return view('opdPenilaian.show', compact('opdPenilaian', 'statuses', 'checkStatus', 'ikuTypes', 'getOpdPerjanjianKinerjaIndikators'));
        }
    }
    public function showReport(OpdPenilaian $opdPenilaian)
    {
        $getOpdPerjanjianKinerjaIndikators = OpdPenilaian::getOpdPerjanjianKinerjaIndikator($opdPenilaian);
        $checkStatus = OpdPenilaianKinerja::checkStatus($opdPenilaian);
        $statuses = OpdPenilaian::STATUSESVERIF;
        $ikuTypes = OpdPenilaianIku::TYPES;
        if ($opdPenilaian->checkStatusReport()) {
            return view('opdPenilaian.showReport', compact('opdPenilaian', 'statuses', 'checkStatus', 'ikuTypes', 'getOpdPerjanjianKinerjaIndikators'));
        } else {
            return redirect(route('opdPenilaian.show', $opdPenilaian->id));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPenilaian $opdPenilaian)
    {
        $opds = Opd::getOpd();
        $opdCategories = OpdCategory::all();
        return view('opdPenilaian.create', compact('opdPenilaian', 'opds', 'opdCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdPenilaian $opdPenilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaian $opdPenilaian)
    {
        $opdPenilaian->delete();
        session()->flash('success');
        return back();
    }
}
