<?php

namespace App\Exports;

use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use App\Models\MasterMapel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class RaporSiswaTemplate implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // public function array(): array
    // {
    //     // Fungsi Template Export dan detail rapor siswa
    //     $siswa = MasterSiswa::all();
    //     $tajar = TahunAjar::all();
    //     // $mapel = MasterMapel::all(); // Mendapatkan semua mata pelajaran

    //     $data = [];
    //     if ($siswa->isNotEmpty() ) 
    //     {
    //         foreach ($siswa as $s) 
    //         {
    //             $mapel = MasterMapel::where('jurusan_id', $s->kelas_id)->get();
    //             if ($mapel->isNotEmpty())
    //             {
    //                 foreach ($mapel as $m) 
    //                 {
    //                     if ($tajar->isNotEmpty())
    //                     {
    //                         foreach ($tajar as $t)
    //                         {
    //                             $item = [];
    //                             $item['nama_siswa'] = $s->name;
    //                             $item['nama_mapel'] = $m->name;
    //                             $item['kelompok'] = $m->kelompok;
    //                             $item['type'] = $m->type;

    //                             // $jurusansiswa = MasterJurusan::find($m->jurusan_id);
    //                             // $item['jurusan'] = $jurusansiswa ? $jurusansiswa->jurusan : 'Jurusan tidak ditemukan';
    //                             $item['jurusan'] = $m->jurusan;

    //                             $item['nilai'] = 'Isi nilai dengan angka';
            
            
    //                             $item['semester'] = $t->semester;
    //                             $item['tahun_ajar'] = $t->periode;
            
    //                             $data[] = $item;
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     return $data;
    // }

    public function array(): array
    {
        // Fungsi Template Export dan detail rapor siswa
        $siswa = MasterSiswa::with('kelas.jurusan')->get();
        $tajar = TahunAjar::all();
        $jurusanMipaId = MasterJurusanSiswa::where('name', 'MIPA')->pluck('id')->first();
    
        $data = [];
        if ($siswa->isNotEmpty()) 
        {
            foreach ($siswa as $s) 
            {
                $jurusan_id = $s->kelas->jurusan->id ?? null;
                if ($jurusan_id === $jurusanMipaId) 
                {
                    $mapel = MasterMapel::where('jurusan_id', $jurusan_id)->get();
                    if ($mapel->isNotEmpty())
                    {
                        foreach ($mapel as $m) 
                        {
                            $item = [];
                            $item['nama_siswa'] = $s->name;
                            $item['nama_mapel'] = $m->name;
                            $item['kelompok'] = $m->kelompok;
                            $item['type'] = $m->type;
                            $item['nilai'] = 'Isi nilai dengan angka';
                            $jurusansiswa = MasterJurusanSiswa::find($m->jurusan_id);

                            $data[] = $item;
                        }
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
            'Nama Mapel',
            'Kelompok',
            'Tipe',
            'Nilai',
        ];
    }
}
