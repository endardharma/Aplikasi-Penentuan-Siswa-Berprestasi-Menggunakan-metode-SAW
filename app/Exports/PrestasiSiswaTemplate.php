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

class PrestasiSiswaTemplate implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
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
        $jurusanMipa = MasterJurusanSiswa::where('name','MIPA')->pluck('id')->first();
        
        $data = array();

        if ($siswa->isNotEmpty())
        {
            foreach ($siswa as $s)
            {
                $jurusan_id = $s->kelas->jurusan->id ?? null;
                if ($jurusan_id === $jurusanMipa)
                {
                    $item = [];
                    $item['nama_siswa'] = $s->name;
                    $item['ket_prestasi'] = 'Isi dengan pilihan prestasi yang sesuai (Tingkat Internasional Juara 1/2/3, Tingkat Nasional Juara 1/2/3, Tingkat Provinsi Juara 1/2/3, Tingkat Kabupaten/Kota Juara 1/2/3, Tidak Ada)';
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
                $cellRange = 'A1:B1'; // All headers
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
            'Keterangan Prestasi',
        ];
    }
    
}
