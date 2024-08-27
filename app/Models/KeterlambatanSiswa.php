<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeterlambatanSiswa extends Model
{
    use HasFactory;
    protected $table = 'keterlambatan_siswas';
    protected $fillable = ['tajar_id','siswa_id','jurusan_id','konversi_keterlambatan_id'];

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

    public function konversiKeterlambatan()
    {
        return $this->belongsTo(KonversiKeterlambatan::class, 'konversi_keterlambatan_id');
    }
}
