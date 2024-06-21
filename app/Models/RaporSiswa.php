<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaporSiswa extends Model
{
    use HasFactory;
    protected $table = 'rapor_siswas';
    protected $fillable = ['tajar_id', 'mapel_id', 'siswa_id', 'jurusan_id', 'nilai'];

    public function hitung()
    {
        return $this->hasMany(TahunAjar::class,'tajar_id')->count();
    }

    public function tajar()
    {
        return $this->belongsTo(TahunAjar::class,'tajar_id');
    }

    public function mapel()
    {
        return $this->belongsTo(MasterMapel::class,'mapel_id');
    }

    public function siswa()
    {
        return $this->belongsTo(MasterSiswa::class,'siswa_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(MasterJurusan::class,'jurusan_id');
    }

}
