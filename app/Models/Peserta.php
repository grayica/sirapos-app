<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peserta extends Model
{
    protected $fillable = [
        'posyandu_id',
        'nama_penerima',
        'hubungan_penerima',
        'nama_peserta',

        'jenis_data',
        'jenis_peserta',

        'tanggal_lahir',
        'tanggal_mulai_kehamilan',

        'nomor_whatsapp',
        'rt',
        'status',
    ];

    protected $casts = [

        'tanggal_lahir' => 'date',
        'tanggal_mulai_kehamilan' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }

    public function hitungJenisPeserta(): string
    {
        if ($this->jenis_data === 'hamil') {
            return 'Ibu Hamil';
        }

        if (!$this->tanggal_lahir) {
            return '';
        }

        $umur = Carbon::parse($this->tanggal_lahir)->age;

        return match (true) {

            $umur < 1 => 'Bayi',

            $umur < 5 => 'Balita',

            $umur < 10 => 'Anak',

            $umur < 19 => 'Remaja',

            $umur < 60 => 'Usia Produktif',

            default => 'Lansia',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Method
    |--------------------------------------------------------------------------
    */

    public function getUmurAttribute(): string
    {
        if (!$this->tanggal_lahir) {
            return '-';
        }

        return Carbon::parse($this->tanggal_lahir)
            ->diff(now())
            ->format('%y Tahun %m Bulan');
    }

    public function getUmurLengkapAttribute()
    {
        if (!$this->tanggal_lahir) {
            return '-';
        }

        return Carbon::parse($this->tanggal_lahir)
            ->diff(now())
            ->format('%y Tahun %m Bulan');
    }

    public function getUsiaKehamilanAttribute()
    {
        if (!$this->tanggal_mulai_kehamilan) {
            return null;
        }

        return Carbon::parse($this->tanggal_mulai_kehamilan)
            ->diffInWeeks(now());
    }

    public function getHplAttribute()
    {
        if (!$this->tanggal_mulai_kehamilan) {
            return null;
        }

        return Carbon::parse($this->tanggal_mulai_kehamilan)
            ->addWeeks(40);
    }

    public function isAktif()
    {
        return $this->status === 'Aktif';
    }

    public function isIbuHamil()
    {
        return $this->jenis_peserta === 'Ibu Hamil';
    }

    public function isBayi()
    {
        return $this->jenis_peserta === 'Bayi';
    }

    public function isBalita()
    {
        return $this->jenis_peserta === 'Balita';
    }

    public function isAnak()
    {
        return $this->jenis_peserta === 'Anak';
    }

    public function isRemaja()
    {
        return $this->jenis_peserta === 'Remaja';
    }

    public function isUsiaProduktif()
    {
        return $this->jenis_peserta === 'Usia Produktif';
    }

    public function isLansia()
    {
        return $this->jenis_peserta === 'Lansia';
    }

    public function isBalitaAktif()
    {
        return ($this->isBayi() || $this->isBalita())
            && $this->isAktif();
    }

    public function isIbuHamilAktif()
    {
        return $this->isIbuHamil()
            && $this->usia_kehamilan !== null
            && $this->usia_kehamilan <= 40
            && $this->isAktif();
    }

    public function isLansiaAktif()
    {
        return $this->isLansia()
            && $this->isAktif();
    }

    public function bolehDikirimiReminder()
    {
        if ($this->isBayi() || $this->isBalita()) {
            return $this->isBalitaAktif();
        }

        if ($this->isIbuHamil()) {
            return $this->isIbuHamilAktif();
        }

        if ($this->isRemaja()) {
            return $this->isAktif();
        }

        if ($this->isUsiaProduktif()) {
            return $this->isAktif();
        }

        if ($this->isLansia()) {
            return $this->isLansiaAktif();
        }

        return false;
    }
}
