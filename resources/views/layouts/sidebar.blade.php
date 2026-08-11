<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-72 bg-slate-800 text-white shadow-2xl z-50
           transform -translate-x-full lg:translate-x-0
           transition-transform duration-300 ease-in-out">

    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/40 z-40 lg:hidden"></div>

    <div class="h-full flex flex-col">

        {{-- Logo --}}
        <div class="px-6 py-6 border-b border-slate-800">

            <div class="flex justify-center">

                <img src="{{ asset('images/logo-SIRAPOS-horizontal.png') }}" class="h-14 lg:h-20" w-auto object-contain">

            </div>

            <p class="mt-4 text-center text-sm text-slate-400">

                UPTD Puskesmas Cermee

            </p>

        </div>
        {{-- Menu --}}
        <nav class="relative z-50 flex-1 px-4 py-6 space-y-3">
            <a href="{{ route('dashboard') }}"
                class="relative z-50 items-center  gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('dashboard') ? 'bg-emerald-500 text-white shadow-lg' : 'hover:bg-slate-700 text-slate-300' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5V21H3V10.5z" />
                </svg>

                <span>Dashboard</span>
            </a>

            @if (auth()->user()->isSuperAdmin())
                <a href="{{ route('posyandu.index') }}"
                    class="relative z-50 items-center gap-3 px-4 py-3 rounded-xl transition
       {{ request()->routeIs('posyandu.*') ? 'bg-emerald-500 text-white shadow-lg' : 'hover:bg-slate-700 text-slate-300' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 8.25v7.5A2.25 2.25 0 0117.25 18H6.75A2.25 2.25 0 014.5 15.75v-7.5A2.25 2.25 0 016.75 6h10.5A2.25 2.25 0 0119.5 8.25z" />

                    </svg>

                    <span>Posyandu</span>

                </a>
            @endif

            <a href="{{ route('peserta.index') }}"
                class="relative z-50 items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('peserta.*') ? 'bg-emerald-500 text-white shadow-lg' : 'hover:bg-slate-700 text-slate-300' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 11a4 4 0 11-8 0 4 4 0 018 0zm4 9a8 8 0 10-16 0" />
                </svg>

                <span>Peserta</span>
            </a>

            <a href="{{ route('jadwal.index') }}"
                class="relative z-50 items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('jadwal.*') ? 'bg-emerald-500 text-white shadow-lg' : 'hover:bg-slate-700 text-slate-300' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>

                <span>Jadwal</span>
            </a>

            <a href="{{ route('message-log.index') }}"
                class="relative z-50 items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('message-log.*') ? 'bg-emerald-500 text-white shadow-lg' : 'hover:bg-slate-700 text-slate-300' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 10h8M8 14h5M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                </svg>

                <span>Message Log</span>
            </a>

            @if (auth()->user()->isSuperAdmin())
                <a href="{{ route('users.index') }}"
                    class="relative z-50 items-center gap-3 px-4 py-3 rounded-xl transition
{{ request()->routeIs('users.*') ? 'bg-emerald-500 text-white shadow-lg' : 'hover:bg-slate-700 text-slate-300' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-8 0v2m8 0H9m8-10a4 4 0 11-8 0 4 4 0 018 0z" />

                    </svg>

                    <span>Kelola User</span>

                </a>
            @endif

        </nav>

        {{-- User --}}
        <div class="border-t border-slate-700 p-4 lg:p-6">

            <div class="flex items-center gap-4">

                <div class="w-11 h-11 rounded-full bg-emerald-500 flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="px-4 py-3 border-t">

                    <p class="font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-slate-500">

                        {{ auth()->user()->email }}

                    </p>

                    <p class="text-sm text-gray-500">

                        @if (auth()->user()->isSuperAdmin())
                            <p class="text-xs text-slate-400">

                                👑 Super Admin

                            </p>
                        @else
                            <p class="text-xs text-slate-400">

                                👷 Worker

                            </p>

                            <p class="text-xs text-emerald-400 mt-1">

                                🏥 {{ auth()->user()->posyandu->nama_posyandu ?? '-' }}

                            </p>
                        @endif
                    </p>

                </div>

            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="w-full rounded-xl bg-red-500 hover:bg-red-600 transition py-2.5 font-medium">
                    Logout
                </button>
            </form>

        </div>

    </div>

</aside>
