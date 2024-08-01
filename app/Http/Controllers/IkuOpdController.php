<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengukuranKinerja\CreateIkuOpdRequest;
use App\Http\Requests\PengukuranKinerja\UpdateIkuOpdRequest;
use App\Models\Opd;
use App\Models\PengukuranKinerja\IkuOpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class IkuOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:opdIku-list|opdIku-create|opdIku-edit|opdIku-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:opdIku-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:opdIku-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:opdIku-delete', ['only' => ['destroy']]);
        $name = "Pengukuran Kinerja IKU OPD";
        view()->share('name', $name);
    }
    public function index()
    {
        if (Auth::user()->opd_id) {
            $ikuOpds = IkuOpd::where('opd_id', Auth::user()->opd_id)->orderBy('year', 'desc')->paginate();
        } else {
            $ikuOpds = IkuOpd::orderBy('year', 'desc')->paginate();
        }
        return view('pengukuran_kinerja.opd.iku.index', compact('ikuOpds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::getOpd();
        return view('pengukuran_kinerja.opd.iku.create', compact('opds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIkuOpdRequest $request)
    {
        $data = $request->all();
        $data['file'] = $request->file;
        IkuOpd::create($data);
        session()->flash('success');
        return redirect(route('ikuOpd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengukuranKinerja\IkuOpd  $ikuOpd
     * @return \Illuminate\Http\Response
     */
    public function show(IkuOpd $ikuOpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengukuranKinerja\IkuOpd  $ikuOpd
     * @return \Illuminate\Http\Response
     */
    public function edit(IkuOpd $ikuOpd)
    {
        $opds = Opd::getOpd();
        return view('pengukuran_kinerja.opd.iku.create', compact('opds', 'ikuOpd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengukuranKinerja\IkuOpd  $ikuOpd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIkuOpdRequest $request, IkuOpd $ikuOpd)
    {
        $data = $request->all();
        if ($request->file) {
            $data['file'] = $request->file;
            $ikuOpd->deleteFile();
        };
        $ikuOpd->update($data);
        session()->flash('success');
        return redirect(route('ikuOpd.index'));
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
     * @param  \App\Models\PengukuranKinerja\IkuOpd  $ikuOpd
     * @return \Illuminate\Http\Response
     */
    public function destroy(IkuOpd $ikuOpd)
    {
        $ikuOpd->delete();
        $ikuOpd->deleteFile();
        session()->flash('success');
        return redirect(route('ikuOpd.index'));
    }
}
