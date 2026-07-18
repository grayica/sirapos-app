<?php

namespace App\Console\Commands;

use App\Models\Jadwal;
use App\Services\WhatsAppService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('reminder:send')]
#[Description('Mengirim reminder Posyandu secara otomatis')]
class SendReminderCommand extends Command
{
    public function handle(WhatsAppService $wa)
    {
        $jadwals = Jadwal::whereDate('tanggal', today())->get();

        foreach ($jadwals as $jadwal) {
            $wa->sendReminder($jadwal);
        }

        $this->info('Reminder berhasil dikirim.');

        return self::SUCCESS;
    }
}
