<?php

namespace App\Imports;

use App\Models\MasterJurusan;
use App\Models\MasterSiswa;
use App\Models\SikapSiswa;
use App\Models\TahunAjar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SikapSiswaImport implements ToCollection, WithHeadingRow
{
    public function rules(): array
    {
        return [
            'id' => 'required',
            'nama_siswa' => 'required',
            'ket_sikap' => 'required',
            'nilai' => 'required',
            'jurusan' => 'required',
            'semester' => 'required',
            'tahun_ajar' => 'required',
        ];
    }

    public function collection(Collection $rows)
    {
        // dd($rows)->toArray();
        foreach($rows as $row)
        {
            $tajar = TahunAjar::where('name','LIKE','%'.$row['tahun_ajar'].'%')->first();
            $siswa = MasterSiswa::where('name','LIKE','%'.$row['nama_siswa'].'%')->first();
            $jurusan = MasterJurusan::where('name','LIKE','%'.$row['jurusan'].'%')->first();

            if($tajar && $siswa && $jurusan)
            {
                $sikap = SikapSiswa::updateOrCreate([
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'jurusan_id' => $jurusan->id,
                ], [
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'jurusan_id' => $jurusan->id,
                    'nama_siswa' => $row['nama_siswa'],
                    'ket_sikap' => $row['keterangan_sikap'],
                    'nilai' => $row['nilai'],
                    'jurusan' => $row['jurusan'],
                    'semester' => $row['semester'],
                    'tahun_ajar' => $row['tahun_ajar'],
                ]);
            }
        }
    }
}
