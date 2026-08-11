<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Posyandu;
use App\Models\MessageLog;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $query = Jadwal::with('posyandu');

        if (auth()->user()->isWorker()) {
            $query->where('posyandu_id', auth()->user()->posyandu_id);
        }

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('lokasi', 'like', '%' . $request->search . '%')
                    ->orWhere('tanggal', 'like', '%' . $request->search . '%')
                    ->orWhereHas('posyandu', function ($qq) use ($request) {
                        $qq->where('nama_posyandu', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        // Filter Posyandu (Super Admin)
        if (
            Auth::user()->isSuperAdmin() &&
            $request->filled('posyandu_id')
        ) {

            $query->where('posyandu_id', $request->posyandu_id);
        }

        $jadwals = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $posyandus = Posyandu::orderBy('nama_posyandu')->get();

        return view(
            'jadwal.index',
            compact(
                'jadwals',
                'posyandus'
            )
        );
    }

    public function create()
    {
        if (Auth::user()->isSuperAdmin()) {

            $posyandus = Posyandu::orderBy('nama_posyandu')->get();
        } else {

            $posyandus = Posyandu::where(
                'id',
                Auth::user()->posyandu_id
            )->get();
        }

        return view('jadwal.create', compact(
            'posyandus'
        ));
    }

    public function store(StoreJadwalRequest $request)
    {
        $data = $request->validated();

        $data['status'] = $request->action === 'draft'
            ? 'Draft'
            : 'Scheduled';


        $jadwal = Jadwal::create($data);


        $namaPosyandu = Posyandu::find($data['posyandu_id'])?->nama_posyandu ?? '-';

        activity_log(

            'Jadwal',

            'Tambah Jadwal',

            'Menambahkan jadwal Posyandu '
                . $namaPosyandu
                . ' pada '
                . $jadwal->tanggal

        );

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil disimpan.');
    }

    public function show(Jadwal $jadwal)
    {
        $posyandus = Posyandu::all();

        return view('jadwal.edit', compact('jadwal', 'posyandus'));
    }

    public function edit(Jadwal $jadwal)
    {

        if (
            Auth::user()->isWorker() &&
            $jadwal->posyandu_id != Auth::user()->posyandu_id
        ) {
            abort(403);
        }

        $posyandus = Posyandu::all();

        return view('jadwal.edit', compact(
            'jadwal',
            'posyandus'
        ));
    }

    public function update(UpdateJadwalRequest $request, Jadwal $jadwal)
    {

        if (
            Auth::user()->isWorker() &&
            $jadwal->posyandu_id != Auth::user()->posyandu_id
        ) {
            abort(403);
        }

        // Simpan tanggal lama sebelum diupdate
        $tanggalLama = $jadwal->tanggal;

        // Update data jadwal
        $data = $request->validated();

        if (! in_array($jadwal->status, ['Completed', 'Cancelled'])) {

            $data['status'] = $request->action === 'draft'
                ? 'Draft'
                : 'Scheduled';
        }

        $jadwal->update($data);
        $namaPosyandu = Posyandu::find($jadwal->posyandu_id)?->nama_posyandu ?? '-';

        activity_log(

            'Jadwal',

            'Edit Jadwal',

            'Mengubah jadwal Posyandu '
                . $namaPosyandu

        );

        // Jika tanggal berubah, reset reminder
        if ($tanggalLama != $jadwal->tanggal) {
            MessageLog::where('jadwal_id', $jadwal->id)->delete();
        }

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {

        if (
            Auth::user()->isWorker() &&
            $jadwal->posyandu_id != Auth::user()->posyandu_id
        ) {
            abort(403);
        }

        $namaPosyandu = Posyandu::find($jadwal->posyandu_id)?->nama_posyandu ?? '-';
        $jadwal->delete();
        activity_log(

            'Jadwal',

            'Hapus Jadwal',

            'Menghapus jadwal Posyandu '
                . $namaPosyandu

        );

        $jadwal->delete();

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    public function cancel(Jadwal $jadwal)
    {
        if (in_array($jadwal->status, ['Completed', 'Cancelled'])) {
            return back()->with('warning', 'Jadwal tidak dapat dibatalkan.');
        }

        $jadwal->update([
            'status' => 'Cancelled'
        ]);

        return back()->with('success', 'Jadwal berhasil dibatalkan.');
    }

    public function exportPdf(Request $request)
    {
        $query = Jadwal::with('posyandu');

        // Filter Posyandu
        if ($request->filled('posyandu_id')) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        // Filter Bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $jadwals = $query
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->get();

        $pdf = Pdf::loadView(
            'jadwal.pdf',
            compact('jadwals')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Laporan-Jadwal-Posyandu.pdf');
    }

    public function sendReminder(Jadwal $jadwal, WhatsAppService $wa)
    {
        $result = $wa->sendReminder($jadwal);

        activity_log(

            'Reminder',

            'Kirim Reminder',

            'Mengirim '
                . $result['sent']
                . ' reminder untuk Posyandu '
                . $jadwal->posyandu->nama_posyandu

        );

        if ($result['sent'] == 0 && $result['skipped'] > 0) {
            return redirect()
                ->route('jadwal.index')
                ->with(
                    'warning',
                    'Semua peserta pada jadwal ini sudah pernah menerima reminder.'
                );
        }

        $message = "{$result['sent']} reminder berhasil dikirim.";

        if ($result['skipped'] > 0) {
            $message .= " {$result['skipped']} peserta dilewati karena reminder sudah pernah dikirim.";
        }

        return redirect()
            ->route('jadwal.index')
            ->with('success', $message);
    }
}
