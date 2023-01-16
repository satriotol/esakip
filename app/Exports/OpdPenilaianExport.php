<?php

namespace App\Exports;

use App\Models\OpdPenilaian;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OpdPenilaianExport implements ShouldAutoSize, FromView
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $opdPenilaians = OpdPenilaian::getOpdPenilaian($this->request, '')->get();
        return view('exports.opdPenilaianExcel', compact('opdPenilaians'));
    }
}
