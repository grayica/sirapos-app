<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;
use App\Http\Requests\StorePosyanduRequest;
use App\Http\Requests\UpdatePosyanduRequest;

class PosyanduController extends Controller
{
    public function index(Request $request)
    {

        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $search = $request->search;
        $sort = $request->sort ?? 'latest';

        $query = Posyandu::query();

        if ($search) {
            $query->where('nama_posyandu', 'like', "%{$search}%")
                ->orWhere('dusun', 'like', "%{$search}%")
                ->orWhere('lokasi', 'like', "%{$search}%");
        }

        switch ($sort) {

            case 'oldest':
                $query->oldest();
                break;

            case 'az':
                $query->orderBy('nama_posyandu');
                break;

            case 'za':
                $query->orderByDesc('nama_posyandu');
                break;

            default:
                $query->latest();
                break;
        }

        $posyandus = $query
            ->paginate(10)
            ->withQueryString();

        return view('posyandu.index', compact('posyandus'));
    }

    public function create()
    {

        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        return view('posyandu.create');
    }

    public function store(StorePosyanduRequest $request)
    {

        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        Posyandu::create($request->validated());

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil ditambahkan.');
    }

    public function show(Posyandu $posyandu)
    {

        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $posyandu->load([
            'pesertas',
            'jadwals',
        ]);

        return view('posyandu.show', compact('posyandu'));
    }

    public function edit(Posyandu $posyandu)
    {

        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        return view('posyandu.edit', compact('posyandu'));
    }

    public function update(UpdatePosyanduRequest $request, Posyandu $posyandu)
    {

        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $posyandu->update($request->validated());

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil diperbarui.');
    }

    public function destroy(Posyandu $posyandu)
    {

        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $posyandu->delete();

        return redirect()
            ->route('posyandu.index')
            ->with('success', 'Data Posyandu berhasil dihapus.');
    }
}
