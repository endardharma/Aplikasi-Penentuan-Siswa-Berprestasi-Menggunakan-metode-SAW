<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiNormalisasi extends Model
{
    use HasFactory;

    public function siswa()
    {
        return $this->belongsTo(MasterSiswa::class, 'siswa_id', 'id');
    }

    public function tajar()
    {
        return $this->belongsTo(TahunAjar::class, 'tajar_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(MasterJurusanSiswa::class, 'jurusan_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(MasterKriteria::class, 'kriteria_id');
    
    }
    public function nilaiKeseluruhan()
    {
        return $this->belongsTo(NilaiKeseluruhan::class);
    }

}
