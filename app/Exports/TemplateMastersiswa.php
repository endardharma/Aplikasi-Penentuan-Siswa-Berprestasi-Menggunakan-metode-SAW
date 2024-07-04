<?php

namespace App\Exports;

use App\Models\MasterSiswa;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class TemplateMastersiswa implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function array(): array
    {
        $master = MasterSiswa::take(1)->get();
        if ($master->isNotEmpty()) {

            foreach ($master as $m)
            {
                $item['nis'] = $m->nis;
                $item['nama'] = $m->name;
                $item['email'] = 'user@mail.com';
                $item['kelas'] = $m->kelas->name ?? '';
                $item['jenkel'] = 'laki-laki/perempuan';
                $item['telpon'] = '62821********';
                $item['periode'] = $m->periode;
                $data[] = $item;
            }
        } else {
            $data = [];
        }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:G1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ],

                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],

                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'B8860B']
                    ]
                ];

            },
        ];

    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama Siswa',
            'Email',
            'Kelas',
            'Jenkel',
            'Telpon',
            'Periode Angkatan',
        ];
    }
}
