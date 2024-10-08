<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMapel extends Model
{
    use HasFactory;
    protected $fillable = ['jurusan_id','name','kelompok','type'];

    public function jurusan()
    {
        return $this->belongsTo(MasterJurusanSiswa::class,'jurusan_id');
    }
    
    public function rapor()
    {
        return $this->hasMany(RaporSiswa::class,'mapel_id')->orderby('id', 'asc');
    }
}
