<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BknController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOpds()
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-API-KEY' => env('EKIN_BKN_X_API_KEY')
            ])->get(env('EKIN_BKN_ENDPOINT') . "bkn_skp_sinkronisasi/opd")->json();
            if ($response == null) {
                throw new \Exception('Data tidak ditemukan');
            }
            return $response;
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with('error', $th->getMessage());
        }
    }
    public function index(Request $request)
    {
        $opds = $this->getOpds()['data']['opd'];
        if ($request->tahun && $request->opd) {
            $data = $this->integrasi_bkn($request)['data'];
            // return $data;
            return view('bkn.index', compact('opds', 'data'));
        }
        $request->flash();
        return view('bkn.index', compact('opds'));
    }
    public function integrasi_bkn(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => env('EKIN_BKN_X_API_KEY')
        ])->get(env('EKIN_BKN_ENDPOINT') . "bkn_skp_sinkronisasi/sakip_by_opd", [
            'opd' => $request->opd,
            'tahun' => $request->tahun
        ])->json();
        return $response;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
