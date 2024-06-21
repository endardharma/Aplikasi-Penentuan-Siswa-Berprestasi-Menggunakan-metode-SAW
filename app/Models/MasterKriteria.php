<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKriteria extends Model
{
    use HasFactory;
    protected $table = 'master_kriterias';

    public function nilaiKeseluruhan()
    {
        return $this->hasMany(nilaiKeseluruhan::class, 'kriteria_id');
    }
}
