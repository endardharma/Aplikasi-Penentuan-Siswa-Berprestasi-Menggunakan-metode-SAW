<?php

namespace App\Imports;

use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterMapel;
use App\Models\MasterSiswa;
use App\Models\RaporSiswa;
use App\Models\TahunAjar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RaporSiswaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    public function rules(): array
    {
        return [
            'id' => 'required',
            'nama_siswa' => 'required',
            'nama_mapel' => 'required',
            'kelompok' => 'required',
            'type' => 'required',
            'nilai' => 'required',
            'jurusan' => 'required',
            'tahun_ajar' => 'required',
        ];
    }    
    
    // public function collection(Collection $rows)
    // {
    //     foreach($rows as $row)
    //     {
    //         $tajar = TahunAjar::where('name','LIKE','%'.$row['tahun_ajar'].'%')->first();
    //         $mapel = MasterMapel::where('name','LIKE','%'.$row['nama_mapel'].'%')->where('kelompok','LIKE','%'.$row['kelompok'].'%')->where('type','LIKE','%'.$row['tipe'].'%')->first();
    //         $siswa = MasterSiswa::where('name','LIKE','%'.$row['nama'].'%')->first();         
    //         $jurusan = MasterJurusanSiswa::where('name','LIKE','%'.$row['jurusan'].'%')->first();         
            
    //         if($tajar && $mapel && $siswa && $jurusan)
    //         {   
    //             $rapor = RaporSiswa::updateOrCreate([
    //                 'tajar_id' => $tajar->id,
    //                 'siswa_id' => $siswa->id,
    //                 'mapel_id' => $mapel->id,
    //                 'jurusan_id' => $jurusan->id,
    //                 'nilai' => $row['nilai'],
    //             ],[
    //                 'nama_siswa' => $row['nama'],
    //                 'nama_mapel' => $row['nama_mapel'],
    //                 'kelompok' => $row['kelompok'],
    //                 'type' => $row['tipe'],
    //                 'nilai' => $row['nilai'],
    //                 'jurusan' => $row['jurusan'],
    //                 'semester' => $row['semester'],
    //                 'tahun_ajar' => $row['tahun_ajar'],
    //             ]);
    //         }
    //     }
    // }
    
    protected $selectedTahunAjar;
    protected $selectedImportJurusan;

    public function __construct($selectedTahunAjar, $selectedImportJurusan)
    {
        $this->selectedTahunAjar = $selectedTahunAjar;
        $this->selectedImportJurusan = $selectedImportJurusan;
    }

    // EDITED 23/07/2024 03:10 AM
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $tajar = TahunAjar::find($this->selectedTahunAjar);
            
            $mapel = MasterMapel::where('name', 'LIKE', '%'.$row['nama_mapel'].'%')
                ->where('kelompok', 'LIKE', '%'.$row['kelompok'].'%')
                ->where('type', 'LIKE', '%'.$row['tipe'].'%')
                ->first();
    
            // Cari siswa dengan nama dan kelas yang lebih spesifik
            // $siswa = MasterSiswa::where('name', $row['nama_siswa'])
            //     ->whereHas('kelas', function($query) use ($row) {
            //         $query->where('name', $row['kelas']);
            //     })
            //     ->first();
            // $siswa = MasterSiswa::where('id', $row['nama_siswa'])->first();

            $siswa = MasterSiswa::where('name', $row['nama_siswa'])->first();

            $jurusan = MasterJurusanSiswa::find($this->selectedImportJurusan);
    
            if ($tajar && $mapel && $siswa && $jurusan)
            {
                RaporSiswa::updateOrCreate([
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'mapel_id' => $mapel->id,
                    'jurusan_id' => $jurusan->id,
                ],[
                    'nama_siswa' => $row['nama_siswa'],
                    'nama_mapel' => $row['nama_mapel'],
                    'kelompok' => $row['kelompok'],
                    'type' => $row['tipe'],
                    'nilai' => $row['nilai'],
                    'jurusan' => $jurusan->name,
                    'tahun_ajar' => $tajar->name,
                ]);
            }
        }
    }
}
