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

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-3">No</th>
                            <th class="border p-3">Posyandu</th>
                            <th class="border p-3">Tanggal</th>
                            <th class="border p-3">Jam</th>
                            <th class="border p-3">Lokasi</th>
                            <th class="border p-3">Status</th>
                            <th class="border p-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jadwals as $jadwal)
                        <tr>
                            <td class="border p-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3">
                                {{ $jadwal->posyandu->nama_posyandu }}
                            </td>

                            <td class="border p-3">
                                {{ $jadwal->tanggal }}
                            </td>

                            <td class="border p-3">
                                {{ $jadwal->jam }}
                            </td>

                            <td class="border p-3">
                                {{ $jadwal->lokasi }}
                            </td>

                            <td class="border p-3">
                                {{ $jadwal->status }}
                            </td>

                            <td class="border p-3 flex gap-2">

                                <a href="{{ route('jadwal.edit', $jadwal->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center p-5">
                                Belum ada jadwal.
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
