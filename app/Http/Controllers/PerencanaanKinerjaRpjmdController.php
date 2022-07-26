<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanKinerja\CreatePerencanaanKinerja;
use App\Http\Requests\Rpjmd\CreateRpjmdRequest;
use App\Http\Requests\Rpjmd\UpdateRpjmdRequest;
use App\Models\PerencanaanKinerjaRpjmd;
use Illuminate\Http\Request;

class PerencanaanKinerjaRpjmdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:kotaRpjmd-list|kotaRpjmd-create|kotaRpjmd-edit|kotaRpjmd-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kotaRpjmd-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kotaRpjmd-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kotaRpjmd-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $perencanaan_kinerja_rpjmds = PerencanaanKinerjaRpjmd::all();
        return view('perencanaan_kinerja_rpjmd.index', compact('perencanaan_kinerja_rpjmds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (PerencanaanKinerjaRpjmd::all()->count() != 0) {
            return redirect(route('perencanaan_kinerja_rpjmd.index'));
        }
        return view('perencanaan_kinerja_rpjmd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRpjmdRequest $request)
    {
        $data = $request->all();
        $data['file'] = $request->file;
        PerencanaanKinerjaRpjmd::create($data);
        session()->flash('success');
        return redirect(route('perencanaan_kinerja_rpjmd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerjaRpjmd  $perencanaan_kinerja_rpjmd
     * @return \Illuminate\Http\Response
     */
    public function show(PerencanaanKinerjaRpjmd $perencanaan_kinerja_rpjmd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerencanaanKinerjaRpjmd  $perencanaan_kinerja_rpjmd
     * @return \Illuminate\Http\Response
     */
    public function edit(PerencanaanKinerjaRpjmd $perencanaan_kinerja_rpjmd)
    {
        return view('perencanaan_kinerja_rpjmd.create', compact('perencanaan_kinerja_rpjmd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerencanaanKinerjaRpjmd  $perencanaan_kinerja_rpjmd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRpjmdRequest $request, PerencanaanKinerjaRpjmd $perencanaan_kinerja_rpjmd)
    {
        $data = $request->all();
        if ($request->file) {
            $data['file'] = $request->file;
            $perencanaan_kinerja_rpjmd->deleteFile();
        };
        $perencanaan_kinerja_rpjmd->update($data);
        session()->flash('success');
        return redirect(route('perencanaan_kinerja_rpjmd.index'));
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
     * @param  \App\Models\PerencanaanKinerjaRpjmd  $perencanaan_kinerja_rpjmd
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerencanaanKinerjaRpjmd $perencanaan_kinerja_rpjmd)
    {
        //
    }
}
