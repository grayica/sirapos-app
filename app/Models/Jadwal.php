<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Jadwal extends Model
{
    protected $fillable = [
        'posyandu_id',
        'tanggal',
        'jam',
        'lokasi',
        'status',
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }

}
