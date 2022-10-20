<?php

namespace App\Exports;

use App\Http\Resources\ApbdAnggaranResource;
use App\Models\DataUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataUnitExcel implements FromView
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
            $ApbdAnggarans = DataUnit::getDataUnitNow($this->year, $this->id_skpd);
        } else {
            $year = Carbon::now()->format('Y');
            $ApbdAnggarans = DataUnit::getDataUnitNow($year, $this->request->id_skpd);
        }
        return view('exports.apbd_anggaran', [
            'ApbdAnggarans' => ApbdAnggaranResource::collection($ApbdAnggarans)
        ]);
    }
}
