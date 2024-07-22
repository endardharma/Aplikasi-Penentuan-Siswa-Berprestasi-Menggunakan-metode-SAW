<?php

namespace App\Imports;

use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\PrestasiSiswa;
use App\Models\TahunAjar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PrestasiSiswaImport implements ToCollection, WithHeadingRow
{
    
    public function rules(): array
    {
        return [
            'id' => 'required',
            'nama_siswa' => 'required',
            'ket_prestasi' => 'required',
            'nilai' => 'required',
            'jurusan' => 'required',
            'semester' => 'required',
            'tahun_ajar' => 'required',
        ];
    }
    
    protected $selectedTahunAjar;
    protected $selectedJurusan;

    public function __construct($selectedTahunAjar, $selectedJurusan)
    {
        $this->selectedTahunAjar = $selectedTahunAjar;
        $this->selectedJurusan = $selectedJurusan;
    }

    public function collection(Collection $rows)
    {
        // dd($rows)->toArray();

        foreach($rows as $row)
        {
            $tajar = TahunAjar::find($this->selectedTahunAjar);
            // $siswa = MasterSiswa::where('name','LIKE','%'.$row['nama_siswa'].'%')->first();
            // $jurusan = MasterJurusan::where('name','LIKE','%'.$row['jurusan'].'%')->first();
            $siswa = MasterSiswa::where('name', $row['nama_siswa'])->first();
            $jurusan = MasterJurusanSiswa::find($this->selectedJurusan);

            if($tajar && $siswa && $jurusan)
            {
                $prestasi = PrestasiSiswa::updateOrCreate([
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'jurusan_id' => $jurusan->id,
                ], [
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'jurusan_id' => $jurusan->id,
                    'nama_siswa' => $row['nama_siswa'],
                    'ket_prestasi' => $row['keterangan_prestasi'],
                    'nilai' => $row['nilai'],
                    'jurusan' => $jurusan->name,
                    'semester' => $row['semester'],
                    'tahun_ajar' => $tajar->name,

                ]);
            }
        }
    }
}
