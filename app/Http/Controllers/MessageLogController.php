<?php

namespace App\Http\Controllers;

use App\Models\MessageLog;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class MessageLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $query = MessageLog::with([
            'peserta',
            'jadwal.posyandu'
        ]);

        if (Auth::user()->isWorker()) {

            $query->whereHas('jadwal', function ($q) {

                $q->where(
                    'posyandu_id',
                    Auth::user()->posyandu_id
                );
            });
        }

        if ($search) {

            $query->where(function ($query) use ($search) {

                $query->where('status', 'like', "%{$search}%")
                    ->orWhereHas('peserta', function ($q) use ($search) {

                        $q->where('nama_penerima', 'like', "%{$search}%")
                            ->orWhere('nama_peserta', 'like', "%{$search}%");
                    })
                    ->orWhereHas('jadwal.posyandu', function ($q) use ($search) {

                        $q->where(
                            'nama_posyandu',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        // Filter Posyandu
        if (
            Auth::user()->isSuperAdmin() &&
            $request->filled('posyandu_id')
        ) {

            $query->whereHas('jadwal', function ($q) use ($request) {

                $q->where('posyandu_id', $request->posyandu_id);
            });
        }

        $logs = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $posyandus = Posyandu::orderBy('nama_posyandu')->get();

        return view(
            'message-log.index',
            compact(
                'logs',
                'posyandus'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MessageLog $messageLog)
    {
        $messageLog->load([
            'peserta',
            'jadwal.posyandu'
        ]);

        if (
            Auth::user()->isWorker() &&
            $messageLog->jadwal->posyandu_id != Auth::user()->posyandu_id
        ) {

            abort(403);
        }

        return view(
            'message-log.show',
            compact('messageLog')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MessageLog $messageLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MessageLog $messageLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessageLog $messageLog)
    {
        //
    }

    public function exportPdf()
    {
        $query = MessageLog::with([
            'peserta',
            'jadwal.posyandu'
        ]);

        if (Auth::user()->isWorker()) {

            $query->whereHas('jadwal', function ($q) {

                $q->where(
                    'posyandu_id',
                    Auth::user()->posyandu_id
                );
            });
        }

        $logs = $query
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'message-log.pdf',
            compact('logs')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'Laporan-Reminder-Posyandu.pdf'
        );
    }
}
