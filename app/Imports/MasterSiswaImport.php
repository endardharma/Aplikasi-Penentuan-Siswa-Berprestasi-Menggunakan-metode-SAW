<?php

namespace App\Imports;

use App\Models\MasterJurusan;
use App\Models\MasterMapel;
use App\Models\MasterSiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MastersiswaImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function rules(): array
    {
        return [
            'nis' => 'required',
            'nama_siswa' => 'required',
            'email' => 'required|string|email|max:255|unique:master_siswas',
            'kelas' => 'required',
            'jenkel' => 'required',
            'telpon' => 'required',
            'periode_angkatan' => 'required',
        ];
    }
 
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $kelas = MasterJurusan::where('name','LIKE','%'.$row['kelas'].'%')->where('is_active',1)->first();
            if($kelas)
            {
                $siswa = MasterSiswa::updateOrCreate([
                    'kelas_id' => $kelas->id,
                    'name' => $row['name'],
                    'email' => $row['email'],
                ],[
                    'nis' => $row['nis'],
                    'name' => $row['nama_siswa'],
                    'email' => $row['email'],
                    'kelas_id' => $kelas->id,
                    'jenkel' => $row['jenkel'],
                    'telpon' => $row['telpon'],
                    'periode' => $row['periode'],
                ]);
            }
        }
    }
}
