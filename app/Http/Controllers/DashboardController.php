<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posyandu;
use App\Models\Peserta;
use App\Models\Jadwal;
use App\Models\MessageLog;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalPosyandu' => Posyandu::count(),
            'totalPeserta' => Peserta::count(),
            'jadwalBulanIni' => Jadwal::whereMonth('tanggal', now()->month)->count(),
            'reminderTerkirim' => MessageLog::where('status', 'Sent')->count(),
        ]);
    }
}
