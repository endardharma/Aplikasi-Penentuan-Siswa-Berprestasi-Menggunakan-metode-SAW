<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PresensiSiswa extends Model
{
    use HasFactory;
    protected $table = 'presensi_siswas';
    // protected $fillable = ['tajar_id','siswa_id','jurusan_id','ket_ketidakhadiran','jumlah_hari','jumlah_hari_lainnya','nilai'];
    protected $fillable = ['tajar_id','siswa_id','jurusan_id','konversi_ketidakhadiran_id','nilai'];

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
    
    public function konversiKetidakhadiran(): BelongsTo
    {
        return $this->belongsTo(KonversiKetidakhadiran::class, 'konversi_ketidakhadiran_id');
    }
}
