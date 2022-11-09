<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\OpdCategory;
use App\Models\OpdPenilaian;
use App\Models\OpdPenilaianIku;
use App\Models\OpdPenilaianKinerja;
use App\Models\OpdPenilaianReport;
use Illuminate\Http\Request;

class OpdPenilaianReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $this->middleware('permission:opdPenilaianReport-list|opdPenilaianReport-create|opdPenilaianReport-edit|opdPenilaianReport-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdPenilaianReport-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdPenilaianReport-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdPenilaianReport-delete', ['only' => ['destroy']]);
        $name = "Perjanjian Kinerja OPD";
        view()->share('name', $name);
    }
    public function index(Request $request)
    {
        $opds = Opd::getOpd();
        $opdPenilaianReports = OpdPenilaian::getOpdPenilaian($request, 'VERIFIKASI');
        $opdCategories = OpdCategory::all();
        $statuses = OpdPenilaian::STATUSES;
        $request->flash();
        return view('opdPenilaianReport.index', compact('opdPenilaianReports', 'opds', 'opdCategories', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaianReport  $opdPenilaianReport
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaian $opdPenilaian)
    {
        $getOpdPerjanjianKinerjaIndikators = OpdPenilaian::getOpdPerjanjianKinerjaIndikator($opdPenilaian);
        $checkStatus = OpdPenilaianKinerja::checkStatus($opdPenilaian);
        $statuses = OpdPenilaian::STATUSESVERIF;
        $ikuTypes = OpdPenilaianIku::TYPES;
        dd($opdPenilaian);
        return view('opdPenilaianReport.show', compact('opdPenilaian', 'statuses', 'checkStatus', 'ikuTypes', 'getOpdPerjanjianKinerjaIndikators'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPenilaianReport  $opdPenilaianReport
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPenilaianReport $opdPenilaianReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPenilaianReport  $opdPenilaianReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdPenilaianReport $opdPenilaianReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPenilaianReport  $opdPenilaianReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaianReport $opdPenilaianReport)
    {
        //
    }
}
