<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::with('posyandu')
                    ->latest()
                    ->paginate(10);

        return view('peserta.index', compact('pesertas'));
    }

    public function create()
    {
        $posyandus = Posyandu::all();

        return view('peserta.create', compact('posyandus'));
    }

    public function store(Request $request)
    {
         $request->validate([
        'posyandu_id' => 'required|exists:posyandus,id',
        'nama_penerima' => 'required|max:255',
        'hubungan_penerima' => 'required|max:255',
        'nama_peserta' => 'required|max:255',
        'jenis_peserta' => 'required|in:Ibu Hamil,Balita',
        'nomor_whatsapp' => 'required|max:20',
        'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        Peserta::create($request->all());

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil ditambahkan.');
    }

    public function show(Peserta $peserta)
    {
        //
    }

    public function edit(Peserta $peserta)
    {
        $posyandus = Posyandu::all();

        return view('peserta.edit', compact('peserta', 'posyandus'));
    }

    public function update(Request $request, Peserta $peserta)
    {
            $request->validate([
        'posyandu_id' => 'required|exists:posyandus,id',
        'nama_penerima' => 'required|max:255',
        'hubungan_penerima' => 'required|max:255',
        'nama_peserta' => 'required|max:255',
        'jenis_peserta' => 'required|in:Ibu Hamil,Balita',
        'nomor_whatsapp' => 'required|max:20',
        'status' => 'required|in:Aktif,Tidak Aktif',
    ]);

        $peserta->update($request->all());

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');

    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }
}
