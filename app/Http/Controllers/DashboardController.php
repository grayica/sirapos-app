<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\Peserta;
use App\Models\Jadwal;
use App\Models\MessageLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $bulan = request('bulan', now()->month);

        $totalReminder = MessageLog::whereMonth('created_at', $bulan)
            ->where('status', 'Sent')
            ->count();

        $failedToday = MessageLog::whereMonth('created_at', $bulan)
            ->where('status', 'Failed')
            ->count();

        $jadwalAktif = Jadwal::whereMonth('tanggal', $bulan)
            ->where('status', 'Scheduled')
            ->count();

        $jadwalSelesai = Jadwal::whereMonth('tanggal', $bulan)
            ->where('status', 'Completed')
            ->count();
        // =========================
        // Statistik Umum
        // =========================

        if ($user->isSuperAdmin()) {

            $totalPosyandu = Posyandu::count();

            $totalPeserta = Peserta::count();

            $totalJadwal = Jadwal::count();

            $totalWorker = User::where('role', 'worker')->count();
        } else {

            $totalPosyandu = 1;

            $totalPeserta = Peserta::where(
                'posyandu_id',
                $user->posyandu_id
            )->count();

            $totalJadwal = Jadwal::where(
                'posyandu_id',
                $user->posyandu_id
            )->count();

            $totalWorker = 1;
        }

        // =========================
        // Status Jadwal
        // =========================

        $jadwalAktif = Jadwal::whereMonth('tanggal', $bulan)
            ->where('status', 'Scheduled')
            ->count();

        $jadwalSelesai = Jadwal::whereMonth('tanggal', $bulan)
            ->where('status', 'Completed')
            ->count();

        $jadwalBatal = Jadwal::whereMonth('tanggal', $bulan)
            ->where('status', 'Cancelled')
            ->count();

        // =========================
        // Statistik Reminder
        // =========================

        $reminderSent = MessageLog::whereMonth('created_at', $bulan)
            ->where('status', 'Sent')
            ->count();

        $reminderFailed = MessageLog::whereMonth('created_at', $bulan)
            ->where('status', 'Failed')
            ->count();

        $totalReminder = $reminderSent;

        $reminderHariIni = MessageLog::whereDate('created_at', Carbon::today())
            ->count();

        $failedToday = MessageLog::whereDate('created_at', Carbon::today())
            ->where('status', 'Failed')
            ->count();

        $totalLog = MessageLog::whereMonth('created_at', $bulan)->count();

        $successRate = $totalLog > 0
            ? round(($reminderSent / $totalLog) * 100)
            : 0;

        // =========================
        // Success Rate
        // =========================

        $totalLog = MessageLog::count();

        $successRate = $totalLog > 0
            ? round(($reminderSent / $totalLog) * 100)
            : 0;

        // =========================
        // Aktivitas
        // =========================

        $lastReminder = MessageLog::latest()->first();

        $recentLogs = MessageLog::with([
            'peserta',
            'jadwal.posyandu'
        ]);

        if ($user->isWorker()) {

            $recentLogs->whereHas('jadwal', function ($q) use ($user) {

                $q->where(
                    'posyandu_id',
                    $user->posyandu_id
                );
            });
        }

        $recentLogs = ActivityLog::with('user')
            ->latest()
            ->take(8)
            ->get();    
        // =========================
        // Jadwal Hari Ini
        // =========================

        $todaySchedules = Jadwal::with('posyandu')
            ->whereDate('tanggal', today());

        if ($user->isWorker()) {

            $todaySchedules->where(
                'posyandu_id',
                $user->posyandu_id
            );
        }

        $todaySchedules = $todaySchedules
            ->orderBy('jam')
            ->get();

        $chartLabels = [];
        $chartData = [];

        $jumlahHari = Carbon::create(now()->year, $bulan)->daysInMonth;

        for ($i = 1; $i <= $jumlahHari; $i++) {

            $chartLabels[] = $i;

            $chartData[] = MessageLog::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $bulan)
                ->whereDay('created_at', $i)
                ->where('status', 'Sent')
                ->count();
        }

        return view('dashboard', compact(

            'totalPosyandu',
            'totalPeserta',
            'totalJadwal',
            'totalWorker',

            'jadwalAktif',
            'jadwalSelesai',
            'jadwalBatal',

            'reminderSent',
            'totalReminder',
            'reminderFailed',
            'reminderHariIni',

            'chartLabels',
            'chartData',

            'failedToday',

            'successRate',

            'lastReminder',

            'todaySchedules',

            'recentLogs'

        ));
    }
}
