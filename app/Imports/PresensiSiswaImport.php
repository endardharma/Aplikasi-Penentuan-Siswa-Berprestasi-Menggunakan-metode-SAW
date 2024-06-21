<?php

namespace App\Imports;

use App\Models\MasterJurusan;
use App\Models\MasterSiswa;
use App\Models\PresensiSiswa;
use App\Models\TahunAjar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PresensiSiswaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'nama_siswa' => 'required',
            'ket_ketidakhadiran' => 'required',
            'jumlah_hari' => 'required',
            'jumlah_hari_lainnya' => 'required',
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
            $jurusan = MasterJurusan::where('name','LIKE','%'.$row['jurusan'].'%')->first();
            $siswa = MasterSiswa::where('name','LIKE','%'.$row['nama_siswa'].'%')->first();

            if($tajar && $jurusan && $siswa)
            {
                $presensi = PresensiSiswa::updateOrCreate([
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'jurusan_id' => $jurusan->id,
                ], [
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'jurusan_id' => $jurusan->id,
                    'nama_siswa' => $row['nama_siswa'],
                    'ket_ketidakhadiran' => $row['keterangan_ketidakhadiran'],
                    'jumlah_hari' => $row['jumlah_hari'],
                    'jumlah_hari_lainnya' => $row['jumlah_hari_lainnya'],
                    'nilai' => $row['nilai'],
                    'jurusan' => $row['jurusan'],
                    'semester' => $row['semester'],
                    'tahun_ajar' => $row['tahun_ajar'],
                ]);
            }
        }
    }
}
