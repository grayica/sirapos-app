<div
    class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 p-8 text-white shadow-xl">

    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-6">

        <div>

            <p class="text-blue-100 uppercase tracking-widest text-sm">
                Dashboard
            </p>

            <h1 class="text-4xl font-bold mt-2">

                Selamat Datang,
                {{ Auth::user()->name }} 👋

            </h1>

            @if (Auth::user()->isSuperAdmin())
                <span class="inline-flex mt-4 rounded-full bg-purple-500/30 px-4 py-1 text-sm">

                    👑 Super Admin

                </span>
            @else
                <span class="inline-flex mt-4 rounded-full bg-green-500/30 px-4 py-1 text-sm">

                    👷 Worker

                </span>
            @endif

            <p class="mt-3 text-blue-100">

                @if (Auth::user()->isSuperAdmin())
                    Anda memiliki akses penuh untuk mengelola seluruh Posyandu,
                    peserta, jadwal, reminder WhatsApp, dan akun pengguna.
                @else
                    Selamat datang di SIRAPOS.
                    Anda hanya dapat mengelola data Posyandu
                    <strong>{{ Auth::user()->posyandu->nama_posyandu ?? '-' }}</strong>.
                @endif

            </p>

        </div>

        <div class="text-right">

            <p class="text-blue-100">

                {{ now()->translatedFormat('l') }}

            </p>

            <h2 class="text-3xl font-bold">

                {{ now()->translatedFormat('d F Y') }}

            </h2>

            <div class="inline-flex items-center mt-4 bg-white/20 rounded-full px-4 py-2">

                <span class="w-2 h-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>

                Sistem Aktif

            </div>

        </div>

    </div>

</div>
