<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use App\Http\Requests\StorePesertaRequest;
use App\Http\Requests\UpdatePesertaRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PesertaImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\WhatsAppService;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $query = Peserta::with('posyandu');

        if (Auth::user()->isWorker()) {
            $query->where('posyandu_id', Auth::user()->posyandu_id);
        }

        if ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('nama_peserta', 'like', "%{$search}%")
                    ->orWhere('nama_penerima', 'like', "%{$search}%")
                    ->orWhere('nomor_whatsapp', 'like', "%{$search}%")
                    ->orWhere('jenis_peserta', 'like', "%{$search}%")
                    ->orWhereHas('posyandu', function ($query) use ($search) {

                        $query->where('nama_posyandu', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Jenis Peserta
        if ($request->filled('jenis_peserta')) {
            $query->where('jenis_peserta', $request->jenis_peserta);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Posyandu (Super Admin saja)
        if (
            Auth::user()->isSuperAdmin() &&
            $request->filled('posyandu_id')
        ) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        $pesertas = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $posyandus = Posyandu::orderBy('nama_posyandu')->get();

        return view(
            'peserta.index',
            compact('pesertas', 'posyandus')
        );
    }

    public function create(Request $request)
    {
        if (Auth::user()->isSuperAdmin()) {

            $posyandus = Posyandu::all();
        } else {

            $posyandus = Posyandu::where(
                'id',
                Auth::user()->posyandu_id
            )->get();
        }

        $jenisData = $request->jenis_data ?? 'umum';

        return view('peserta.create', compact(
            'posyandus',
            'jenisData'
        ));
    }

    public function store(StorePesertaRequest $request)
    {
        if (
            Auth::user()->isWorker() &&
            $request->posyandu_id != Auth::user()->posyandu_id
        ) {
            abort(403);
        }

        $data = $request->validated();

        /*
    |--------------------------------------------------------------------------
    | Hitung tanggal mulai kehamilan
    |--------------------------------------------------------------------------
    */

        if (!empty($data['usia_kehamilan'])) {
            $data['tanggal_mulai_kehamilan'] =
                Carbon::now()->subWeeks((int) $data['usia_kehamilan']);
        }

        unset($data['usia_kehamilan']);

        /*
    |--------------------------------------------------------------------------
    | Buat peserta
    |--------------------------------------------------------------------------
    */

        $peserta = new Peserta($data);

        /*
    |--------------------------------------------------------------------------
    | Hitung jenis peserta
    |--------------------------------------------------------------------------
    */

        $peserta->jenis_peserta =
            $peserta->hitungJenisPeserta();

        $peserta->save();

        /*
    |--------------------------------------------------------------------------
    | Activity Log
    |--------------------------------------------------------------------------
    */

        activity_log(
            'Tambah Peserta',
            'Menambahkan peserta ' . $peserta->nama_peserta
        );

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function show(Peserta $peserta)
    {
        $peserta->load('posyandu');

        if (
            Auth::user()->isWorker() &&
            $peserta->posyandu_id != Auth::user()->posyandu_id
        ) {

            abort(403);
        }

        return view('peserta.show', compact('peserta'));
    }

    public function edit(Peserta $peserta)
    {
        if (Auth::user()->isSuperAdmin()) {

            $posyandus = Posyandu::all();
        } else {

            $posyandus = Posyandu::where(
                'id',
                Auth::user()->posyandu_id
            )->get();
        }

        $jenisData = $peserta->jenis_data;

        $usiaKehamilan = null;

        if (
            $jenisData == 'hamil' &&
            $peserta->tanggal_mulai_kehamilan
        ) {
            $usiaKehamilan =
                Carbon::parse($peserta->tanggal_mulai_kehamilan)
                ->diffInWeeks(now());
        }

        return view(
            'peserta.edit',
            compact(
                'peserta',
                'posyandus',
                'jenisData',
                'usiaKehamilan'
            )
        );
    }

    public function update(UpdatePesertaRequest $request, Peserta $peserta)
    {
        if (
            Auth::user()->isWorker() &&
            $peserta->posyandu_id != Auth::user()->posyandu_id
        ) {
            abort(403);
        }

        $data = $request->validated();

        /*
    |--------------------------------------------------------------------------
    | Hitung ulang tanggal mulai kehamilan
    |--------------------------------------------------------------------------
    */

        if (!empty($data['usia_kehamilan'])) {
            $data['tanggal_mulai_kehamilan'] =
                Carbon::now()->subWeeks((int) $data['usia_kehamilan']);
        }

        unset($data['usia_kehamilan']);

        /*
    |--------------------------------------------------------------------------
    | Update data peserta terlebih dahulu
    |--------------------------------------------------------------------------
    */

        $peserta->fill($data);

        /*
    |--------------------------------------------------------------------------
    | Hitung ulang jenis peserta berdasarkan
    | data yang memang mempengaruhinya
    |--------------------------------------------------------------------------
    */

        $peserta->jenis_peserta =
            $peserta->hitungJenisPeserta();

        /*
    |--------------------------------------------------------------------------
    | Simpan perubahan
    |--------------------------------------------------------------------------
    */

        $peserta->save();

        /*
    |--------------------------------------------------------------------------
    | Activity Log
    |--------------------------------------------------------------------------
    */

        activity_log(
            'Edit Peserta',
            'Mengubah data peserta ' . $peserta->nama_peserta
        );

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Peserta $peserta)
    {
        if (
            Auth::user()->isWorker() &&
            $peserta->posyandu_id != Auth::user()->posyandu_id
        ) {

            abort(403);
        }

        activity_log(
            'Hapus Peserta',
            'Menghapus peserta ' . $peserta->nama_peserta
        );

        $peserta->delete();

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new PesertaImport, $request->file('file'));

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil diimport.');
    }

    public function importForm()
    {
        return view('peserta.import');
    }

    public function exportPdf(Request $request)
    {
        $query = Peserta::with('posyandu');

        // Scope Worker
        if (Auth::user()->isWorker()) {

            $query->where(
                'posyandu_id',
                Auth::user()->posyandu_id
            );
        }

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nama_peserta', 'like', "%{$search}%")
                    ->orWhere('nama_penerima', 'like', "%{$search}%")
                    ->orWhere('nomor_whatsapp', 'like', "%{$search}%")
                    ->orWhere('jenis_peserta', 'like', "%{$search}%")
                    ->orWhereHas('posyandu', function ($qq) use ($search) {

                        $qq->where(
                            'nama_posyandu',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        // Filter Jenis
        if ($request->filled('jenis_peserta')) {

            $query->where(
                'jenis_peserta',
                $request->jenis_peserta
            );
        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        // Filter Posyandu
        if (
            Auth::user()->isSuperAdmin() &&
            $request->filled('posyandu_id')
        ) {

            $query->where(
                'posyandu_id',
                $request->posyandu_id
            );
        }

        $pesertas = $query
            ->orderBy('nama_peserta')
            ->get();

        $pdf = Pdf::loadView(
            'peserta.pdf',
            compact('pesertas')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'Laporan-Peserta-Posyandu.pdf'
        );
    }

    public function testWhatsApp(
        Peserta $peserta,
        WhatsAppService $wa
    ) {
        try {

            $response = $wa->sendWelcomeMessage($peserta);

            if ($response->successful()) {

                return back()->with(
                    'success',
                    'Tes WhatsApp berhasil dikirim.'
                );
            }

            return back()->with(
                'error',
                'WhatsApp gagal dikirim.'
            );
        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
}
