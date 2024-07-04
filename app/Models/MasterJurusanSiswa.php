<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJurusanSiswa extends Model
{
    use HasFactory;

    protected $table = 'master_jurusans';
    protected $fillable = ['id','nama_jurusan'];
}
