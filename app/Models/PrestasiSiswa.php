<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    use HasFactory;
    protected $table = 'prestasi_siswas';
    protected $fillable = ['tajar_id','siswa_id','jurusan_id','konversi_prestasi_id'];

    public function tajar()
    {
        return $this->belongsTo(TahunAjar::class, 'tajar_id');
    }

    public function siswa()
    {
        return $this->belongsTo(MasterSiswa::class, 'siswa_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(MasterJurusanSiswa::class, 'jurusan_id');
    }

    public function konversiPrestasi()
    {
        return $this->belongsTo(konversiPrestasi::class, 'konversi_prestasi_id');
    }
}
