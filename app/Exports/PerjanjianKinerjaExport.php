<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PerjanjianKinerjaExport implements FromView
{
    protected $indicators;

    public function __construct($indicators)
    {
        $this->indicators = $indicators;
    }

    public function view(): View
    {
        return view('exports.perjanjianKinerjaExcel', [
            'indicators' => $this->indicators
        ]);
    }
}

