<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">
                Data Posyandu
            </h2>

            <a href="{{ route('posyandu.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Tambah Posyandu
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6">

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left">No</th>
                            <th class="px-6 py-3 text-left">Nama Posyandu</th>
                            <th class="px-6 py-3 text-left">Dusun</th>
                            <th class="px-6 py-3 text-left">Lokasi</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($posyandus as $index => $posyandu)

                        <tr class="border-t">
                            <td class="px-6 py-4">{{ $posyandus->firstItem() + $index }}</td>                            <td class="px-6 py-4">{{ $posyandu->nama_posyandu }}</td>
                            <td class="px-6 py-4">{{ $posyandu->dusun }}</td>
                            <td class="px-6 py-4">{{ $posyandu->lokasi }}</td>

                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="#" class="text-blue-600">Detail</a>
                                <a href="{{ route('posyandu.edit', $posyandu->id) }}"
                                class="text-yellow-600 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('posyandu.destroy', $posyandu->id) }}"
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
                            <td colspan="5" class="text-center py-6 text-gray-500">
                                Belum ada data Posyandu.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="p-4">
                    {{ $posyandus->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
