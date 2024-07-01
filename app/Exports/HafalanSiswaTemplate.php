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

class HafalanSiswaTemplate implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $siswa = MasterSiswa::all();
        $tajar = TahunAjar::all();
        $jurusan = MasterJurusan::first();

        // Daftar tetap keterangan hafalan
        $ket_hafalan_list = [
            'Jumlah Juz',
            'Makhrodul Huruf',
            'Ketentuan Ilmu Tajwid',
            'Irama/Lagu',
            'Fasokhah'
        ];

        $data = [];

        if ($siswa->isNotEmpty()) {
            foreach ($siswa as $s) {
                foreach ($ket_hafalan_list as $ket_hafalan) {
                    foreach ($tajar as $t) {
                        $item = [];
                        $item['nama_siswa'] = $s->name;
                        $item['ket_hafalan'] = $ket_hafalan;
                        $item['nilai'] = 'Isi nilai dengan angka';

                        $jurusansiswa = $jurusan->firstWhere('id', $s->jurusan_id);
                        $item['jurusan'] = $jurusansiswa ? $jurusansiswa->name : 'Jurusan tidak ditemukan';

                        $item['semester'] = $t->semester;
                        $item['tahun_ajar'] = $t->periode;

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
                $cellRange = 'A1:H1'; // All headers
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
            'Keterangan Hafalan',
            'Nilai',
            'Jurusan',
            'Semester',
            'Tahun Ajar',
        ];
    }
}
