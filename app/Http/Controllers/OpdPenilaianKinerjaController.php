<?php

namespace App\Http\Controllers;

use App\Models\DataUnit;
use App\Models\Error;
use App\Models\EvaluasiKinerja\EvaluasiKinerja;
use App\Models\Master;
use App\Models\Opd;
use App\Models\OpdCategory;
use App\Models\OpdCategoryVariable;
use App\Models\OpdPenilaian;
use App\Models\OpdPenilaianKinerja;
use App\Models\RencanaAksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OpdPenilaianKinerjaController extends Controller
{
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
    public function getRealisasiTargetPendapatan(Request $request, $opd_penilaian_id, $opd_category_variable_id)
    {
        $opdPenilaian = OpdPenilaian::find($request->opd_penilaian_id);
        $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
        $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
        $year = $opdPenilaian->year;
        $tglawal = $year . '-01-01';
        $tglakhir = $year . '-12-31';
        $data = $this->apiGetHttp('https://api.e-sakip.semarangkota.go.id/api/v1/pajak', [
            'name' => $opdPenilaian->name,
            'opd_id' => $opdPenilaian->opd_id,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir
        ]);
        if ($data->status() == 400) {
            session()->flash('bug', $data['meta']['message']);
            return back();
        }
        if ($data->status() != 200) {
            session()->flash('bug', 'Terjadi Kesalahan Di Sisi Server');
            return back();
        }
        OpdPenilaianKinerja::updateOrCreate(
            [
                'opd_penilaian_id' => $opd_penilaian_id,
                'opd_category_variable_id' => $opd_category_variable_id,
            ],
            [
                'target' => $data['data']['target'],
                'realisasi' => $data['data']['realisasi'],
                'capaian' => $data['data']['capaian'],
                'nilai_akhir' => $data['data']['capaian'] * $bobot
            ]
        );
        $opdPenilaian->update([
            'status' => OpdPenilaian::STATUS1
        ]);
        session()->flash('success');
        return back();
    }
    public function getElektronifikasi(Request $request, $opd_penilaian_id, $opd_category_variable_id)
    {
        $opdPenilaian = OpdPenilaian::find($request->opd_penilaian_id);
        $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
        $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
        $year = $opdPenilaian->year;
        $tglawal = $year . '-01-01';
        $tglakhir = $year . '-12-31';
        $data = $this->apiGetHttp('https://api.e-sakip.semarangkota.go.id/api/v1/elektronifikasi', [
            'name' => $opdPenilaian->name,
            'opd_id' => $opdPenilaian->opd_id,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir
        ]);
        if ($data->status() == 400) {
            session()->flash('bug', $data['meta']['message']);
            return back();
        }
        if ($data->status() != 200) {
            session()->flash('bug', 'Terjadi Kesalahan Di Sisi Server');
            return back();
        }
        OpdPenilaianKinerja::updateOrCreate(
            [
                'opd_penilaian_id' => $opd_penilaian_id,
                'opd_category_variable_id' => $opd_category_variable_id,
            ],
            [
                'target' => $data['data']['target'],
                'realisasi' => $data['data']['realisasi'],
                'capaian' => $data['data']['capaian'],
                'nilai_akhir' => $data['data']['capaian'] * $bobot
            ]
        );
        $opdPenilaian->update([
            'status' => OpdPenilaian::STATUS1
        ]);
        session()->flash('success');
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'target' => 'required|numeric',
            'realisasi' => 'nullable|numeric',
            'rencana_aksi_id' => 'nullable',
        ]);
        if ($request->rencana_aksi_id != null) {
            $data['realisasi'] = RencanaAksi::getTotalCapaian($data['rencana_aksi_id']);
        } else {
            $data['realisasi'] = $request->realisasi;
        }
        $opdCategoryVariable = OpdCategoryVariable::where('id', $request->opd_category_variable_id)->first();
        $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
        $capaian = $data['realisasi'] / $request->target * 100;
        if ($capaian > 100) {
            $capaian = 100;
        }
        if ($opdCategoryVariable->opd_variable->is_efisiensi) {
            $capaian = 100;
        }
        $opdPenilaian = OpdPenilaian::find($request->opd_penilaian_id);
        DB::beginTransaction();
        try {
            OpdPenilaianKinerja::updateOrCreate(
                [
                    'opd_penilaian_id' => $request->opd_penilaian_id,
                    'opd_category_variable_id' => $request->opd_category_variable_id,
                ],
                [
                    'rencana_aksi_id' => $data['rencana_aksi_id'] ?? null,
                    'target' => $data['target'],
                    'realisasi' => $data['realisasi'],
                    'capaian' => round($capaian, 2),
                    'nilai_akhir' => round($capaian * $bobot, 2),
                    'user_id' => Auth::user()->id
                ]
            );
            $opdPenilaian->update([
                'status' => OpdPenilaian::STATUS1
            ]);
            DB::commit();
        } catch (Exception $exception) {
            Error::createError($exception);
        }

        session()->flash('success');
        return back();
    }


    public function storeAkip(OpdPenilaian $opd_penilaian, $opd_category_variable_id, $year)
    {
        $data = EvaluasiKinerja::where('opd_id', $opd_penilaian->opd_id)->whereHas('evaluasi_kinerja_year', function ($q) use ($year) {
            $q->where('year', $year);
        })->first();
        try {
            $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
            $realisasi = $data->value;
            $target = Master::first()->sakip;
            $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
            $capaian = round($realisasi / $target * 100, 2);
            if ($capaian > 100) {
                $capaian = 100;
            }
            $nilaiAkhir = round($capaian * $bobot, 2);
            OpdPenilaianKinerja::updateOrCreate(
                [
                    'opd_penilaian_id' => $opd_penilaian->id,
                    'opd_category_variable_id' => $opd_category_variable_id,
                ],
                [
                    'target' => $target,
                    'realisasi' => $realisasi,
                    'capaian' => $capaian,
                    'nilai_akhir' => $nilaiAkhir,
                    'user_id' => Auth::user()->id
                ]
            );
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('bug', 'Terjadi Kesalahan Penarikan Data');
            return back();
        }

        session()->flash('success');
        return back();
    }
    public function storeRb(OpdPenilaian $opd_penilaian, $opd_category_variable_id, $year)
    {
        if ($opd_penilaian->opd_perjanjian_kinerja->year == 2023) {
            $target = 100;
            $realisasi = 100;
            $capaian = 100;
            $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
            $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
            $nilaiAkhir = round($capaian * $bobot, 2);
        } else {
            $data = Http::accept('application/json')->withHeaders([
                'X-Api-Key' => '!23f0rm451|-|anY453b4tas1Lu5!',
                'X-Token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImlkIjoiNTYifSwiaWF0IjoxNjczNDg2NTk4LCJleHAiOjE3MDQ1OTA1OTh9.Zf0Nt2e-3Sv9gml3ZX-V658fPFoIzSKhpd86OAa6MHc'
            ])->get('http://lke-rb.semarangkota.go.id/api/penilaian_opd/hasil?kd_skpd=' . $opd_penilaian->opd->kode_opd . '&tahun=' . $year . '');
            if ($data->failed()) {
                session()->flash('bug', $data['message']);
                return back();
            }
            $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
            $realisasi = $data['data']['penilaian_opd']['nilai_validator'];
            $bobot = $data['data']['penilaian_opd']['bobot'];
            $realisasi =  round($realisasi / $bobot * 100, 2);
            $target = Master::first()->reformasi_birokrasi;
            $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
            $capaian = round($realisasi / $target * 100, 2);
            if ($capaian > 100) {
                $capaian = 100;
            }
            $nilaiAkhir = round($capaian * $bobot, 2);
        }
        OpdPenilaianKinerja::updateOrCreate(
            [
                'opd_penilaian_id' => $opd_penilaian->id,
                'opd_category_variable_id' => $opd_category_variable_id,
            ],
            [
                'target' => $target,
                'realisasi' => $realisasi,
                'capaian' => $capaian,
                'nilai_akhir' => $nilaiAkhir,
                'user_id' => Auth::user()->id
            ]
        );
        session()->flash('success');
        return back();
    }
    public function storeSipd(Request $request, $opd_penilaian_id, $opd_category_variable_id, $year, $opd_id)
    {
        try {
            $opdPenilaian = OpdPenilaian::find($request->opd_penilaian_id);
            $data = $this->apiGetPenyerapanHttp('https://penyerapananggaran.semarangkota.go.id/api/penialaian_kinerja_organisasi/getPenyerapanAnggaran', [
                'period' => $opdPenilaian->name ?? "TAHUNAN",
                'opd_id' => $opd_id,
                'year' => $year
            ]);
            if ($data->failed()) {
                session()->flash('bug', $data->json()['meta']['message']);
                return back();
            }
            $response = json_decode($data->getBody(), true);

            if ($response == null) {
                session()->flash('bug', 'Data Belum Siap');
                return back();
            }
            $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
            $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
            $capaian = round($data['data']['capaian'], 2);
            if ($capaian > 100) {
                $capaian = 100;
            }
            $nilaiAkhir = round($capaian * $bobot, 2);
            OpdPenilaianKinerja::updateOrCreate(
                [
                    'opd_penilaian_id' => $opd_penilaian_id,
                    'opd_category_variable_id' => $opd_category_variable_id,
                ],
                [
                    'target' => $data['data']['target'],
                    'realisasi' => $data['data']['realisasi'],
                    'capaian' => $capaian,
                    'nilai_akhir' => $nilaiAkhir,
                    'user_id' => Auth::user()->id
                ]
            );
            session()->flash('success');
            return back();
        } catch (\Throwable $th) {
            session()->flash('bug', $th->getMessage());
            return back();
        }
    }
    public function storep3dn(Request $request, $opd_penilaian_id, $opd_category_variable_id, $year, $opd_id)
    {
        try {
            $opdPenilaian = OpdPenilaian::find($request->opd_penilaian_id);
            $data = $this->apiGetPenyerapanHttp('https://penyerapananggaran.semarangkota.go.id/api/pd3n/getP3dn', [
                'period' => $opdPenilaian->name ?? "TAHUNAN",
                'opd_id' => $opd_id,
                'year' => $year
            ]);
            if ($data->failed()) {
                session()->flash('bug', $data->json()['meta']['message']);
                return back();
            }
            $response = json_decode($data->getBody(), true);

            if ($response == null) {
                session()->flash('bug', 'Data Belum Siap');
                return back();
            }
            $opdCategoryVariable = OpdCategoryVariable::where('id', $opd_category_variable_id)->first();
            $bobot = $opdCategoryVariable->opd_variable->bobot / 100;
            $capaian = round($data['data']['capaian'], 2);
            if ($capaian > 100) {
                $capaian = 100;
            }
            $nilaiAkhir = round($capaian * $bobot, 2);
            OpdPenilaianKinerja::updateOrCreate(
                [
                    'opd_penilaian_id' => $opd_penilaian_id,
                    'opd_category_variable_id' => $opd_category_variable_id,
                ],
                [
                    'target' => $data['data']['target'],
                    'realisasi' => $data['data']['realisasi'],
                    'capaian' => $capaian,
                    'nilai_akhir' => $nilaiAkhir,
                    'user_id' => Auth::user()->id
                ]
            );
            session()->flash('success');
            return back();
        } catch (\Throwable $th) {
            session()->flash('bug', $th->getMessage());
            return back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpdPenilaianKinerja  $opdPenilaianKinerja
     * @return \Illuminate\Http\Response
     */
    public function show(OpdPenilaianKinerja $opdPenilaianKinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpdPenilaianKinerja  $opdPenilaianKinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(OpdPenilaianKinerja $opdPenilaianKinerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpdPenilaianKinerja  $opdPenilaianKinerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpdPenilaianKinerja $opdPenilaianKinerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpdPenilaianKinerja  $opdPenilaianKinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpdPenilaianKinerja $opdPenilaianKinerja)
    {
        //
    }
}
