<?php

namespace App\Exports;

use App\Models\MasterJurusan;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class KeterlambatanSiswaTemplate implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $siswa = MasterSiswa::with('kelas.jurusan')->get();
        $tajar = TahunAjar::all();

        $data = array();

        if($siswa->isNotEmpty())
        {
            foreach($siswa as $s)
            {
                $jurusan_id = $s->kelas->jurusan->id ??  null;
                if ($jurusan_id)
                {
                    foreach($tajar as $t)
                    {
                        $item = [];
                        $item['nama_siswa'] = $s->name;
                        $item['jumlah_keterlambatan'] = 'Masukkan jumlah keterlambatan siswa masuk sekolah(0 Kali, 1-2 Kali, 3-4 Kali, 5-6 Kali, > 7 Kali)';
                        $item['nilai'] = 'Isi nilai dengan angka';
                        $item['jurusan'] = $s->jurusan ? $s->jurusan->name : 'Jurusan tidak di temukan';
                        $item['semester'] = $t->semester;
                        $data[] = $item;
                    }
                }
            }
        }
        return $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
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
            'Nama Siswa',
            'Jumlah Keterlambatan',
            'Nilai',
            'Jurusan',
            'Semester',
        ];
    }
    
}
