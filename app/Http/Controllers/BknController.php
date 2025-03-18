<?php

namespace App\Http\Controllers;

use App\Repositories\OpdRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BknController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $opdRepository;

    public function __construct()
    {
        $this->opdRepository = new OpdRepository();
    }
    public function getOpds(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-API-KEY' => env('EKIN_BKN_X_API_KEY')
            ])->get(env('EKIN_BKN_ENDPOINT') . "bkn_skp_sinkronisasi/opd", [
                'bkn_opd_id' => Auth::user()->opd->bkn_id ?? null,
            ]);

            if (!$response->successful()) {
                throw new \Exception('Gagal mengambil data OPD dari API');
            }

            $jsonResponse = $response->json();

            if (!isset($jsonResponse['data']['opd'])) {
                throw new \Exception('Data OPD tidak ditemukan dalam response API');
            }

            return $jsonResponse['data']['opd'];
        } catch (\Throwable $th) {
            return redirect(route('dashboard'))->with('error', $th->getMessage());
        }
    }
    public function index(Request $request)
    {
        $opds = $this->getOpds($request);
        $request->flash();
        if ($request->tahun && $request->opd) {
            $data = $this->integrasi_bkn($request);
            return view('bkn.index', compact('opds', 'data'));
        }
        return view('bkn.index', compact('opds'));
    }
    public function integrasi_bkn(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-API-KEY' => env('EKIN_BKN_X_API_KEY')
            ])->get(env('EKIN_BKN_ENDPOINT') . "bkn_skp_sinkronisasi/sakip_by_opd", [
                'opd' => $request->opd,
                'tahun' => $request->tahun
            ]);

            if (!$response->successful()) {
                throw new \Exception('Gagal mengambil data dari API');
            }

            $jsonResponse = $response->json();

            if (!isset($jsonResponse['data'])) {
                throw new \Exception('Data tidak ditemukan dalam response API');
            }

            return $jsonResponse['data'];
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
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
