<?php

namespace App\Services;

use App\Models\Jadwal;
use App\Models\MessageLog;
use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    public function send($target, $message)
    {
        return Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
        ]);
    }

    public function sendReminder(Jadwal $jadwal)
    {
        foreach ($jadwal->posyandu->pesertas as $peserta) {

            $pesan =
                "📢 *Pengingat Posyandu*\n\n" .
                "Halo Bapak/Ibu {$peserta->nama_penerima},\n\n" .
                "Jangan lupa menghadiri kegiatan Posyandu.\n\n" .
                "📅 Tanggal : {$jadwal->tanggal}\n" .
                "🕒 Jam : {$jadwal->jam}\n" .
                "📍 Lokasi : {$jadwal->lokasi}\n\n" .
                "Terima kasih.";

            $response = $this->send(
                $peserta->nomor_whatsapp,
                $pesan
            );

            MessageLog::create([
                'jadwal_id' => $jadwal->id,
                'peserta_id' => $peserta->id,
                'message' => $pesan,
                'status' => $response->successful() ? 'Sent' : 'Failed',
                'provider_response' => $response->body(),
                'sent_at' => now(),
            ]);
        }
    }
}
