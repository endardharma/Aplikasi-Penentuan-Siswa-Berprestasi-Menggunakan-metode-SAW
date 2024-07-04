<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SikapSiswa extends Model
{
    use HasFactory;
    protected $table = 'sikap_siswas';
    protected $fillable = ['tajar_id','siswa_id','jurusan_id','ket_sikap','nilai'];

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
}
