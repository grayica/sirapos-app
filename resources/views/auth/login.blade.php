<x-guest-layout>

    <div class="text-center mb-10">

    <div class="flex justify-center items-center gap-6 mb-6">

        <img src="{{ asset('images/logo-Bondowoso.png') }}"
            class="h-20 w-auto">

        <img src="{{ asset('images\logo-Dinas-Kesehatan.png') }}"
            class="h-20 w-auto">

        <img src="{{ asset('images/logo-KKN.png') }}"
            class="h-24 w-auto">

    </div>

    <h1 class="text-4xl font-extrabold text-emerald-700">

        SIRAPOS

    </h1>

    <p class="mt-3 text-lg text-slate-600">

        Sistem Informasi Reminder Posyandu

    </p>

    <p class="text-sm text-slate-500">

        UPTD Puskesmas Cermee • Kabupaten Bondowoso

    </p>

</div>

    @if (session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">

            {{ session('success') }}

        </div>
    @endif

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">

        @csrf

        {{-- Email --}}
        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Email
            </label>

            <div class="relative">

                <span class="absolute left-4 top-3.5 text-gray-400">
                    📧
                </span>

                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username" placeholder="Masukkan email"
                    class="w-full rounded-xl border border-gray-300 pl-12 pr-4 py-3
                    focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                    transition">

            </div>

            @error('email')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Password --}}
        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Password
            </label>

            <div class="relative">

                <span class="absolute left-4 top-3.5 text-gray-400">
                    🔒
                </span>

                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Masukkan password"
                    class="w-full rounded-xl border border-gray-300 pl-12 pr-4 py-3
                    focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                    transition">

            </div>

            @error('password')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between">

            <label class="flex items-center gap-2">

                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">

                <span class="text-sm text-gray-600">
                    Ingat Saya
                </span>

            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-emerald-600 hover:text-emerald-700">

                    Lupa Password?

                </a>
            @endif

        </div>

        {{-- Button --}}
        <button type="submit"
            class="w-full bg-emerald-600 hover:bg-emerald-700
            text-white py-3 rounded-xl font-semibold
            shadow-lg hover:shadow-xl
            transition duration-300">

            Masuk ke Dashboard

        </button>

    </form>

    <div class="mt-8 text-center">

        <p class="text-sm text-slate-500">

            Belum memiliki akun?

        </p>

        <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 hover:underline">

            Daftar Sebagai Kader

        </a>

        <p class="mt-2 text-xs text-slate-400">

            Setelah mendaftar, akun akan diverifikasi oleh Administrator sebelum dapat digunakan.

        </p>

    </div>

</x-guest-layout>
