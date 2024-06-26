<?php

namespace App\Http\Controllers;

use App\Exports\PerjanjianKinerjaExport;
use App\Http\Requests\PengukuranKinerja\CreateOpdPerjanjianKinerjaRequest;
use App\Http\Requests\PengukuranKinerja\UpdateOpdPerjanjianKinerjaRequest;
use App\Models\Opd;
use App\Models\OpdPerjanjianKinerjaIndikator;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use App\Models\RencanaAksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class OpdPerjanjianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $this->middleware('permission:opdPerjanjianKinerja-list|opdPerjanjianKinerja-create|opdPerjanjianKinerja-edit|opdPerjanjianKinerja-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdPerjanjianKinerja-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdPerjanjianKinerja-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdPerjanjianKinerja-delete', ['only' => ['destroy']]);
        $name = "Perjanjian Kinerja OPD";
        view()->share('name', $name);
    }
    public function export_excel(Request $request)
    {
        $data = $request->validate([
            'year' => 'required',
            'type' => 'required',
        ]);
        $indicators = OpdPerjanjianKinerjaIndikator::with([
            'opd_perjanjian_kinerja_sasaran.opd_perjanjian_kinerja'
        ])->whereHas('opd_perjanjian_kinerja_sasaran.opd_perjanjian_kinerja', function ($query) use ($data) {
            $query->where('year', $data['year'])->where('type', $data['type']);
        })
        ->get();
        $name = $data['year'] . '-' . $data['type'] . '.xlsx';

        return Excel::download(new PerjanjianKinerjaExport($indicators), $name);
    }
    public function index(Request $request)
    {

        $year = $request->year;
        $type = $request->type;
        $status = $request->status;
        $opd_id = $request->opd_id;

        $types = OpdPerjanjianKinerja::TYPE;
        $statuses = OpdPerjanjianKinerja::STATUSES;
        $opds = Opd::getOpd();
        $opdWithoutPerjanjianKinerjas = Opd::opdWithoutPerjanjianKinerjas($request);

        if (Auth::user()->opd_id) {
            $datas = OpdPerjanjianKinerja::with('opd')->where('opd_id', Auth::user()->opd_id);
        } else {
            $datas = OpdPerjanjianKinerja::with('opd');
        }
        if ($year) {
            $datas->where('year', $year);
        }
        if ($type) {
            $datas->where('type', $type);
        }
        if ($status) {
            $datas->where('status', $status);
        }
        if ($opd_id) {
            $datas->where('opd_id', $opd_id);
        }
        $opdPerjanjianKinerjas = $datas->paginate();
        $request->flash();
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.index', compact('opdPerjanjianKinerjas', 'types', 'statuses', 'opds', 'opdWithoutPerjanjianKinerjas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
        $types = OpdPerjanjianKinerja::TYPE;
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.create', compact('opds', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOpdPerjanjianKinerjaRequest $request)
    {
        $data = $request->all();
        $data['file'] = $request->file;
        if (Auth::user()->opd_id) {
            $data['status'] = OpdPerjanjianKinerja::STATUS1;
        }
        OpdPerjanjianKinerja::create($data);
        session()->flash('success');
        return redirect(route('opdPerjanjianKinerja.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerngukuranKinerja\OpdPerjanjianKinerja  $opdPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $opdPerjanjianKinerjaIndikators = OpdPerjanjianKinerjaIndikator::whereHas('opd_perjanjian_kinerja_sasaran', function ($q) use ($opdPerjanjianKinerja) {
            $q->where('opd_perjanjian_kinerja_id', $opdPerjanjianKinerja->id);
        })->get();
        $statuses = OpdPerjanjianKinerja::STATUSES;
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.show', compact('opdPerjanjianKinerja', 'opdPerjanjianKinerjaIndikators', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerngukuranKinerja\OpdPerjanjianKinerja  $opdPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $opds = Opd::getOpd();
        $types = OpdPerjanjianKinerja::TYPE;
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.create', compact('opds', 'types', 'opdPerjanjianKinerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerngukuranKinerja\OpdPerjanjianKinerja  $opdPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $data = $request->validate([
            'opd_id' => 'nullable',
            'file' => 'nullable|max:500000',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required',

        ]);
        if ($request->file) {
            $data['file'] = $request->file;
        };
        $opdPerjanjianKinerja->update($data);
        session()->flash('success');
        return redirect(route('opdPerjanjianKinerja.index'));
    }
    public function store_file(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = date('Ymd_His') . '-' . $file->getClientOriginalName();
            $data['file'] = $file->storeAs('file', $filename, 'public_uploads');
            return $data['file'];
        };
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerngukuranKinerja\OpdPerjanjianKinerja  $opdPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $opdPerjanjianKinerja->delete();
        if ($opdPerjanjianKinerja->file) {
            $opdPerjanjianKinerja->deleteFile();
        }

        session()->flash('success');
        return redirect(route('opdPerjanjianKinerja.index'));
    }
    public function updateStatus(Request $request, OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $data = $this->validate($request, [
            'status' => 'required',
            'note' => 'nullable'
        ]);

        $opdPerjanjianKinerja->update($data);
        session()->flash('success');
        return back();
    }
}
