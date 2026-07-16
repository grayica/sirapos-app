<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageLog extends Model
{
        public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
