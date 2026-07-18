<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">
                Data Peserta
            </h2>

            <a href="{{ route('peserta.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Tambah Peserta
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6">

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 p-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left">No</th>
                            <th class="px-6 py-3 text-left">Posyandu</th>
                            <th class="px-6 py-3 text-left">Nama Peserta</th>
                            <th class="px-6 py-3 text-left">Jenis</th>
                            <th class="px-6 py-3 text-left">WhatsApp</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($pesertas as $index => $peserta)

                        <tr class="border-t hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $pesertas->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $peserta->posyandu?->nama_posyandu ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $peserta->nama_peserta }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $peserta->jenis_peserta }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $peserta->nomor_whatsapp }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $peserta->status }}
                            </td>

                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="#" class="text-blue-600">Detail</a>
                                <a href="{{ route('peserta.edit', $peserta->id) }}"
                                    class="text-yellow-600 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('peserta.destroy', $peserta->id) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:underline">
                                        Hapus
                                    </button>

                                </form>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-6">
                                Belum ada data peserta.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="p-4">
                    {{ $pesertas->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
