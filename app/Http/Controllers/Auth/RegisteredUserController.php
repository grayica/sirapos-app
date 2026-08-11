<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Posyandu;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $posyandus = Posyandu::orderBy('nama_posyandu')->get();

        return view(
            'auth.register',
            compact('posyandus')
        );
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],

            'posyandu_id' => [
                'required',
                'exists:posyandus,id',
            ],

        ]);

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'role' => 'worker',

            'status' => 'Pending',

            'posyandu_id' => $request->posyandu_id,

        ]);

        $superAdmins = User::where('role', 'Super Admin')->get();

        event(new Registered($user));

        return redirect()
            ->route('login')
            ->with('success', 'Pendaftaran berhasil. Akun Anda sedang menunggu persetujuan Administrator.');
    }
}
