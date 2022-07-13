<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluasiKerja\CreateEvaluasiKerjaYearRequest;
use App\Http\Requests\EvaluasiKerja\CreateEvaluasiKinerjaYearRequest;
use App\Models\EvaluasiKinerja\EvaluasiKinerjaYear;
use Illuminate\Http\Request;

class EvaluasiKinerjaYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:evaluasiKinerjaYear-list|evaluasiKinerjaYear-create|evaluasiKinerjaYear-edit|evaluasiKinerjaYear-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:evaluasiKinerjaYear-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:evaluasiKinerjaYear-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:evaluasiKinerjaYear-delete', ['only' => ['destroy']]);
        $name = "Evaluasi Kinerja AKIP Year";
        view()->share('name', $name);
    }

    public function index()
    {
        $evaluasiKinerjaYears = EvaluasiKinerjaYear::all();
        return view('evaluasi_kinerja.evaluasi_kinerja_year.index', compact('evaluasiKinerjaYears'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluasi_kinerja.evaluasi_kinerja_year.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEvaluasiKinerjaYearRequest $request)
    {
        $data = $request->all();
        EvaluasiKinerjaYear::create($data);
        session()->flash('success');
        return redirect(route('evaluasiKinerjaYear.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EvaluasiKinerjaYear  $evaluasiKinerjaYear
     * @return \Illuminate\Http\Response
     */
    public function show(EvaluasiKinerjaYear $evaluasiKinerjaYear)
    {
        return view('evaluasi_kinerja.evaluasi_kinerja_year.show', compact('evaluasiKinerjaYear'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EvaluasiKinerjaYear  $evaluasiKinerjaYear
     * @return \Illuminate\Http\Response
     */
    public function edit(EvaluasiKinerjaYear $evaluasiKinerjaYear)
    {
        return view('evaluasi_kinerja.evaluasi_kinerja_year.create', compact('evaluasiKinerjaYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EvaluasiKinerjaYear  $evaluasiKinerjaYear
     * @return \Illuminate\Http\Response
     */
    public function update(CreateEvaluasiKinerjaYearRequest $request, EvaluasiKinerjaYear $evaluasiKinerjaYear)
    {
        $data = $request->all();
        $evaluasiKinerjaYear->update($data);
        session()->flash('success');
        return redirect(route('evaluasiKinerjaYear.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EvaluasiKinerjaYear  $evaluasiKinerjaYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluasiKinerjaYear $evaluasiKinerjaYear)
    {
        $evaluasiKinerjaYear->delete();
        if ($evaluasiKinerjaYear->evaluasi_kinerja->count() != 0) {
            $evaluasiKinerjaYear->evaluasi_kinerja()->delete();
        }
        session()->flash('success');
        return redirect(route('evaluasiKinerjaYear.index'));
    }
}
