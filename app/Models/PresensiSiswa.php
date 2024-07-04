<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PresensiSiswa extends Model
{
    use HasFactory;
    protected $table = 'presensi_siswas';
    protected $fillable = ['tajar_id','siswa_id','jurusan_id','ket_ketidakhadiran','jumlah_hari','jumlah_hari_lainnya','nilai'];

    public function hitung()
    {
        return $this->hasMany(TahunAjar::class,'tajar_id')->count();
    }

    public function tajar(): BelongsTo
    {
        return $this->belongsTo(TahunAjar::class,'tajar_id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(MasterSiswa::class, 'siswa_id');
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(MasterJurusanSiswa::class, 'jurusan_id');
    }

    
}
