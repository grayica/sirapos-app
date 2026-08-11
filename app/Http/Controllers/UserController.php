<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Posyandu;
use App\Models\User;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('posyandu');

        // Search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Role
        if ($request->filled('role')) {

            $query->where('role', $request->role);
        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        // Filter Posyandu
        if ($request->filled('posyandu_id')) {

            $query->where('posyandu_id', $request->posyandu_id);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $posyandus = Posyandu::orderBy('nama_posyandu')->get();

        return view('users.index', compact('users', 'posyandus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posyandus = Posyandu::orderBy('nama_posyandu')->get();

        return view(
            'users.create',
            compact('posyandus')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $data['role'] = 'worker';

        $user = User::create($data);

        activity_log(

            'User',

            'Tambah User',

            'Menambahkan akun ' . $user->name

        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $posyandus = Posyandu::orderBy('nama_posyandu')->get();

        return view(
            'users.edit',
            compact(
                'user',
                'posyandus'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {

            $data['password'] = Hash::make($data['password']);
        } else {

            unset($data['password']);
        }

        $user->update($data);

        activity_log(

            'User',

            'Edit User',

            'Mengubah akun ' . $user->name

        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->isSuperAdmin()) {

            return back()->with(
                'error',
                'Super Admin tidak dapat dihapus.'
            );
        }

        $user->delete();

        activity_log(

            'User',

            'Hapus User',

            'Menghapus akun ' . $user->name

        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function approve(User $user)
    {
        if ($user->isSuperAdmin()) {

            return back()->with(
                'error',
                'Super Admin tidak dapat diubah statusnya.'
            );
        }

        $user->update([
            'status' => 'Aktif'
        ]);


        activity_log(

            'User',

            'Approve User',

            'Menyetujui akun ' . $user->name

        );

        return back()->with(
            'success',
            'User berhasil disetujui.'
        );
    }

    public function reject(User $user)
    {
        if ($user->isSuperAdmin()) {

            return back()->with(
                'error',
                'Super Admin tidak dapat diubah statusnya.'
            );
        }

        $user->update([
            'status' => 'Nonaktif'
        ]);

        activity_log(

            'User',

            'Reject User',

            'Menolak akun ' . $user->name

        );

        return back()->with(
            'success',
            'User berhasil ditolak.'
        );
    }

    public function resetPassword(User $user)
    {
        if ($user->isSuperAdmin()) {

            return back()->with(
                'error',
                'Password Super Admin tidak dapat direset.'
            );
        }

        $newPassword = Str::random(8);

        $user->update([

            'password' => Hash::make($newPassword)

        ]);

        activity_log(

            'User',

            'Reset Password',

            'Mereset password akun ' . $user->name

        );

        return back()->with(

            'success',

            'Password baru untuk '
                . $user->name
                . ' : '
                . $newPassword

        );
    }
}
