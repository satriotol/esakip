<?php

namespace App\Http\Controllers;

use App\Models\OpdPenilaianFeedback;
use App\Repositories\OpdPenilaianFeedbackRepository;
use Illuminate\Http\Request;

class OpdPenilaianFeedbackController extends Controller
{
    private $opdPenilaianFeedbackRepository;
    public function __construct()
    {
        $this->opdPenilaianFeedbackRepository = new OpdPenilaianFeedbackRepository();
        $this->middleware('permission:opdPenilaianFeedback-store', ['only' => ['create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->opdPenilaianFeedbackRepository->validate($request);
        $opd_penilaian_feedback = $this->opdPenilaianFeedbackRepository->store($data);
        return back()->with('success', 'Sukses Menambahkan Feedback KA OPD');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaianFeedback  $opdPenilaianFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaianFeedback $opdPenilaianFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPenilaianFeedback  $opdPenilaianFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPenilaianFeedback $opdPenilaianFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPenilaianFeedback  $opdPenilaianFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdPenilaianFeedback $opdPenilaianFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPenilaianFeedback  $opdPenilaianFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaianFeedback $opdPenilaianFeedback)
    {
        //
    }
}
