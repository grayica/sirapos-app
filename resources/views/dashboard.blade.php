<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Dashboard SIRAPOS
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Posyandu -->
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm">Total Posyandu</h3>

                    <p class="text-3xl font-bold mt-2">
                        {{ $totalPosyandu }}
                    </p>

                    <a href="{{ route('posyandu.index') }}"
                    class="text-blue-600 text-sm mt-4 inline-block">
                        Lihat Data →
                    </a>
                </div>

                <!-- Total Peserta -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-gray-500 text-sm">Total Peserta</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalPeserta }}</p>
                </div>

                <!-- Jadwal Bulan Ini -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-gray-500 text-sm">Jadwal Bulan Ini</h3>
                    <p class="text-3xl font-bold mt-2">{{ $jadwalBulanIni }}</p>
                </div>

                <!-- Reminder Terkirim -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-gray-500 text-sm">Reminder Terkirim</h3>
                    <p class="text-3xl font-bold mt-2">{{ $reminderTerkirim }}</p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
