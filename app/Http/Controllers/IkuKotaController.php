<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengukuranKinerja\CreateIkuKotaRequest;
use App\Http\Requests\PengukuranKinerja\UpdateIkuKotaRequest;
use App\Models\PengukuranKinerja\IkuKota;
use Illuminate\Http\Request;

class IkuKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Fetch the Site Settings object
        $name = "Pengukuran Kinerja IKU KOTA";
        view()->share('name', $name);
    }
    public function index()
    {
        $ikuKotas = IkuKota::all();
        return view('pengukuran_kinerja.kota.iku.index', compact('ikuKotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (IkuKota::all()->count() != 0) {
            return redirect(route('ikuKota.index'));
        }
        return view('pengukuran_kinerja.kota.iku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIkuKotaRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $data['file'] = $file;
        };
        IkuKota::create($data);
        session()->flash('success');
        return redirect(route('ikuKota.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengukuranKinerja\IkuKota  $ikuKota
     * @return \Illuminate\Http\Response
     */
    public function show(IkuKota $ikuKota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengukuranKinerja\IkuKota  $ikuKota
     * @return \Illuminate\Http\Response
     */
    public function edit(IkuKota $ikuKotum)
    {
        return view('pengukuran_kinerja.kota.iku.create', compact('ikuKotum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengukuranKinerja\IkuKota  $ikuKota
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIkuKotaRequest $request, IkuKota $ikuKotum)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file->store('file', 'public_uploads');
            $ikuKotum->deleteFile();
            $data['file'] = $file;
        };
        $ikuKotum->update($data);
        session()->flash('success');
        return redirect(route('ikuKota.index'));    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengukuranKinerja\IkuKota  $ikuKota
     * @return \Illuminate\Http\Response
     */
    public function destroy(IkuKota $ikuKota)
    {
        //
    }
}
