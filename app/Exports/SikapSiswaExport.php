<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SikapSiswaExport implements FromView
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;    
    }

    public function view(): View
    {
        return view('export.sikapsiswa', [
            'data' => $this->data,
        ]);
    }
}
