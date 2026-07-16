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
}
