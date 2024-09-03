<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterKriteria extends Model
{
    use HasFactory;
    protected $table = 'master_kriterias';
    protected $fillable = ['id', 'kode', 'name', 'attribute', 'bobot', 'tajar_id'];

    public function nilaiKeseluruhan()
    {
        return $this->hasMany(nilaiKeseluruhan::class, 'kriteria_id');
    }

    public function nilaiPerangkingan()
    {
        return $this->hasMany(nilaiPerangkingan::class, 'kriteria_id');
    }

    public function tajar(): BelongsTo
    {
        return $this->belongsTo(TahunAjar::class, 'tajar_id');
    }
}
