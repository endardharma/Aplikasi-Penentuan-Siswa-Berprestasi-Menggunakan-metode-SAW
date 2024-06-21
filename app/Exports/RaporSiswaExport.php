<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RaporSiswaExport implements FromView
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
        // dd($this->data)->toArray();
        return view('export.raporsiswa', [
            'data' => $this->data,
        ]);
    }
}
