<?php

namespace App\Imports;

use App\Models\KeterlambatanSiswa;
use App\Models\MasterJurusan;
use App\Models\MasterJurusanSiswa;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KeterlambatanSiswaImport implements ToCollection, WithHeadingRow
{
    public function rules(): array
    {
        return [
            'id' => 'required',
            'nama_siswa' => 'required',
            'jumlah_keterlambatan' => 'required',
            'nilai' => 'required',
            'jurusan' => 'required',
            'semester' => 'required',
            'tahun_ajar' => 'required',
        ];
    }

    protected $selectedTahunAjar;
    protected $selectedJurusan;
    protected $nilaiCallback;

    public function __construct($selectedTahunAjar, $selectedJurusan, $nilaiCallback)
    {
        $this->selectedTahunAjar = $selectedTahunAjar;
        $this->selectedJurusan = $selectedJurusan;
        $this->nilaiCallback = $nilaiCallback;
    }

    public function collection(Collection $rows)
    {
        // dd($rows)->toArray();

        foreach($rows as $row)
        {
            $siswa = MasterSiswa::where('name', $row['nama_siswa'])->first();
            $tajar = TahunAjar::find($this->selectedTahunAjar);
            $jurusan = MasterJurusanSiswa::find($this->selectedJurusan);

            if($tajar && $siswa && $jurusan)
            {
                $nilai = call_user_func($this->nilaiCallback, $row['jumlah_keterlambatan']);
                    KeterlambatanSiswa::updateOrCreate([
                    'tajar_id' => $tajar->id,
                    'siswa_id' => $siswa->id,
                    'jurusan_id' => $jurusan->id,
                    'nilai' => $nilai
                ], [
                    'nama_siswa' => $row['nama_siswa'],
                    'jumlah_keterlambatan' => $row['jumlah_keterlambatan'],
                    'nilai' => $nilai,
                    'jurusan' => $jurusan->name,
                    'tahun_ajar' => $tajar->name,
                ]);
            }
        }
    }
}
