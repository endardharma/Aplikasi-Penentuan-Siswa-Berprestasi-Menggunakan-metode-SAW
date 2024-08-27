<?php

namespace App\Imports;

use App\Models\KonversiSikap;
use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\SikapSiswa;
use App\Models\TahunAjar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PHPUnit\TestRunner\TestResult\Collector;

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
            'tahun_ajar' => 'required',
        ];
    }

    protected $selectedTahunAjar;
    protected $selectedJurusan;
    // protected $nilaiCallback;

    public function __construct($selectedTahunAjar, $selectedJurusan)
    {
        $this->selectedTahunAjar = $selectedTahunAjar;
        $this->selectedJurusan = $selectedJurusan;
        // $this->nilaiCallback = $nilaiCallback;
    }

    public function collection (Collection $rows)
    {
        foreach ($rows as $row)
        {
            $tajar = TahunAjar::find($this->selectedTahunAjar);
            $konversiSikap = KonversiSikap::where('ket_sikap', $row['keterangan_sikap'])->first();
            $siswa = MasterSiswa::where('name', $row['nama_siswa'])->first();
            $jurusan = MasterJurusanSiswa::find($this->selectedJurusan);

            if ($tajar && $siswa && $jurusan && $konversiSikap)
            {
                // $nilai = call_user_func($this->nilaiCallback, $row['keterangan_sikap']);
                SikapSiswa::updateOrCreate([
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'jurusan_id' => $jurusan->id,
                    'konversi_sikap_id' => $konversiSikap->id,
                ],[
                    'konversi_sikap_id' => $konversiSikap->id,
                    'nama_siswa' => $row['nama_siswa'],
                    'ket_sikap' => $row['keterangan_sikap'],
                    'jurusan' => $jurusan->name,
                    'tahun_ajar' => $tajar->name,
                ]);
            }
        }
    }
    
    // public function collection(Collection $rows)
    // {
    //     // dd($rows)->toArray();
    //     foreach($rows as $row)
    //     {
    //         $tajar = TahunAjar::where('name','LIKE','%'.$row['tahun_ajar'].'%')->first();
    //         $siswa = MasterSiswa::where('name','LIKE','%'.$row['nama_siswa'].'%')->first();
    //         $jurusan = MasterJurusan::where('name','LIKE','%'.$row['jurusan'].'%')->first();

    //         if($tajar && $siswa && $jurusan)
    //         {
    //             $sikap = SikapSiswa::updateOrCreate([
    //                 'tajar_id' => $tajar->id,
    //                 'siswa_id' => $siswa->id,
    //                 'jurusan_id' => $jurusan->id,
    //             ], [
    //                 'tajar_id' => $tajar->id,
    //                 'siswa_id' => $siswa->id,
    //                 'jurusan_id' => $jurusan->id,
    //                 'nama_siswa' => $row['nama_siswa'],
    //                 'ket_sikap' => $row['keterangan_sikap'],
    //                 'nilai' => $row['nilai'],
    //                 'jurusan' => $row['jurusan'],
    //                 'semester' => $row['semester'],
    //                 'tahun_ajar' => $row['tahun_ajar'],
    //             ]);
    //         }
    //     }
    // }
}
