<?php

namespace App\Http\Controllers;

use App\Exports\OpdPenilaianExport;
use App\Models\Error;
use App\Models\InovasiPrestasiOpd;
use App\Models\Month;
use App\Models\Opd;
use App\Models\OpdCategory;
use App\Models\OpdCategoryVariable;
use App\Models\OpdPenilaian;
use App\Models\OpdPenilaianIku;
use App\Models\OpdPenilaianKinerja;
use App\Models\OpdPenilaianReport;
use App\Models\OpdPenilaianStaff;
use App\Models\OpdPenilaianStaffType;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        $opdPenilaians = OpdPenilaian::getOpdPenilaian($request, '')->paginate();
        $opdCategories = OpdCategory::all();
        $statuses = OpdPenilaian::STATUSALL;
        if ($request->submit == 'exportExcel') {
            $nama_file = 'PENILAIAN OPD ' . date('Y-m-d_H-i-s') . '.xlsx';
            return Excel::download(new OpdPenilaianExport($request), $nama_file);
        }
        $request->flash();
        return view('opdPenilaian.index', compact('opdPenilaians', 'opds', 'opdCategories', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $opds = Opd::getOpd();
        $opdCategories = OpdCategory::all();
        $opdPerjanjianKinerjas = OpdPerjanjianKinerja::getPerjanjianKinerjas($request);
        $inovasiPrestasiOpds = InovasiPrestasiOpd::getByOpdStatus();
        $triwulans = OpdPenilaian::TRIWULANS;
        return view('opdPenilaian.create', compact('opds', 'opdCategories', 'opdPerjanjianKinerjas', 'inovasiPrestasiOpds', 'triwulans'));
    }

    public function getOpdPerjanjianKinerjas(Request $request)
    {
        $opd_id = $request->opd_id;
        $opdPerjanjianKinerjas = OpdPerjanjianKinerja::query();
        $opdPerjanjianKinerjas = $opdPerjanjianKinerjas->with('opd')->where('year', $request->year)->where('status', 'DITERIMA')->where('opd_id', $opd_id)->get();
        $inovasiPrestasiOpds = InovasiPrestasiOpd::where('year', $request->year)->with('opd', 'inovasi_prestasi_tingkat')->where('opd_id', $request->opd_id)->where('is_verified', 1)->get();
        return $this->successResponse(['opdPerjanjianKinerjas' => $opdPerjanjianKinerjas, 'inovasiPrestasiOpds' => $inovasiPrestasiOpds]);
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
            'name' => 'nullable',
            'opd_category_id' => 'required',
            'year' => 'required',
            'inovasi_prestasi_daerah' => 'nullable',
            'opd_perjanjian_kinerja_id' => 'nullable',
            'inovasi_prestasi_opd_id' => 'nullable',
        ]);
        if (Opd::where('id', $data['opd_id'])->first()->is_staff_ahli != 1 && $request->opd_perjanjian_kinerja_id == null) {
            session()->flash('bug', 'Perjanjian Kinerja Wajib Diisi');
            return back();
        }
        $data['status'] = OpdPenilaian::STATUS1;
        if ($request->inovasi_prestasi_opd_id) {
            $data['inovasi_prestasi_daerah'] = InovasiPrestasiOpd::where('id', $request->inovasi_prestasi_opd_id)->first()->inovasi_prestasi_tingkat->value;
        }
        OpdPenilaian::create($data);
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
        // DB::beginTransaction();
        // try {
        foreach ($request->data as $d) {
            OpdPenilaianReport::updateOrCreate([
                'opd_penilaian_kinerja_id' => $d['opd_penilaian_kinerja'],
            ], [
                'catatan' => $d['catatan'],
                'rekomendasi' => $d['rekomendasi'],
            ]);
        }
        // DB::commit();
        // } catch (Exception $exception) {
        //     Error::createError($exception);
        // }

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
    public function exportPdf($opdPenilaian)
    {
        $opdPenilaian = OpdPenilaian::find($opdPenilaian);
        $pdf = Pdf::loadView('pdf.deskTimbalBalik', compact('opdPenilaian'))->setPaper('a4', 'landscape');
        return $pdf->stream('TIMBAL BALIK' . $opdPenilaian->opd->nama_opd . '.pdf');
    }
    public function exportDetailPdf($opdPenilaian)
    {
        $opdPenilaian = OpdPenilaian::find($opdPenilaian);
        $pdf = Pdf::loadView('pdf.detailPenilaianOpdPdf', compact('opdPenilaian'))->setPaper('a4', 'landscape');
        return $pdf->stream('PENILAIAN OPD ' . $opdPenilaian->opd->nama_opd . '.pdf');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaian  $opdPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaian $opdPenilaian)
    {
        $getOpdPerjanjianKinerjaIndikators = OpdPenilaian::getOpdPerjanjianKinerjaIndikator($opdPenilaian, 1);
        $getIkuStatus = OpdCategoryVariable::getIkuStatus($opdPenilaian);
        // return $getIku;
        $checkStatus = OpdPenilaianKinerja::checkStatus($opdPenilaian);
        $statuses = OpdPenilaian::STATUSESVERIF;
        $staffAhliStatuses = OpdPenilaianStaff::STATUSES;
        $ikuTypes = OpdPenilaianIku::TYPES;
        $months = Month::all();
        $opdPenilaianStaffTypes = OpdPenilaianStaffType::all();
        if ($opdPenilaian->checkStatusReport()) {
            return redirect(route('opdPenilaian.showReport', $opdPenilaian->id));
        } else {
            return view('opdPenilaian.show', compact('getIkuStatus', 'staffAhliStatuses', 'opdPenilaian', 'months', 'opdPenilaianStaffTypes', 'statuses', 'checkStatus', 'ikuTypes', 'getOpdPerjanjianKinerjaIndikators'));
        }
    }
    public function showReport(OpdPenilaian $opdPenilaian)
    {
        $getOpdPerjanjianKinerjaIndikators = OpdPenilaian::getOpdPerjanjianKinerjaIndikator($opdPenilaian, 1);
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
        $inovasiPrestasiOpds = InovasiPrestasiOpd::getByPenilaianOpdStatus($opdPenilaian);
        return view('opdPenilaian.edit', compact('opdPenilaian', 'inovasiPrestasiOpds'));
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
        $data = $request->validate([
            'inovasi_prestasi_opd_id' => 'nullable',
            'inovasi_prestasi_daerah' => 'nullable'
        ]);
        if ($request->inovasi_prestasi_opd_id) {
            $data['inovasi_prestasi_daerah'] = InovasiPrestasiOpd::where('id', $request->inovasi_prestasi_opd_id)->first()->inovasi_prestasi_tingkat->value;
        } else {
            $data['inovasi_prestasi_opd_id'] = null;
            $data['inovasi_prestasi_daerah'] = 0;
        }
        $opdPenilaian->update($data);
        session()->flash('success');
        return redirect(route('opdPenilaian.index'));
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
