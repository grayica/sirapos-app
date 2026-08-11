<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Detail Posyandu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-6">

            {{-- Informasi Posyandu --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Informasi Posyandu
                </h3>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm text-gray-500">Nama Posyandu</p>
                        <p class="font-semibold">{{ $posyandu->nama_posyandu }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Dusun</p>
                        <p class="font-semibold">{{ $posyandu->dusun }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Lokasi</p>
                        <p class="font-semibold">{{ $posyandu->lokasi }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="bg-green-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500">
                                Jumlah Peserta
                            </p>

                            <p class="text-2xl font-bold text-green-600">
                                {{ $posyandu->pesertas->count() }}
                            </p>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500">
                                Jumlah Jadwal
                            </p>

                            <p class="text-2xl font-bold text-blue-600">
                                {{ $posyandu->jadwals->count() }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Peserta --}}
            <div class="bg-white rounded-xl shadow p-6">

                <h3 class="text-lg font-semibold mb-4">
                    Daftar Peserta
                </h3>

                @if ($posyandu->pesertas->count())

                    <div class="overflow-x-auto">

                        <table class="min-w-full border">

                            <thead class="bg-gray-100">

                                <tr>
                                    <th class="px-4 py-2 border">No</th>
                                    <th class="px-4 py-2 border">Nama</th>
                                    <th class="px-4 py-2 border">Jenis</th>
                                    <th class="px-4 py-2 border">Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($posyandu->pesertas as $peserta)
                                    <tr>

                                        <td class="border px-4 py-2">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $peserta->nama_peserta }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $peserta->jenis_peserta }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $peserta->status }}
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    <p class="text-gray-500">
                        Belum ada peserta.
                    </p>

                @endif

            </div>

            {{-- Jadwal --}}
            <div class="bg-white rounded-xl shadow p-6">

                <h3 class="text-lg font-semibold mb-4">
                    Jadwal Posyandu
                </h3>

                @if ($posyandu->jadwals->count())

                    <div class="overflow-x-auto">

                        <table class="min-w-full border">

                            <thead class="bg-gray-100">

                                <tr>
                                    <th class="px-4 py-2 border">No</th>
                                    <th class="px-4 py-2 border">Tanggal</th>
                                    <th class="px-4 py-2 border">Jam</th>
                                    <th class="px-4 py-2 border">Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($posyandu->jadwals as $jadwal)
                                    <tr>

                                        <td class="border px-4 py-2">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $jadwal->jam }}
                                        </td>

                                        <td class="border px-4 py-2">
                                            {{ $jadwal->status }}
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    <p class="text-gray-500">
                        Belum ada jadwal.
                    </p>

                @endif

            </div>

            <div class="flex justify-end gap-3">

                <a href="{{ route('posyandu.edit', $posyandu) }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">

                    Edit

                </a>

                <a href="{{ route('posyandu.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">

                    Kembali

                </a>

            </div>

        </div>
    </div>

</x-app-layout>
