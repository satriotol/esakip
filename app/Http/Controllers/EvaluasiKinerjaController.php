<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluasiKinerja\CreateEvaluasiKinerjaRequest;
use App\Http\Requests\EvaluasiKinerja\UpdateEvaluasiKinerjaRequest;
use App\Models\EvaluasiKinerja\EvaluasiKinerja;
use App\Models\Opd;
use Illuminate\Http\Request;

class EvaluasiKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:evaluasiKinerja-list|evaluasiKinerja-create|evaluasiKinerja-edit|evaluasiKinerja-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:evaluasiKinerja-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:evaluasiKinerja-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:evaluasiKinerja-delete', ['only' => ['destroy']]);
        $name = "Evaluasi Kinerja AKIP Year";
        view()->share('name', $name);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($evaluasiKinerjaYear)
    {
        $opds = Opd::all();
        return view('evaluasi_kinerja.create', compact('evaluasiKinerjaYear', 'opds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEvaluasiKinerjaRequest $request, $evaluasiKinerjaYear)
    {
        $data = $request->all();
        foreach ($request->opd_id as $key => $value) {
            EvaluasiKinerja::updateOrCreate(
                ['opd_id' => $request->opd_id[$key], 'evaluasi_kinerja_year_id' => $evaluasiKinerjaYear],
                ['value' => $request->value[$key]]
            );
        }
        session()->flash('success');
        return redirect(route('evaluasiKinerjaYear.show', $evaluasiKinerjaYear));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EvaluasiKinerja\EvaluasiKinerja  $evaluasiKinerja
     * @return \Illuminate\Http\Response
     */
    public function show(EvaluasiKinerja $evaluasiKinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EvaluasiKinerja\EvaluasiKinerja  $evaluasiKinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(EvaluasiKinerja $evaluasiKinerja)
    {
        return view('evaluasi_kinerja.edit', compact('evaluasiKinerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EvaluasiKinerja\EvaluasiKinerja  $evaluasiKinerja
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvaluasiKinerjaRequest $request, EvaluasiKinerja $evaluasiKinerja)
    {
        $data = $request->all();
        $evaluasiKinerja->update($data);
        session()->flash('success');
        return redirect(route('evaluasiKinerjaYear.show', $evaluasiKinerja->evaluasi_kinerja_year));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EvaluasiKinerja\EvaluasiKinerja  $evaluasiKinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluasiKinerja $evaluasiKinerja)
    {
        //
    }
}
