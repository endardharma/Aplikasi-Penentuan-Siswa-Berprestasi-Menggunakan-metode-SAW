<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonversiKetidakhadiran extends Model
{
    use HasFactory;
    protected $table = 'konversi_ketidakhadirans';
    protected $fillable = ['id','ket_ketidakhadiran','jumlah_hari','jumlah_hari_lainnya','nilai_konversi'];

    public function presensi()
    {
        return $this->hasMany(PresensiSiswa::class, 'konversi_ketidakhadiran_id');
    }
    
}
