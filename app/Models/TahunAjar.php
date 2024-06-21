<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    use HasFactory;
    protected $table = "tahun_ajars";

    public function rapor()
    {
        return $this->hasMany(RaporSiswa::class, 'tajar_id')->orderby('id','asc');
    }

    public function presensi()
    {
        return $this->hasMany(PresensiSiswa::class, 'tajar_id')->orderby('id','asc');
    }

    public function sikap()
    {
        return $this->hasMany(SikapSiswa::class, 'tajar_id')->orderby('id','asc');   
    }

    public function prestasi()
    {
        return $this->hasMany(PrestasiSiswa::class, 'tajar_id')->orderby('id','asc');
    }

    public function keterlambatan()
    {
        return $this->hasMany(KeterlambatanSiswa::class, 'tajar_id')->orderby('id','asc');
    }

    public function hafalan()
    {
        return $this->hasMany(HafalanSiswa::class, 'tajar_id')->orderby('id','asc');
    }

    public function siswa()
    {
        return $this->hasMany(HafalanSiswa::class, 'tajar_id')->orderby('id','asc');
    }
    
}
