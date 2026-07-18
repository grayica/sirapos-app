<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('posyandu')
            ->latest()
            ->paginate(10);

        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $posyandus = Posyandu::all();

        return view('jadwal.create', compact('posyandus'));
    }

    public function store(Request $request)
    {
           $request->validate([
        'posyandu_id' => 'required|exists:posyandus,id',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'lokasi' => 'required|string|max:255',
        'status' => 'required',
        ]);

        Jadwal::create($request->all());
    
        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal)
    {
        //
    }

    public function edit(Jadwal $jadwal)
    {
        //
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
