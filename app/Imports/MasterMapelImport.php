<?php

namespace App\Imports;

use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterMapel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterMapelImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */

    public function rules(): array
    {
        return [
            'jurusan' => 'required',
            'nama_mapel' => 'required',
            'kelompok' => 'required',
            'tipe_nilai' => 'required',
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // $jurusan = MasterJurusanSiswa::where('name','LIKE','%'.$row['jurusan_id'].'%')->where('is_active',1)->first();
            $jurusan = MasterJurusanSiswa::where('name','LIKE','%'.$row['jurusan'].'%')->first();
            if($jurusan)
            {
                $mapel = MasterMapel::updateOrCreate([
                    'jurusan_id' => $jurusan->id,
                    'name' => $row['nama_mapel'],
                    'kelompok' => $row['kelompok'],
                    'type' => $row['tipe_nilai'],
                ],[
                    'jurusan_id' => $jurusan->id,
                    'name' => $row['nama_mapel'],
                    'kelompok' => $row['kelompok'],
                    'type' => $row['tipe_nilai'],
                ]);
            }
        }
    }
}
