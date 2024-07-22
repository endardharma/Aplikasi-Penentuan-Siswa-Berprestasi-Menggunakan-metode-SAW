<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSiswa extends Model
{
    use HasFactory;
    protected $table = 'master_siswas';
    protected $fillable = ['kelas_id','email','name','kelompok','jenkel','telpon','nis','type','tajar_id'];

    public function kelas()
    {
        return $this->belongsTo(MasterJurusan::class, 'kelas_id');
    }

    public function jurusan()
    {
        return $this->hasOneThrough(MasterJurusanSiswa::class, MasterJurusan::class, 'id', 'id', 'kelas_id', 'jurusan_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(MasterKriteria::class);
    
    }
    public function siswa()
    {
        return $this->belongsTo(MasterSiswa::class);
    }

    public function tajar()
    {
        return $this->belongsTo(TahunAjar::class, 'tajar_id');
    }

    public function rapor()
    {
        return $this->hasMany(RaporSiswa::class,'siswa_id');
    }

    public function presensi()
    {
        return $this->hasMany(PresensiSiswa::class, 'siswa_id');
    }
    
    public function sikap()
    {
        return $this->hasMany(SikapSiswa::class, 'siswa_id')->orderby('id', 'asc');
    }

    public function prestasi()
    {
        return $this->hasMany(PrestasiSiswa::class, 'siswa_id')->orderby('id','asc');
    }

    public function keterlambatan()
    {
        return $this->hasMany(KeterlambatanSiswa::class, 'siswa_id')->orderby('id','asc');
    }

    public function hafalan()
    {
        return $this->hasMany(HafalanSiswa::class, 'siswa_id')->orderby('id','asc');
    }

    public function nilaiKeseluruhan()
    {
        return $this->hasMany(NilaiKeseluruhan::class, 'siswa_id')->orderby('id', 'asc');
    
    }
    public function perangkingan()
    {
        return $this->hasMany(NilaiPerangkingan::class, 'siswa_id')->orderby('id', 'asc');
    }
}
