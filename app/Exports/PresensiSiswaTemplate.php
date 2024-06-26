<?php

namespace App\Exports;

use App\Models\MasterJurusan;
use App\Models\MasterSiswa;
use App\Models\PresensiSiswa;
use App\Models\TahunAjar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class PresensiSiswaTemplate implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    function array(): array
    {
        // Fungsi template export dan detail rapor siswa
        $siswa = MasterSiswa::all();
        $tajar = TahunAjar::all();
        $jurusan = MasterJurusan::first();
        
        $data = array();

        if($siswa->isNotEmpty())
        {
            foreach($siswa as $s)
            {
                $item['nama_siswa'] = $s->name;
                $item['ket_ketidakhadira'] = 'Isi dengan Tidak Ada/Sakit/Izin/Tanpa Keterangan';
                $item['jumlah_hari'] = 'Isi dengan angka berapa hari tidak masuk';
                $item['jumlah_hari_lainnya'] = 'Isi dengan angka berapa hari tidak masuk yang melebihi 4 hari';
                $item['nilai'] = 'Isi nilai dengan angka(0 - 5) sesuai dengan jumlah hari';

                $jurusansiswa = $jurusan->firstWhere('id', $s->jurusan_id);
                if($jurusansiswa)
                {
                    $item['jurusan'] = $jurusansiswa->name;
                }
                else
                {
                    $item['jurusan'] = 'Jurusan tidak ditemukan';
                }

                foreach($tajar as $t)
                {
                    $item['semester'] = $t->semester;
                    $item['tahun_ajar'] = $t->periode;
                    $data[] = $item;
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
            'Keterangan Ketidakhadiran',
            'Jumlah Hari',
            'Jumlah Hari Lainnya',
            'Nilai',
            'Jurusan',
            'Semester',
            'Tahun Ajar',
        ];
    }
}
