<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExtractExport implements FromView
{
    public function view(): View
    {
    	$results = "xxx";
        return view('extract', [
            'results' => $results
        ]);
    }
}
