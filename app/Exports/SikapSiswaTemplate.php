<?php

namespace App\Exports;

use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class SikapSiswaTemplate implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        // Fungsi Template Export dan Detail Sikap Siswa
        $siswa = MasterSiswa::with('kelas.jurusan')->get();
        $tajar = TahunAjar::all();
        $jurusanMipa = MasterJurusanSiswa::where('name','MIPA')->pluck('id')->first();

        $data = array();
        if($siswa->isNotEmpty())
        {
            foreach($siswa as $s)
            {
                $jurusan_id = $s->kelas->jurusan->id ?? null;
                if ($jurusan_id === $jurusanMipa)
                {
                    foreach($tajar as $t)
                    {
                        $item = [];
                        $item['nama_siswa'] = $s->name;
                        $item['ket_sikap'] = 'Isi dengan pilihan yang sesuai (Sangat Baik, Baik, Cukup, Tidak Baik, Sangat Tidak Baik)';
                        $item['nilai'] = 'Isi dengan angka yang sesuai (5, 4, 3, 2, 1)';
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
                $cellRange = 'A1:D1'; // All headers
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
            'Keterangan Sikap',
            'Nilai',
            'Semester',
        ];
    }
}
