<?php

namespace App\Console\Commands;

use App\Models\Jadwal;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendReminderCommand extends Command
{
    protected $signature = 'reminder:send';

    protected $description = 'Mengirim reminder H-3, H-1, dan Hari H sesuai jam jadwal';

    public function handle(WhatsAppService $wa)
    {
        $now = now();

        $currentDate = $now->copy()->startOfDay();

        $currentTime = $now->format('H:i');

        $this->info('');
        $this->info('========================================');
        $this->info('SIRAPOS REMINDER SCHEDULER');
        $this->info('Tanggal : ' . $currentDate->format('d-m-Y'));
        $this->info('Jam     : ' . $currentTime);
        $this->info('========================================');

        /*
        |--------------------------------------------------------------------------
        | Ambil jadwal aktif
        |--------------------------------------------------------------------------
        */

        $jadwals = Jadwal::whereIn('status', [
            'Draft',
            'Scheduled'
        ])
            ->get()
            ->filter(function ($jadwal) use ($currentTime) {

                return Carbon::parse($jadwal->jam)
                    ->format('H:i') === $currentTime;
            });

        $this->info("Jadwal yang diproses : " . $jadwals->count());

        foreach ($jadwals as $jadwal) {

            $selisih = $currentDate->diffInDays(
                Carbon::parse($jadwal->tanggal),
                false
            );

            $this->line('');
            $this->info("================================");
            $this->info("Jadwal ID : {$jadwal->id}");
            $this->info("Tanggal   : {$jadwal->tanggal}");
            $this->info("Jam       : {$jadwal->jam}");
            $this->info("Selisih   : {$selisih}");
            $this->info("================================");

            switch ($selisih) {

                case 3:

                    $this->info('>> Mengirim Reminder H-3');

                    $result = $wa->sendReminder($jadwal, 'H-3');

                    $this->info("Berhasil dikirim : {$result['sent']}");
                    $this->info("Dilewati         : {$result['skipped']}");

                    break;

                case 1:

                    $this->info('>> Mengirim Reminder H-1');

                    $result = $wa->sendReminder($jadwal, 'H-1');

                    $this->info("Berhasil dikirim : {$result['sent']}");
                    $this->info("Dilewati         : {$result['skipped']}");
                    break;

                case 0:

                    $this->info('>> Mengirim Reminder Hari H');

                    $result = $wa->sendReminder($jadwal, 'H');

                    $this->info("Berhasil : {$result['sent']}");
                    $this->warn("Gagal    : {$result['failed']}");
                    $this->info("Dilewati : {$result['skipped']}");

                    if ($result['sent'] > 0) {

                        $jadwal->update([
                            'status' => 'Completed'
                        ]);

                        $this->info("Status diubah menjadi Completed.");
                    } else {

                        $this->warn("Tidak ada reminder yang berhasil dikirim.");
                        $this->warn("Status tetap Scheduled.");
                    }

                    break;

                default:

                    $this->line('Belum waktunya reminder.');

                    break;
            }

            /*
            |--------------------------------------------------------------------------
            | Otomatis Completed
            |--------------------------------------------------------------------------
            */

            if ($selisih < 0 && $jadwal->status === 'Scheduled') {

                $jadwal->update([
                    'status' => 'Completed'
                ]);

                $this->info("Status jadwal diubah menjadi Completed.");
            }
        }

        $this->info('');
        $this->info('========================================');
        $this->info('Reminder selesai diproses.');
        $this->info('========================================');

        return self::SUCCESS;
    }
}
