<?php

namespace App\Exports;

use App\Models\InovasiPrestasiOpd;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InovasiPrestasiOpdExport implements FromView
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $inovasiPrestasiOpds = InovasiPrestasiOpd::getAll($this->request)->get();
        return view('exports.inovasiPrestasiOpdExcel', compact('inovasiPrestasiOpds'));
    }
}
