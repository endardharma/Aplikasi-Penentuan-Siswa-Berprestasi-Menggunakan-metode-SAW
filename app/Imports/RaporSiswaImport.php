<?php

namespace App\Imports;

use App\Models\MasterJurusan;
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
            'semester' => 'required',
            'tahun_ajar' => 'required',
        ];
    }    
    
    public function collection(Collection $rows)
    {
        // if(isset($row['nama_mapel']))
        // {
        //     foreach($rows as $row)
        //     {
        //         $tajar = TahunAjar::where('name','LIKE','%'.$row['tahun_ajar'].'%')->first();
        //         $mapel = MasterMapel::where('name','LIKE','%'.$row['nama_mapel'].'%')->first();
        //         $siswa = MasterSiswa::where('name','LIKE','%'.$row['nama_siswa'].'%')->first();

        //         if($tajar && $mapel && $siswa)
        //         {   
        //             $rapor = RaporSiswa::updateOrCreate([
        //                 'tajar_id' => $tajar->id,
        //                 'mapel_id' => $mapel->id,
        //                 'siswa_id' => $siswa->id,
        //             ],[
        //                 'tajar_id' => $tajar->id,
        //                 'mapel_id' => $mapel->id,
        //                 'siswa_id' => $siswa->id,
        //                 'nama_siswa' => $row['nama_siswa'],
        //                 'nama_mapel' => $row['nama_mapel'],
        //                 'kelompok' => $row['kelompok'],
        //                 'type' => $row['type'],
        //                 'nilai' => $row['nilai'],
        //                 'jurusan' => $row['jurusan'],
        //                 'semester' => $row['semester'],
        //                 'tahun_ajar' => $row['tahun_ajar'],
        //             ]);
        //         }
        //     }
        // } else {
        //     echo("Array Key 'nama_mapel' tidak dapat di temukan");
        // }

        // dd($rows)->toArray();
        foreach($rows as $row)
        {
            $tajar = TahunAjar::where('name','LIKE','%'.$row['tahun_ajar'].'%')->first();
            $mapel = MasterMapel::where('name','LIKE','%'.$row['nama_mapel'].'%')->where('kelompok','LIKE','%'.$row['kelompok'].'%')->where('type','LIKE','%'.$row['tipe'].'%')->first();
            $siswa = MasterSiswa::where('name','LIKE','%'.$row['nama'].'%')->first();         
            $jurusan = MasterJurusan::where('name','LIKE','%'.$row['jurusan'].'%')->first();         
            
            if($tajar && $mapel && $siswa && $jurusan)
            {   
                $rapor = RaporSiswa::updateOrCreate([
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'mapel_id' => $mapel->id,
                    'jurusan_id' => $jurusan->id,
                    'nilai' => $row['nilai'],
                ],[
                    'nama_siswa' => $row['nama'],
                    'nama_mapel' => $row['nama_mapel'],
                    'kelompok' => $row['kelompok'],
                    'type' => $row['tipe'],
                    'nilai' => $row['nilai'],
                    'jurusan' => $row['jurusan'],
                    'semester' => $row['semester'],
                    'tahun_ajar' => $row['tahun_ajar'],
                ]);
            }
        }
    }
}
