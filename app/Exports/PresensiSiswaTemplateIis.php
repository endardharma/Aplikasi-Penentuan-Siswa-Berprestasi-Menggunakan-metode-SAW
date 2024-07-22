<?php

namespace App\Exports;

use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class PresensiSiswaTemplateIis implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
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
        $jurusanIis = MasterJurusanSiswa::where('name','IIS')->pluck('id')->first();

        $data = [];
        if ($siswa->isNotEmpty())
        {
            foreach ($siswa as $s)
            {
                $jurusan_id = $s->kelas->jurusan->id ?? null;
                if ($jurusan_id === $jurusanIis)
                {
                    foreach ($tajar as $t)
                    {
                        $item = [];
                        $item['nama_siswa'] = $s->name;
                        $item['ket_ketidakhadira'] = 'Isi dengan Tidak Ada/Sakit/Izin/Tanpa Keterangan';
                        $item['jumlah_hari'] = 'Isi dengan angka berapa hari tidak masuk';
                        $item['jumlah_hari_lainnya'] = 'Isi dengan angka berapa hari tidak masuk yang melebihi 4 hari';
                        $item['nilai'] = 'Isi nilai dengan angka(0 - 5) sesuai dengan jumlah hari';
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
                $cellRange = 'A1:F1'; // All headers
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
            'Semester',
        ];
    }
}
