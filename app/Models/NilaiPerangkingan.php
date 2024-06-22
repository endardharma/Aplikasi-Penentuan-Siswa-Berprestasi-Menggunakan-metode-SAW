<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPerangkingan extends Model
{
    use HasFactory;
    protected $table = 'nilai_perangkingans';
    protected $fillable = ['tajar_id','siswa_id','jurusan_id','nilai_akhir'];

    public function siswa()
    {
        return $this->belongsTo(MasterSiswa::class, 'siswa_id');
    }

    public function rapor()
    {
        return $this->belongsTo(RaporSiswa::class, 'rapor_id');
    }

    public function presensi()
    {
        return $this->belongsTo(PresensiSiswa::class, 'ketidakhadiran_id');
    }

    public function sikap()
    {
        return $this->belongsTo(SikapSiswa::class, 'sikap_id');
    }

    public function prestasi()
    {
        return $this->belongsTo(PrestasiSiswa::class, 'prestasi_id');
    }

    public function keterlambatan()
    {
        return $this->belongsTo(KeterlambatanSiswa::class, 'keterlambatan_id');
    }

    public function hafalan()
    {
        return $this->belongsTo(HafalanSiswa::class, 'hafalan_id');
    }

    public function tajar()
    {
        return $this->belongsTo(TahunAjar::class, 'tajar_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(MasterJurusan::class, 'jurusan_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(MasterKriteria::class, 'kriteria_id');
    }

}
