<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HafalanSiswa extends Model
{
    use HasFactory;

    protected $table = 'hafalan_siswas';
    protected $fillable = ['tajar_id','siswa_id','jurusan_id','ket_hafalan','nilai'];

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

    public function hitung()
    {
        return $this->hasMany(TahunAjar::class,'tajar_id')->count();
    }
}
