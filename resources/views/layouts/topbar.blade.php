<header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200">

    <div class="flex items-center justify-between px-4 lg:px-8 h-20">

        <button id="menuButton" class="lg:hidden p-2 rounded-lg hover:bg-slate-100">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-slate-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />

            </svg>

        </button>

        <div class="flex items-center gap-2 lg:gap-4">

            <div class="flex items-center gap-2 lg:gap-4">
                <div class="hidden sm:block text-right">

                    <p class="text-sm font-semibold text-slate-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-slate-500">
                        {{ auth()->user()->role }}
                    </p>

                </div>

                <div
                    class="w-11 h-11 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

            </div>

        </div>

</header>
