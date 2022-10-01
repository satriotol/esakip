<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengukuranKinerja\CreateOpdPerjanjianKinerjaRequest;
use App\Http\Requests\PengukuranKinerja\UpdateOpdPerjanjianKinerjaRequest;
use App\Models\Opd;
use App\Models\OpdPerjanjianKinerjaIndikator;
use App\Models\OpdPerjanjianKinerjaSasaran;
use App\Models\PerngukuranKinerja\OpdPerjanjianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function getOpdPerjanjianKinerja(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->opd_id) {
                $opdPerjanjianKinerja = OpdPerjanjianKinerja::with('opd')->where('opd_id', Auth::user()->opd_id)->get();
            } else {
                $opdPerjanjianKinerja = OpdPerjanjianKinerja::with('opd')->get();
            }
            return DataTables::of($opdPerjanjianKinerja)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="' . route('opdPerjanjianKinerja.show', $row->id) . '" class="btn btn-sm btn-primary ml-1">Detail</a>';
                    $btn = $btn1 . '<a href="' . route('opdPerjanjianKinerja.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('opdPerjanjianKinerja.destroy', $row->id) . '" method="POST"
                            class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">
                            Delete
                            </button>
                        </form>';
                    return $btn;
                })
                ->rawColumns(['pdf', 'action'])
                ->make(true);
        }
    }
    public function index()
    {
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::all();
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
            $data['opd_id'] = Auth::user()->opd_id;
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
        return view('pengukuran_kinerja.opd.opd_perjanjian_kinerja.show', compact('opdPerjanjianKinerja', 'opdPerjanjianKinerjaIndikators'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerngukuranKinerja\OpdPerjanjianKinerja  $opdPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $opds = Opd::all();
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
    public function update(UpdateOpdPerjanjianKinerjaRequest $request, OpdPerjanjianKinerja $opdPerjanjianKinerja)
    {
        $data = $request->all();
        if ($request->file) {
            $data['file'] = $request->file;
            $opdPerjanjianKinerja->deleteFile();
        };
        if (Auth::user()->opd_id) {
            $data['opd_id'] = Auth::user()->opd_id;
        }
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
}
