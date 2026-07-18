<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageLog extends Model
{
    protected $fillable = [
        'jadwal_id',
        'peserta_id',
        'message',
        'status',
        'provider_response',
        'sent_at',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
