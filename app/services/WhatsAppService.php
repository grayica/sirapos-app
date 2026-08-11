<?php

namespace App\Services;

use App\Models\Jadwal;
use App\Models\MessageLog;
use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    /**
     * Kirim template WhatsApp melalui Meta Cloud API
     */
    private function sendMetaTemplate($target, $templateName, $parameters)
    {
        $templateParameters = [];

        foreach ($parameters as $parameter) {
            $templateParameters[] = [
                'type' => 'text',
                'text' => (string) $parameter,
            ];
        }

        return Http::withToken(env('WHATSAPP_ACCESS_TOKEN'))
            ->post(
                'https://graph.facebook.com/v23.0/'
                    . env('WHATSAPP_PHONE_NUMBER_ID')
                    . '/messages',
                [
                    'messaging_product' => 'whatsapp',

                    'to' => preg_replace('/\D/', '', $target),

                    'type' => 'template',

                    'template' => [
                        'name' => $templateName,

                        'language' => [
                            'code' => 'id',
                        ],

                        'components' => [
                            [
                                'type' => 'body',

                                'parameters' => $templateParameters,
                            ],
                        ],
                    ],
                ]
            );
    }


    /**
     * Welcome message ketika peserta didaftarkan
     *
     * Template Meta:
     * welcome_sirapos
     *
     * {{1}} = nama penerima
     */
    public function sendWelcomeMessage($peserta)
    {
        return $this->sendMetaTemplate(
            $peserta->nomor_whatsapp,
            'welcome_sirapos',
            [
                $peserta->nama_penerima,
            ]
        );
    }


    /**
     * Kirim reminder Posyandu
     *
     * Template Meta:
     * reminder_posyandu
     *
     * {{1}} = nama penerima
     * {{2}} = tanggal
     * {{3}} = lokasi
     */
    public function sendReminder(Jadwal $jadwal, $type)
    {
        $sent = 0;
        $failed = 0;
        $skipped = 0;

        /*
        |--------------------------------------------------------------------------
        | Kelompokkan berdasarkan nomor WhatsApp
        |--------------------------------------------------------------------------
        */

        $groups = $jadwal->posyandu
            ->pesertas
            ->groupBy('nomor_whatsapp');


        foreach ($groups as $nomor => $pesertas) {

            $peserta = $pesertas->first();


            /*
            |--------------------------------------------------------------------------
            | Filter peserta yang boleh menerima reminder
            |--------------------------------------------------------------------------
            */

            $pesertasValid = $pesertas->filter(
                function ($item) use ($jadwal, $type, &$skipped) {

                    if (! $item->bolehDikirimiReminder()) {
                        $skipped++;

                        return false;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Cek apakah reminder sudah pernah berhasil dikirim
                    |--------------------------------------------------------------------------
                    */

                    $alreadySent = MessageLog::where('jadwal_id', $jadwal->id)
                        ->where('peserta_id', $item->id)
                        ->where('reminder_type', $type)
                        ->where('status', 'Sent')
                        ->exists();


                    if ($alreadySent) {
                        $skipped++;

                        return false;
                    }


                    return true;
                }
            );


            if ($pesertasValid->isEmpty()) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Format tanggal
            |--------------------------------------------------------------------------
            */

            $tanggal = \Carbon\Carbon::parse($jadwal->tanggal)
                ->locale('id')
                ->translatedFormat('d F Y');


            /*
            |--------------------------------------------------------------------------
            | Kirim template reminder ke Meta
            |--------------------------------------------------------------------------
            */

            $tanggal = \Carbon\Carbon::parse($jadwal->tanggal)
                ->locale('id')
                ->translatedFormat('d F Y');

            if ($type == 'H-3') {

                $judul = 'H-3';
                $keterangan = 'Kegiatan Posyandu akan dilaksanakan 3 hari lagi.';
            } elseif ($type == 'H-1') {

                $judul = 'H-1';
                $keterangan = 'Besok akan dilaksanakan kegiatan Posyandu.';
            } else {

                $judul = 'Hari H';
                $keterangan = 'Hari ini merupakan jadwal kegiatan Posyandu.';
            }

            $daftarPeserta = $pesertasValid
                ->pluck('nama_peserta')
                ->map(fn($nama) => "• {$nama}")
                ->implode("\n");

            $response = $this->sendMetaTemplate(
                $nomor,
                'reminder_posyandu',
                [
                    $peserta->nama_penerima,
                    $judul,
                    $keterangan,
                    $daftarPeserta,
                    $tanggal,
                    $jadwal->jam,
                    $jadwal->lokasi,
                ]
            );
            /*
            |--------------------------------------------------------------------------
            | Response Meta
            |--------------------------------------------------------------------------
            */

            $body = $response->body();

            $isSuccess = $response->successful();


            \Log::info('Meta WhatsApp Response', [
                'nomor' => $nomor,
                'http' => $response->status(),
                'body' => $body,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Simpan Message Log
            |--------------------------------------------------------------------------
            */

            foreach ($pesertasValid as $item) {

                MessageLog::create([
                    'jadwal_id' => $jadwal->id,

                    'peserta_id' => $item->id,

                    'message' =>
                    "Halo Bapak/Ibu {$peserta->nama_penerima}, "
                        . "ini adalah pengingat kegiatan Posyandu pada "
                        . "{$tanggal} di {$jadwal->lokasi}.",

                    'reminder_type' => $type,

                    'status' => $isSuccess
                        ? 'Sent'
                        : 'Failed',

                    'provider_response' => $body,

                    'sent_at' => now(),
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Statistik pengiriman
            |--------------------------------------------------------------------------
            */

            if ($isSuccess) {

                $sent++;
            } else {

                $failed++;
            }
        }


        return [
            'sent' => $sent,
            'failed' => $failed,
            'skipped' => $skipped,
        ];
    }
}
