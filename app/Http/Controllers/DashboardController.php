<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MessageLog;
use App\Models\Peserta;
use App\Models\Posyandu;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [

            'totalPosyandu' => Posyandu::count(),

            'totalPeserta' => Peserta::count(),

            'jadwalBulanIni' => Jadwal::whereMonth(
                'tanggal',
                now()->month
            )->count(),

            'sent' => MessageLog::where('status','Sent')->count(),

            'failed' => MessageLog::where('status','Failed')->count(),

            'pending' => MessageLog::where('status','Pending')->count(),

        ]);
    }
}
