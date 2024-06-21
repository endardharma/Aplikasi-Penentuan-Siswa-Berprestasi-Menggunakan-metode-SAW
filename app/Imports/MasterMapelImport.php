<?php

namespace App\Imports;

use App\Models\MasterJurusan;
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
            'kelas' => 'required',
            'nama_mapel' => 'required',
            'kelompok' => 'required',
            'tipe_nilai' => 'required',
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $kelas = MasterJurusan::where('name','LIKE','%'.$row['kelas'].'%')->where('is_active',1)->first();
            if($kelas)
            {
                $mapel = MasterMapel::updateOrCreate([
                    'jurusan_id' => $kelas->id,
                    'name' => $row['nama_mapel'],
                    'kelompok' => $row['kelompok'],
                    'type' => $row['tipe_nilai'],
                ],[
                    'jurusan_id' => $kelas->id,
                    'name' => $row['nama_mapel'],
                    'kelompok' => $row['kelompok'],
                    'type' => $row['tipe_nilai'],
                ]);
            }
        }
    }
}
