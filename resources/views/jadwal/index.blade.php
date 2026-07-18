<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Data Jadwal Posyandu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold">
                        Daftar Jadwal
                    </h3>

                    <a href="{{ route('jadwal.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        + Tambah Jadwal
                    </a>
                </div>

                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-4 py-3 w-16">No</th>
                                    <th class="border px-4 py-3">Posyandu</th>
                                    <th class="border px-4 py-3">Tanggal</th>
                                    <th class="border px-4 py-3">Jam</th>
                                    <th class="border px-4 py-3">Lokasi</th>
                                    <th class="border px-4 py-3">Status</th>
                                    <th class="border px-4 py-3 w-56">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($jadwals as $jadwal)
                                <tr class="hover:bg-gray-50">

                                    <td class="border px-4 py-3 text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $jadwal->posyandu->nama_posyandu }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $jadwal->lokasi }}
                                    </td>

                                    <td class="border px-4 py-3 text-center">

                                        @if($jadwal->status == 'Scheduled')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                                Scheduled
                                            </span>

                                        @elseif($jadwal->status == 'Draft')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                                Draft
                                            </span>

                                        @elseif($jadwal->status == 'Completed')
                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                                Completed
                                            </span>

                                        @else
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                                Cancelled
                                            </span>
                                        @endif

                                    </td>

                                   <td class="border px-4 py-3">

                                        <div class="flex justify-center gap-2">

                                            <form action="{{ route('jadwal.send', $jadwal->id) }}" method="POST">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                                                    📲 Kirim
                                                </button>

                                            </form>

                                            <a href="{{ route('jadwal.edit', $jadwal->id) }}"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                                ✏️ Edit
                                            </a>

                                            <form action="{{ route('jadwal.destroy', $jadwal->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                                    🗑 Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="7" class="border px-4 py-6 text-center text-gray-500">
                                        Belum ada data jadwal.
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>

                <div class="mt-5">
                    {{ $jadwals->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
