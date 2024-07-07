<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    public function siswa()
    {
        return $this->hasMany(MasterSiswa::class);
    }

    public function guru()
    {
        return $this->hasMany(MasterGuru::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function perangkingan()
    {
        return $this->hasMany(NilaiPerangkingan::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(MasterJurusanSiswa::class);
    }
}
