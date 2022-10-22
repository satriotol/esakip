<?php

namespace App\Exports;

use App\Http\Resources\ApbdAnggaranResource;
use App\Http\Resources\ARealisasiKeunganResource;
use App\Models\DataUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RealisasiAnggaranExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        if ($this->request->year) {
            $realisasiAnggarans = DataUnit::getRealisasiAnggaran($this->request->year, $this->request->id_skpd);
        } else {
            $year = Carbon::now()->format('Y');
            $realisasiAnggarans = DataUnit::getRealisasiAnggaran($year, $this->request->id_skpd);
        }
        return view('exports.realisasi_anggaran', [
            'realisasiAnggarans' => ARealisasiKeunganResource::collection($realisasiAnggarans)->resolve()
        ]);
    }
}
