<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJurusan extends Model
{
    use HasFactory;
    protected $table="master_kelas";

    public function hitung()
    {
        return $this->hasMany(MasterSiswa::class,'jurusan_id')->count();
    }

    public function mapel()
    {
        return $this->hasMany(MasterMapel::class,'jurusan_id')->orderby('kelompok','asc');
    }
    
    public function rapor()
    {
        return $this->hasMany(RaporSiswa::class,'jurusan_id')->orderby('name', 'asc');
    }

    public function presensi()
    {
        return $this->hasMany(PresensiSiswa::class, 'jurusan_id')->orderby('name','asc');
    
    }

    public function sikap()
    {
        return $this->hasMany(SikapSiswa::class, 'jurusan_id')->orderby('name','asc');
    }

    public function prestasi()
    {
        return $this->hasMany(PrestasiSiswa::class, 'jurusan_id')->orderby('id','asc');
    }

    public function keterlambatan()
    {
        return $this->hasMany(KeterlambatanSiswa::class, 'jurusan_id')->orderby('id','asc');
    }

    public function hafalan()
    {
        return $this->hasMany(HafalanSiswa::class, 'jurusan_id')->orderby('id','asc');
    }

}
