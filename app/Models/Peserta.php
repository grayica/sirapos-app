<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
        public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }

    public function messageLogs()
    {
        return $this->hasMany(MessageLog::class);
    }

        protected $fillable = [
        'posyandu_id',
        'nama_penerima',
        'hubungan_penerima',
        'nama_peserta',
        'jenis_peserta',
        'nomor_whatsapp',
        'status',
    ];
}
