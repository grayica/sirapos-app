<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
        public function pesertas()
    {
        return $this->hasMany(Peserta::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

        protected $fillable = [
        'nama_posyandu',
        'dusun',
        'lokasi',
    ];
}
