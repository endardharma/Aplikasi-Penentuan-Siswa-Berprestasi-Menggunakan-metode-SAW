<?php

namespace App\Exports;

use App\Models\MasterJurusanSiswa;
use App\Models\MasterMapel;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class RaporSiswaTemplateIis implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;

    public function collection($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $siswa = MasterSiswa::with('kelas.jurusan')->get();
        $tajar = TahunAjar::all();
        $jurusanIisId = MasterJurusanSiswa::where('name','IIS')->pluck('id')->first();

        $data = [];
        if ($siswa->isNotEmpty())
        {
            foreach ($siswa as $s)
            {
                $jurusan_id = $s->kelas->jurusan->id ?? null;
                if ($jurusan_id === $jurusanIisId)
                {
                    $mapel = MasterMapel::where('jurusan_id', $jurusan_id)->get();
                    if ($mapel->isNotEmpty())
                    {
                        foreach ($mapel as $m)
                        {
                            if ($tajar->isNotEmpty())
                            {
                                foreach ($tajar as $t)
                                {
                                    $item = [];
                                    $item['nama_siswa'] = $s->name;
                                    $item['nama_mapel'] = $m->name;
                                    $item['kelompok'] = $m->kelompok;
                                    $item['type'] = $m->type;
                                    $item['nilai'] = 'Isi nilai dengan angka';

                                    $jurusanSiswa = MasterJurusanSiswa::find($m->jurusan_id);

                                    $item['semester'] = $t->semester;
                                    $data[] = $item;
                                }
                            }
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
                $cellRange = 'A1:G1'; // All Headers
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
            }
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
            'Semester',
        ];
    }
}
