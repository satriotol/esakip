<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelaporanKinerja\Kota\CreateLkjipKotaRequest;
use App\Http\Requests\PelaporanKinerja\Kota\UpdateLkjipKotaRequest;
use App\Models\PelaporanKinerja\LkjipKota;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LkjipKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:kotaLkjip-list|kotaLkjip-create|kotaLkjip-edit|kotaLkjip-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kotaLkjip-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kotaLkjip-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kotaLkjip-delete', ['only' => ['destroy']]);
        $name = "Link Terkait Capaian Kinerja";
        view()->share('name', $name);
    }
    public function getLkjipKota(Request $request)
    {
        if ($request->ajax()) {
            $lkjip_kota = LkjipKota::all();
            return DataTables::of($lkjip_kota)->addIndexColumn()
                ->addColumn('pdf', function ($row) {
                    $btn = '<a class="btn btn-sm btn-success" target="_blank" href="' . asset('uploads/' . $row->file) . '"> Open File</a>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('lkjip_kota.edit', $row->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
                    $btn = $btn . '
                        <form action="' . route('lkjip_kota.destroy', $row->id) . '" method="POST"
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
        return view('pelaporan_kinerja.lkjip_kota.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelaporan_kinerja.lkjip_kota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLkjipKotaRequest $request)
    {
        $data = $request->all();
        $data['file'] = $request->file;
        LkjipKota::create($data);
        session()->flash('success');
        return redirect(route('lkjip_kota.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelaporanKinerja\LkjipKota  $lkjip_kota
     * @return \Illuminate\Http\Response
     */
    public function show(LkjipKota $lkjip_kota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelaporanKinerja\LkjipKota  $lkjip_kota
     * @return \Illuminate\Http\Response
     */
    public function edit(LkjipKota $lkjip_kotum)
    {
        return view('pelaporan_kinerja.lkjip_kota.create', compact('lkjip_kotum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelaporanKinerja\LkjipKota  $lkjip_kota
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLkjipKotaRequest $request, LkjipKota $lkjip_kotum)
    {
        $data = $request->all();
        if ($request->file) {
            $data['file'] = $request->file;
            $lkjip_kotum->deleteFile();
        };
        $lkjip_kotum->update($data);
        session()->flash('success');
        return redirect(route('lkjip_kota.index'));
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
     * @param  \App\Models\PelaporanKinerja\LkjipKota  $lkjip_kotum
     * @return \Illuminate\Http\Response
     */
    public function destroy(LkjipKota $lkjip_kotum)
    {
        $lkjip_kotum->deleteFile();
        $lkjip_kotum->delete();
        session()->flash('success');
        return redirect(route('lkjip_kota.index'));
    }
}
