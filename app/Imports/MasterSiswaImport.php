<?php

namespace App\Imports;

use App\Models\MasterJurusan;
use App\Models\MasterMapel;
use App\Models\MasterSiswa;
use App\Models\TahunAjar;
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
            'email' => 'required|string|email|max:255|unique:master_siswas',
            'name' => 'required',
            'nis' => 'required',
            'kelas_id' => 'required',
            'jenkel' => 'required',
            'tajar_id' => 'required',
            'telpon' => 'required',
        ];
    }
 
    protected $selectedTahunAjar;

    public function __construct($selectedTahunAjar)
    {
        $this->selectedTahunAjar = $selectedTahunAjar;
    }
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $kelas = MasterJurusan::where('name','LIKE','%'.$row['kelas'].'%')->where('is_active',1)->first();
            $tajar = TahunAjar::find($this->selectedTahunAjar);
            
            if($kelas && $tajar)
            {
                MasterSiswa::updateOrCreate([
                    'kelas_id' => $kelas->id,
                    'tajar_id' => $tajar->id,
                    'name' => $row['nama_siswa'],
                    'email' => $row['email'],
                ],[
                    'nis' => $row['nis'],
                    'name' => $row['nama_siswa'],
                    'email' => $row['email'],
                    'kelas_id' => $kelas->id,
                    'jenkel' => $row['jenkel'],
                    'telpon' => $row['telpon'],
                    'tajar_id' => $tajar->id,
                ]);
            }
        }
    }
}
