<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    public function index()
    {
        $posyandus = Posyandu::latest()->paginate(10);

        return view('posyandu.index', compact('posyandus'));
    }

    public function create()
    {
            return view('posyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama_posyandu' => 'required|max:255',
        'dusun' => 'required|max:255',
        'lokasi' => 'required|max:255',
        ]);

        Posyandu::create($request->all());

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil ditambahkan.');
    }

    public function show(Posyandu $posyandu)
    {
        //
    }

    public function edit(Posyandu $posyandu)
    {
            return view('posyandu.edit', compact('posyandu'));
    }

    public function update(Request $request, Posyandu $posyandu)
    {
         $request->validate([
        'nama_posyandu' => 'required|max:255',
        'dusun' => 'required|max:255',
        'lokasi' => 'required|max:255',
        ]);

        $posyandu->update($request->all());

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil diperbarui.');
    }

    public function destroy(Posyandu $posyandu)
    {
        $posyandu->delete();

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil dihapus.');
    }
}
