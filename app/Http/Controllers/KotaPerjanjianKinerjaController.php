<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengukuranKinerja\CreateKotaPerjanjianKinerjaRequest;
use App\Http\Requests\PengukuranKinerja\UpdateKotaPerjanjianKinerjaRequest;
use App\Models\PengukuranKinerja\KotaPerjanjianKinerja;
use Illuminate\Http\Request;

class KotaPerjanjianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:kotaPerjanjianKinerja-list|kotaPerjanjianKinerja-create|kotaPerjanjianKinerja-edit|kotaPerjanjianKinerja-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kotaPerjanjianKinerja-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kotaPerjanjianKinerja-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kotaPerjanjianKinerja-delete', ['only' => ['destroy']]);
        $name = "Perjanjian Kinerja Kota";
        view()->share('name', $name);
    }
    public function getKotaPerjanjianKinerja(Request $request)
    {
        if ($request->ajax()) {
            $kota_perjanjian_kinerjas = KotaPerjanjianKinerja::all();
            return datatables()::of($kota_perjanjian_kinerjas)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('kotaPerjanjianKinerja.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('kotaPerjanjianKinerja.destroy', $row->id) . '" method="POST"
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
        return view('pengukuran_kinerja.kota.pengukuran_kinerja.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengukuran_kinerja.kota.pengukuran_kinerja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateKotaPerjanjianKinerjaRequest $request)
    {
        $data = $request->all();
        $data['file'] = $request->file;

        KotaPerjanjianKinerja::create($data);
        session()->flash('success');
        return redirect(route('kotaPerjanjianKinerja.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengukuranKinerja\KotaPerjanjianKinerja  $kotaPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function show(KotaPerjanjianKinerja $kotaPerjanjianKinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengukuranKinerja\KotaPerjanjianKinerja  $kotaPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(KotaPerjanjianKinerja $kotaPerjanjianKinerja)
    {
        return view('pengukuran_kinerja.kota.pengukuran_kinerja.create', compact('kotaPerjanjianKinerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengukuranKinerja\KotaPerjanjianKinerja  $kotaPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKotaPerjanjianKinerjaRequest $request, KotaPerjanjianKinerja $kotaPerjanjianKinerja)
    {
        $data = $request->all();
        if ($request->file) {
            $data['file'] = $request->file;
            $kotaPerjanjianKinerja->deleteFile();
        };
        $kotaPerjanjianKinerja->update($data);
        session()->flash('success');
        return redirect(route('kotaPerjanjianKinerja.index'));
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
     * @param  \App\Models\PengukuranKinerja\KotaPerjanjianKinerja  $kotaPerjanjianKinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(KotaPerjanjianKinerja $kotaPerjanjianKinerja)
    {
        $kotaPerjanjianKinerja->delete();
        $kotaPerjanjianKinerja->deleteFile();
        session()->flash('success');
        return redirect(route('kotaPerjanjianKinerja.index'));
    }
}
