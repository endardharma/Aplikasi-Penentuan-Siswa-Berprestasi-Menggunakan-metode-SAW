<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class NilaiPerangkinganExport implements FromView
{
    public $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        return view('export.nilaiperangkingan', [
            'data' => $this->data,
        ]);
    }
}
