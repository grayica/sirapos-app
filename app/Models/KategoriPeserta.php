<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPeserta extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function pesertas()
    {
        return $this->hasMany(Peserta::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
